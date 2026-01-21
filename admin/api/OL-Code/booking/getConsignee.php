<?php
include_once("../../config/config.php");

header('Content-Type: application/json');

// Check if the 'id' parameter is passed
if (isset($_GET['id'])) {
    $consignee_id = $_GET['id'];

    

    try {

        // Query to get consignor details by ID
        $stmt = $pdo->prepare("SELECT name, address1, address2, pincode, mobile FROM tbl_customer WHERE id = ?");
        $stmt->execute([$consignee_id]);

        // Fetch the result
        $consignor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($consignor) {
            // Send response as JSON
            echo json_encode([
                'success' => true,
                'data' => $consignor
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Consignor not found.'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Consignor ID is required.'
    ]);
}
?>
