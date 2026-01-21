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
$requiredFields = ['club_name', 'contact_person', 'mobile_number', 'district_id', 'state_id','registration_number','email_address','club_address','established_year'];
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


if (empty($_POST['registration_number'])) {
        $errors[] = "Field 'registration_number' is required";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
}else{
    $registration_number=sanitizeInput($_POST['registration_number']);
}



$stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
$session_id = $stmt->fetchColumn();




$stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_clubs WHERE registration_number = ?");
$stmt->execute([$registration_number]);
$count = $stmt->fetchColumn();
if($count){
        $errors[] = "Club Already Registered!!!";
        echo json_encode(['status' => 'error', 'message' => $errors]);
        exit;
}



// Generate membership ID
// $stmt = $pdo->query("SELECT MAX(id) FROM tbl_skaters");
// $maxId = $stmt->fetchColumn();
// $nextId = ($maxId !== null) ? $maxId + 1 : 1; // If no records exist, start from 1
// $membership_id = sprintf("SSFI/BS/%04d", $nextId);


// File upload function
$uploadDir = '../../uploads/clubs/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$logoPath = null;

if (!empty($_FILES['logo']['name'])) {
    $fileName = $_FILES['logo']['name'];
    $fileTmpName = $_FILES['logo']['tmp_name'];
    $fileSize = $_FILES['logo']['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($fileExt, $allowedExtensions)) {
        $errors[] = "Invalid file type. Allowed types: jpg, jpeg, png, gif.";
    }

    // Validate file size (max 2MB)
    if ($fileSize > 2 * 1024 * 1024) {
        $errors[] = "File size exceeds 2MB.";
    }

    // Create directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate unique filename
    $newFileName = uniqid('club_logo_') . '.' . $fileExt;
    $logoPath = $uploadDir . $newFileName;

    // Move file to upload directory
    if (!move_uploaded_file($fileTmpName, $logoPath)) {
        $errors[] = "Failed to upload logo.";
    } else {
        // Store only relative path in DB
        $logoPath = 'uploads/clubs/' . $newFileName;
    }
}


if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

// Default values
$postData['created_by'] = $postData['created_by'] ?? 0;
$postData['updated_by'] = $postData['updated_by'] ?? 0;
$postData['status'] = $postData['status'] ?? 'active';

try {
    $stmt = $pdo->prepare("INSERT INTO tbl_clubs 
        (club_name, registration_number, contact_person, mobile_number, email_address, district_id, state_id, club_address, established_year, logo_path, status, created_by, updated_by, created_at, updated_at) 
        VALUES (:club_name, :registration_number, :contact_person, :mobile_number, :email_address, :district_id, :state_id, :club_address, :established_year, :logo_path, :status, :created_by, :updated_by, NOW(), NOW())");

    $stmt->bindParam(':club_name', $postData['club_name']);
    $stmt->bindParam(':registration_number', $postData['registration_number']);
    $stmt->bindParam(':contact_person', $postData['contact_person']);
    $stmt->bindParam(':mobile_number', $postData['mobile_number']);
    $stmt->bindParam(':email_address', $postData['email_address']);
    $stmt->bindParam(':district_id', $postData['district_id']);
    $stmt->bindParam(':state_id', $postData['state_id']);
    $stmt->bindParam(':club_address', $postData['club_address']);
    $stmt->bindParam(':established_year', $postData['established_year']);
    $stmt->bindParam(':logo_path', $logoPath);
    $stmt->bindParam(':status', $postData['status']);
    $stmt->bindParam(':created_by', $postData['created_by']);
    $stmt->bindParam(':updated_by', $postData['updated_by']);

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
        echo json_encode(["status" => 'success', "message" => "Club created successfully and waiting for apporval"]);
    } else {
        echo json_encode(["status" => 'error', 'message' => 'Error executing query']);
    }
} catch (PDOException $e) {
    // error_log("Error adding club: " . $e->getMessage());
    echo json_encode(["status" => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
