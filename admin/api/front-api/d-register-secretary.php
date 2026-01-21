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
$requiredFields = ['full_name', 'mobile_number', 'gender', 'aadhar_number', 'email_address', 'state_id', 'district_id', 'residential_address'];
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


if (empty($_POST['aadhar_number'])) {
        $errors[] = "Field 'aadhar_number' is required";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
}else{
    $aadhar_number=sanitizeInput($_POST['aadhar_number']);
}



$stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $stmt->fetchColumn();




$stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_user WHERE aadhar_number = ?");
$stmt->execute([$aadhar_number]);
$count = $stmt->fetchColumn();
if($count){
        $errors[] = "Secretary Already Registered!!!";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
}



// Generate membership ID
$stmt = $pdo->query("SELECT MAX(id) FROM tbl_skaters");
$maxId = $stmt->fetchColumn();
$nextId = ($maxId !== null) ? $maxId + 1 : 1; // If no records exist, start from 1
$membership_id = sprintf("SSFI/BS/DIS/%04d", $nextId);


// File upload function
function uploadFile($file, $type) {
    global $errors;
    
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $year = date('Y');
    $month = date('m');
    $uploadDir = "../../uploads/d-secretary/$type/$year/$month/";

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

    if ($fileSize > 2 * 1024 * 1024) {  // 2MB limit
        $errors[] = "$type file exceeds 2MB limit";
        return null;
    }

    $newFileName = uniqid("$type_") . ".$fileExt";
    $filePath = "$uploadDir$newFileName";

    if (!move_uploaded_file($fileTmpName, $filePath)) {
        $errors[] = "Failed to upload $type";
        return null;
    }

    return "uploads/d-secretary/$type/$year/$month/$newFileName";
}

// Handle file uploads
$identityProofPath = !empty($_FILES['identity_proof']['name']) ? uploadFile($_FILES['identity_proof'], 'identity_proof') : null;
$profilePhotoPath = !empty($_FILES['profile_photo']['name']) ? uploadFile($_FILES['profile_photo'], 'profile_photo') : null;
$role_id=2;

if (!$identityProofPath || !$profilePhotoPath) {
    $errors[] = "File uploads failed";
}

if (!empty($errors)) {
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

try {
    
    
    function generateUniquePassword($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }
    $password = generateUniquePassword();
    $aadhar_no = $postData['aadhar_number'];
    
    $stmt = $pdo->prepare("INSERT INTO tbl_user 
        (role_id,full_name, mobile_number, gender, aadhar_number, email_address, state_id, district_id, residential_address, identity_proof, profile_photo, username, password, member_id, created_at, updated_at) 
        VALUES (:role_id,:full_name, :mobile_number, :gender, :aadhar_number, :email_address, :state_id, :district_id, :residential_address, :identity_proof, :profile_photo, :username, :password, :member_id, NOW(), NOW())");

    $stmt->bindParam(':role_id', $role_id);
    $stmt->bindParam(':full_name', $postData['full_name']);
    $stmt->bindParam(':mobile_number', $postData['mobile_number']);
    $stmt->bindParam(':gender', $postData['gender']);
    $stmt->bindParam(':aadhar_number', $postData['aadhar_number']);
    $stmt->bindParam(':email_address', $postData['email_address']);
    $stmt->bindParam(':state_id', $postData['state_id']);
    $stmt->bindParam(':district_id', $postData['district_id']);
    $stmt->bindParam(':residential_address', $postData['residential_address']);
    $stmt->bindParam(':identity_proof', $identityProofPath);
    $stmt->bindParam(':profile_photo', $profilePhotoPath);
    $stmt->bindParam(':member_id', $membership_id);
    $stmt->bindParam(':username', $postData['email_address']);
    $stmt->bindParam(':password', $password);

//     if ($stmt->execute()) {
        
//         $lastInsertId = $pdo->lastInsertId();

//         $stmt = $pdo->query("SELECT skater_fees FROM tbl_fees");
//         $fees = $stmt->fetchColumn();
        
        
//         /*Payment Order Id Create*/
//         $order_data = [
//             "amount" => $fees*100,  // ₹10.00 in paise
//             "currency" => "INR",
//             "receipt" => "SSFI-2025-".$membership_id,
//           // "payment_capture" => 1, // Auto capture
//             "notes" => [  // Custom Parameters
//                 "user_id" => $membership_id,
//                 "email" => $postData['email_address'],
//                 "product" => "Skater Annual Register"
//             ]
//         ];
        
//         $ch = curl_init("https://api.razorpay.com/v1/orders");
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_USERPWD, "$Razorpay_api_key:$Razorpay_api_secret");
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
//         curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        
//         $response = curl_exec($ch);
//         $order_response = json_decode($response, true);
//         curl_close($ch);
        
        
//         $order_id='';
//         if (isset($order_response['id'])) {
//           // echo json_encode($order_response); // Send order_id to frontend
//             $order_id=$order_response['id'];
            
            
//                 $stmt = $pdo->prepare("INSERT INTO tbl_session_renewal (order_id, payment_id, payment_status, session_id, skater_id) VALUES (?, ?, ?, ?, ?)");
//                 $stmt->execute([
//                     $order_id,
//                     '',
//                     '',
//                     $session_id ?? 0, // Make sure to define $session_id
//                     $lastInsertId   // Make sure to define $skater_id
//                 ]);
            
//         }
        
        
//         echo json_encode(["status" => 'success', "message" => "Skater registered successfully to Activate Account complete the payment", "membership_id" => $membership_id,"order_id"=>$order_id,"amount"=>$fees,'razorpay_api_secret'=>$Razorpay_api_secret]);
//     } else {
//         if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
//             unlink("../../".$identityProofPath);
//         }
//         if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
//             unlink("../../".$profilePhotoPath);
//         }
//         echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
//     }
// } catch (PDOException $e) {
//     if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
//             unlink("../../".$identityProofPath);
//         }
//         if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
//             unlink("../../".$profilePhotoPath);
//         }
//     echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
// }

    if ($stmt->execute()) {
        
        // Fetch District Secretary Info
        $stmts = $pdo->prepare("SELECT st.*,d.district_name,s.state_name FROM tbl_user st 
                    left join tbl_states s on s.id=st.state_id 
                    left join tbl_districts d on d.id=st.district_id WHERE st.aadhar_number = ?");
        $stmts->execute([$aadhar_no]);
        $results = $stmts->fetch(PDO::FETCH_ASSOC);
        $district_info = $results;
        
        echo json_encode(["status" => 'success', "message" => "District Association Registered Successfully,To activate your Profile, please make the payment", "data" => $district_info]);
    } else {
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
        if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
            unlink("../../".$identityProofPath);
        }
        if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
            unlink("../../".$profilePhotoPath);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
     if (!empty($identityProofPath) && file_exists("../../".$identityProofPath)) {
        unlink("../../".$identityProofPath);
    }
    if (!empty($profilePhotoPath) && file_exists("../../".$profilePhotoPath)) {
        unlink("../../".$profilePhotoPath);
    }
}
?>
