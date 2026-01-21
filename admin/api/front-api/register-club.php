<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust path if needed

$errors = [];

// Function to sanitize input
define('FILTER_SANITIZE', FILTER_SANITIZE_STRING);
function sanitizeInput($data) {
    return filter_var(trim($data), FILTER_SANITIZE);
}

// Required fields
$requiredFields = ['club_name', 'contact_person', 'mobile_number', 'district_id', 'state_id', 'email_address','club_address','established_year','aadhar_number'];
$postData = [];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Field '$field' is required";
    } else {
        $postData[$field] = sanitizeInput($_POST[$field]);
    }
}

// Validate foreign keys
$foreignTables = [
    'state_id' => 'tbl_states',
    'district_id' => 'tbl_districts'
];
foreach ($foreignTables as $field => $table) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table WHERE id = ?");
    $stmt->execute([$postData[$field]]);
    if ($stmt->fetchColumn() == 0) {
        $errors[] = "Invalid $field";
    }
}


// if (empty($_POST['registration_number'])) {
//         $errors[] = "Field 'registration_number' is required";
//         echo json_encode(['status' => 'error', 'message' => $errors]);
//         exit;
// }else{
//     $registration_number=sanitizeInput($_POST['registration_number']);
// }



$stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $stmt->fetchColumn();




$stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_clubs WHERE registration_number = ?");
$stmt->execute([$registration_number]);
$count = $stmt->fetchColumn();
if($count){
    
    /*****************************************/
        $club_registered = 0;
        $club_payment_order = 0;
        $club_payment = 0;
        $club_id = 0;

        // Fetch Active Session ID
        $stmt = $pdo->prepare("SELECT id FROM tbl_session WHERE is_active = 1");
        $stmt->execute();
        $session_id = $stmt->fetchColumn();

        // Fetch Skater Info
        $stmt = $pdo->prepare("SELECT c.*,d.district_name,s.state_name FROM tbl_clubs c 
            left join tbl_states s on s.id=c.state_id 
            left join tbl_districts d on d.id=c.district_id WHERE c.registration_number = ?");
        $stmt->execute([$registration_number]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $club_info = $results;

        if ($results) {
            $club_registered = 1;
            $club_id = $results['id'];
        }

        // Fetch Skater Payment Status
        $stmt = $pdo->prepare("SELECT order_id, payment_id FROM tbl_session_renewal WHERE club_id = ? AND session_id = ?");
        $stmt->execute([$club_id, $session_id]);
        $results_session = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($results_session) {
            if (!empty($results_session['payment_id'])) {
                $club_payment = 1;
            }
            if (!empty($results_session['order_id'])) {
                $club_payment_order = 1;
            }
        }

        // Response Logic
        if ($club_registered == 1 && $club_payment == 1) {
            
            $ds='Your login details have been sent to WhatsApp.';
            if($club_info['verified']==0){
                $club_info['membership_id']='*****';
                $ds="Your Account Not Yet Verfied,Wait For Approval,After Approval you can download the Certicate";
            }
            
            
            
            echo json_encode([
                "status" => "error",
                "message" => "Your Annual Club Registeration Already Completed, ".$ds,
                "data" => $club_info,
                "type" => 1
            ]);
            exit;
        } elseif ($club_registered == 1 && $club_payment_order == 0) {
            echo json_encode([
                "status" => "error",
                "message" => "To Complete Annual Club Registration, Kindly make the Payment ",
                "data" => $club_info,
                "type" => 2
            ]);
            exit;
        }  elseif ($club_registered == 1 && $club_payment == 0) {
            echo json_encode([
                "status" => "error",
                "message" => "Your Annual Club Registeration Already Completed,To Activate Account Make the Payment",
                "data" => $club_info,
                "type" => 3
            ]);
            exit;
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Club Not Registered Go for Register",
                "data" => $club_info,
                "type" => 4
            ]);
            exit;
        }
        /*****************************************/
    
    
    
        /*$errors[] = "Club Register Number Already Registered!!!";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;*/
}



// File upload
function uploadFile($file, $type) {
    global $errors;
    $year = date('Y');
    $month = date('m');
    $uploadDir = "../../uploads/clubs/$type/$year/$month/";
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    if (!in_array($fileExt, $allowedExtensions)) {
        $errors[] = "Invalid file type for $type";
        return null;
    }
    
    if ($fileSize > 2 * 1024 * 1024) {
        $errors[] = "$type file exceeds 2MB limit";
        return null;
    }
    
    $newFileName = uniqid("$type_") . ".$fileExt";
    $filePath = "$uploadDir$newFileName";
    
    if (!move_uploaded_file($fileTmpName, $filePath)) {
        $errors[] = "Failed to upload $type";
        return null;
    }
    
    return "uploads/clubs/$type/$year/$month/$newFileName";
}

// proofpassport

// $logoPath = !empty($_FILES['logo']['name']) ? uploadFile($_FILES['logo'], 'logo') : null;

$passport = !empty($_FILES['passport']['name']) ? uploadFile($_FILES['passport'], 'passport') : null;
$proof = !empty($_FILES['proof']['name']) ? uploadFile($_FILES['proof'], 'proof') : null;
$club = !empty($_FILES['club']['name']) ? uploadFile($_FILES['club'], 'club') : null;
$certificate = !empty($_FILES['certificate']['name']) ? uploadFile($_FILES['certificate'], 'certificate') : null;


if (/*!$logoPath || */ !$passport || !$proof ) {
    $errors[] = "File uploads failed";
}

if (!empty($errors)) {
        // if (!empty($logoPath) && file_exists("../../".$logoPath)) {
        //     unlink("../../".$logoPath);
        // }
        if (!empty($passport) && file_exists("../../".$passport)) {
            unlink("../../".$passport);
        }
        if (!empty($proof) && file_exists("../../".$proof)) {
            unlink("../../".$proof);
        }
        if (!empty($club) && file_exists("../../".$club)) {
            unlink("../../".$club);
        }
        if (!empty($certificate) && file_exists("../../".$certificate)) {
            unlink("../../".$certificate);
        }
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}



// Default values
$postData['created_by'] = $postData['created_by'] ?? 0;
$postData['updated_by'] = $postData['updated_by'] ?? 0;
$postData['status'] = $postData['status'] ?? 'active';

try {
    
    // Generate membership ID
    $stmt = $pdo->query("SELECT MAX(id) FROM tbl_clubs");
    $maxId = $stmt->fetchColumn();
    $nextId = ($maxId !== null) ? $maxId + 1 : 1; // If no records exist, start from 1
    $membership_id = sprintf("SSFI/BS/CLU/%04d", $nextId);
    
    
    $stmt = $pdo->prepare("INSERT INTO tbl_clubs 
        (club_name, registration_number,aadhar_number, contact_person, mobile_number, email_address, district_id, state_id, club_address, established_year, status, membership_id, passport, proof, club, certificate, created_by, updated_by, created_at, updated_at) 
        VALUES (:club_name, :registration_number, :aadhar_number, :contact_person, :mobile_number, :email_address, :district_id, :state_id, :club_address, :established_year, :status, :membership_id, :passport, :proof, :club, :certificate,  :created_by, :updated_by, NOW(), NOW())");

    $stmt->bindParam(':club_name', $postData['club_name']);
    $stmt->bindParam(':registration_number', $postData['registration_number']);
    $stmt->bindParam(':contact_person', $postData['contact_person']);
    $stmt->bindParam(':mobile_number', $postData['mobile_number']);
    $stmt->bindParam(':email_address', $postData['email_address']);
    $stmt->bindParam(':district_id', $postData['district_id']);
    $stmt->bindParam(':state_id', $postData['state_id']);
    $stmt->bindParam(':club_address', $postData['club_address']);
    $stmt->bindParam(':established_year', $postData['established_year']);
    $stmt->bindParam(':status', $postData['status']);
    $stmt->bindParam(':membership_id',$membership_id);
    $stmt->bindParam(':aadhar_number',$postData['aadhar_number']);
     $stmt->bindParam(':passport',$passport);
     $stmt->bindParam(':proof',$proof);
      $stmt->bindParam(':club',$club);
       $stmt->bindParam(':certificate',$certificate);
    
    $stmt->bindParam(':created_by', $postData['created_by']);
    $stmt->bindParam(':updated_by', $postData['updated_by']);

    if ($stmt->execute()) {
        
        $lastInsertId = $pdo->lastInsertId();

        $stmt = $pdo->query("SELECT club_fees FROM tbl_fees");
        $fees = $stmt->fetchColumn();
        
        
        /*Payment Order Id Create*/
        $order_data = [
            "amount" => $fees*100,  // ₹10.00 in paise
            "currency" => "INR",
            "receipt" => $membership_id,
          // "payment_capture" => 1, // Auto capture
            "notes" => [  // Custom Parameters
                "user_id" => $membership_id ?? 0,
                "email" => $postData['email_address'],
                "product" => "Club Annual Register"
            ]
        ];
        
        $ch = curl_init("https://api.razorpay.com/v1/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$Razorpay_api_key:$Razorpay_api_secret");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        
        $response = curl_exec($ch);
        $order_response = json_decode($response, true);
        curl_close($ch);
        
        
        $order_id='';
        if (isset($order_response['id'])) {
          // echo json_encode($order_response); // Send order_id to frontend
            $order_id=$order_response['id'];
            
            
                $stmt = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, club_id) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $order_id,
                    '',
                    '',
                    $session_id ?? 0, // Make sure to define $session_id
                    $lastInsertId   // Make sure to define $club_id
                ]);
            
        }
        
        
        echo json_encode(["status" => 'success', "message" => "To Complete Annual Club Registration, Kindly make the Payment", "membership_id" => $membership_id,"order_id"=>$order_id,"amount"=>$fees,'razorpay_api_secret'=>$Razorpay_api_secret]);
    } else {
        // if (!empty($logoPath) && file_exists("../../".$logoPath)) {
        //     unlink("../../".$logoPath);
        // }
        if (!empty($passport) && file_exists("../../".$passport)) {
            unlink("../../".$passport);
        }
        if (!empty($proof) && file_exists("../../".$proof)) {
            unlink("../../".$proof);
        }
        if (!empty($club) && file_exists("../../".$club)) {
            unlink("../../".$club);
        }
        if (!empty($certificate) && file_exists("../../".$certificate)) {
            unlink("../../".$certificate);
        }
        
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    // if (!empty($logoPath) && file_exists("../../".$logoPath)) {
    //         unlink("../../".$logoPath);
    //     }
        if (!empty($passport) && file_exists("../../".$passport)) {
            unlink("../../".$passport);
        }
        if (!empty($proof) && file_exists("../../".$proof)) {
            unlink("../../".$proof);
        }
        if (!empty($club) && file_exists("../../".$club)) {
            unlink("../../".$club);
        }
        if (!empty($certificate) && file_exists("../../".$certificate)) {
            unlink("../../".$certificate);
        }
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
