<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust as needed

error_log("Booking creation request received");
error_log(json_encode($_POST));

// Declare variables
$branch_id = $product_id = $pickup_center_id = $cn_no = $ref_no = $booking_date = $consignor_id = $consignor_name = $consignor_address1 = $consignor_address2 = $consignor_mobile = $consignor_gst = $consignee_id = $consignee_name = $consignee_address1 = $consignee_address2 = $consignee_mobile = $consignee_gst = $consignee_email = $destination_content = $declared_value = $postal_code = $payment_mode = $payment_mode_details = $is_volumetric_weight = $consignment_type = $mode_type = $no_of_pieces = $weight = $gst_percentage = $gst_amount = $cross_amount = $total_amount = $is_pod = $status = $created_by = '';
$client= $state='';
$errors = [];

// Required fields
$requiredFields = ['branch_id', 'product_id', 'booking_date', 'consignor_name', 'consignor_address1', 'consignor_mobile', 'consignee_name', 'consignee_address1', 'consignee_mobile', 'declared_value', 'postal_code', 'no_of_pieces', 'weight', 'destination'];

foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && !empty($_POST[$field])) {
        $$field = htmlspecialchars(trim($_POST[$field]));
    } else {
        $errors[] = "Field '$field' is required";
    }
}

// Validate branch_id exists
$stmt = $pdo->prepare("SELECT id FROM tbl_branch WHERE id = :branch_id");
$stmt->bindParam(':branch_id', $branch_id);
$stmt->execute();
if ($stmt->rowCount() == 0) {
    $errors[] = "Invalid branch_id";
}

// Validate product_id exists
$stmt = $pdo->prepare("SELECT id FROM tbl_products WHERE id = :product_id");
$stmt->bindParam(':product_id', $product_id);
$stmt->execute();
if ($stmt->rowCount() == 0) {
    $errors[] = "Invalid product_id";
}

// Validate pickup_center_id if provided
if (!empty($_POST['pickup_center_id'])) {
    $pickup_center_id = htmlspecialchars(trim($_POST['pickup_center_id']));
    $stmt = $pdo->prepare("SELECT id FROM tbl_pickup_center WHERE id = :pickup_center_id");
    $stmt->bindParam(':pickup_center_id', $pickup_center_id);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        $errors[] = "Invalid pickup_center_id";
    }
}

// Validate cn_no is unique
if (!empty($_POST['cn_no'])) {
    $cn_no = htmlspecialchars(trim($_POST['cn_no']));
    $stmt = $pdo->prepare("SELECT id FROM tbl_booking WHERE cn_no = :cn_no");
    $stmt->bindParam(':cn_no', $cn_no);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $errors[] = "cn_no must be unique";
    }
}

$_POST['status']="Pending";

// Validate enums
$valid_payment_modes = ['Cash', 'Credit', 'Online'];
$valid_consignment_types = ['Document', 'Parcel'];
$valid_mode_types = ['Air', 'Surface', 'Local'];
$valid_statuses = ['Pending', 'In Transit', 'Delivered', 'Cancelled'];

if (!in_array($_POST['payment_mode'], $valid_payment_modes)) {
    $errors[] = "Invalid payment_mode";
} else {
    $payment_mode = $_POST['payment_mode'];
}

if (!in_array($_POST['consignment_type'], $valid_consignment_types)) {
    $errors[] = "Invalid consignment_type";
} else {
    $consignment_type = $_POST['consignment_type'];
}

if (!in_array($_POST['mode_type'], $valid_mode_types)) {
    $errors[] = "Invalid mode_type";
} else {
    $mode_type = $_POST['mode_type'];
}

if (!in_array($_POST['status'], $valid_statuses)) {
    $errors[] = "Invalid status";
} else {
    $status = $_POST['status'];
}

// If validation fails, return errors
if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => $errors]);
    exit;
}

// Insert data
try {
    
    
   // Ensure variables are defined before binding
$consignor_id =  0;
$consignee_id = 0;
$gst_percentage =  0;
$gst_amount =  0;
$cross_amount =  0;
$total_amount =  0;
$is_pod =  0;
$is_volumetric_weight =  0;
$created_by=1;



$stmt = $pdo->prepare("INSERT INTO tbl_booking 
        (branch_id, product_id, pickup_center_id, cn_no, ref_no, booking_date, consignor_id, consignor_name, consignor_address1, consignor_address2, consignor_mobile, consignor_gst, consignee_id, consignee_name, consignee_address1, consignee_address2, consignee_mobile,client,state,
        consignee_gst, consignee_email, destination_content, declared_value, postal_code, payment_mode, payment_mode_details, is_volumetric_weight, consignment_type, mode_type, no_of_pieces, weight, gst_percentage, gst_amount, cross_amount, total_amount, is_pod, status, created_at, updated_at, created_by,destination) 
        VALUES 
        (:branch_id, :product_id, :pickup_center_id, :cn_no, :ref_no, :booking_date, :consignor_id, :consignor_name, :consignor_address1, :consignor_address2, :consignor_mobile, :consignor_gst,
        :consignee_id, :consignee_name, :consignee_address1, :consignee_address2, :consignee_mobile,:client,:state, :consignee_gst, :consignee_email, :destination_content, :declared_value, :postal_code, :payment_mode,
        :payment_mode_details, :is_volumetric_weight, :consignment_type, :mode_type, :no_of_pieces, :weight, :gst_percentage, :gst_amount, :cross_amount, :total_amount, :is_pod, :status, NOW(), NOW(), :created_by,:destination)");

$stmt->bindParam(':branch_id', $branch_id);
$stmt->bindParam(':product_id', $product_id);
$stmt->bindParam(':pickup_center_id', $pickup_center_id);
$stmt->bindParam(':cn_no', $cn_no);
$stmt->bindParam(':ref_no', $ref_no);
$stmt->bindParam(':booking_date', $booking_date);
$stmt->bindParam(':consignor_id', $consignor_id);
$stmt->bindParam(':consignor_name', $consignor_name);
$stmt->bindParam(':consignor_address1', $consignor_address1);
$stmt->bindParam(':consignor_address2', $consignor_address2);
$stmt->bindParam(':consignor_mobile', $consignor_mobile);
$stmt->bindParam(':consignor_gst', $consignor_gst);
$stmt->bindParam(':consignee_id', $consignee_id);
$stmt->bindParam(':consignee_name', $consignee_name);
$stmt->bindParam(':consignee_address1', $consignee_address1);
$stmt->bindParam(':consignee_address2', $consignee_address2);
$stmt->bindParam(':consignee_mobile', $consignee_mobile);
$stmt->bindParam(':client', $client);
$stmt->bindParam(':state', $state);
$stmt->bindParam(':consignee_gst', $consignee_gst);
$stmt->bindParam(':consignee_email', $consignee_email);
$stmt->bindParam(':destination_content', $destination_content);
$stmt->bindParam(':declared_value', $declared_value);
$stmt->bindParam(':postal_code', $postal_code);
$stmt->bindParam(':payment_mode', $payment_mode);
$stmt->bindParam(':payment_mode_details', $payment_mode_details);
$stmt->bindParam(':is_volumetric_weight', $is_volumetric_weight);
$stmt->bindParam(':consignment_type', $consignment_type);
$stmt->bindParam(':mode_type', $mode_type);
$stmt->bindParam(':no_of_pieces', $no_of_pieces);
$stmt->bindParam(':weight', $weight);
$stmt->bindParam(':gst_percentage', $gst_percentage)    ;
$stmt->bindParam(':gst_amount', $gst_amount);
$stmt->bindParam(':cross_amount', $cross_amount);
$stmt->bindParam(':total_amount', $total_amount);
$stmt->bindParam(':is_pod', $is_pod);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':created_by', $created_by);
$stmt->bindParam(':destination', $destination);
$stmt->execute();

$last_inserted_id = $pdo->lastInsertId();

    echo json_encode(["status" => 'success', "message" => "Booking created successfully","booking_id" => $last_inserted_id]);
} catch (PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo json_encode(["status" => 'error', "message" => "Database error: " . $e->getMessage()]);
}
?>
