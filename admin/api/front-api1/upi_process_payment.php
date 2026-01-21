<?php
try {
    include '../../config/config.php'; // Ensure this file correctly initializes $pdo

    // Validate POST variables
    if (!isset($_POST["skater_id"], $_POST["transaction_no"], $_FILES["payment_screenshot"])) {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
        exit();
    }

    $skater_id = $_POST["skater_id"];
    $transaction_id = $_POST["transaction_no"];

    // Handle file upload
    $target_dir = "../../uploads/upi-payments/"; // Ensure this directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    $file_name = time() . "_" . basename($_FILES["payment_screenshot"]["name"]);
    $target_file = $target_dir . $file_name;

    if ($_FILES["payment_screenshot"]["error"] !== UPLOAD_ERR_OK) {
        echo json_encode(["status" => "error", "message" => "File upload error: " . $_FILES["payment_screenshot"]["error"]]);
        exit();
    }

    if (!move_uploaded_file($_FILES["payment_screenshot"]["tmp_name"], $target_file)) {
        echo json_encode(["status" => "error", "message" => "Failed to move uploaded file. Check permissions."]);
        exit();
    }

    // Update tbl_session_renewal
    $sql1 = "UPDATE tbl_session_renewal SET order_id = :transaction_id, payment_id = :screenshot WHERE skater_id = :skater_id";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute([
        ':transaction_id' => $transaction_id,
        ':screenshot' => $target_file,
        ':skater_id' => $skater_id
    ]);

    // Insert into payments table
    $sql2 = "INSERT INTO payments (order_id, payment_id) VALUES (:transaction_id, :payment_screenshot)";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([
        ':transaction_id' => $transaction_id,
        ':payment_screenshot' => $target_file
    ]);
    
    $stmt = $pdo->query("SELECT id FROM tbl_session where is_active=1");
    $session_id = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT skater_fees FROM tbl_fees");
    $fees = $stmt->fetchColumn();


    // $stmt = $pdo->query("SELECT order_id FROM tbl_session_renewal where session_id=?,skater_id=?");
    // $stmt->execute([$session_id,$skater_id]);
    // $order_id = $stmt->fetchColumn();

    echo json_encode(["status" => "success", "message" => "Payment recorded successfully!","order_id" => $transaction_id,"amount" => $fees,"skater_id" =>$skater_id]);

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
