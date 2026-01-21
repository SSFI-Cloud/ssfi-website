<?php
// Include the database connection file
require_once '../../config/config.php';

header('Content-Type: application/json');

try {
    // Retrieve JSON POST data
    $postData = json_decode(file_get_contents('php://input'), true);
    
    // Validate required parameters
    $requiredParams = ['ship_type', 'parcel_type', 'state_ids', 'place', 'client_id', 'product_id'];
    foreach ($requiredParams as $param) {
        if (!isset($postData[$param]) || empty($postData[$param])) {
            echo json_encode(["error" => "Missing required parameter: $param"]);
            exit;
        }
    }

    // Assign POST values to variables
    $ship_type = $postData['ship_type'];
    $parcel_type = $postData['parcel_type'];
    $state_ids = $postData['state_ids']; // This should be a comma-separated list of state IDs
    $place = $postData['place'];
    $client_id = $postData['client_id'];
    $product_id = $postData['product_id'];

    // Pagination (optional)
    $limit = isset($postData['limit']) ? (int)$postData['limit'] : 10; // Default 10 records per page
    $offset = isset($postData['offset']) ? (int)$postData['offset'] : 0; // Default start at 0

    // Prepare SQL query with filters
    $sql = "SELECT * FROM tbl_rate_card 
            WHERE ship_type = :ship_type 
              AND parcel_type = :parcel_type 
              AND client_id = :client_id 
              AND product_id = :product_id 
              AND FIND_IN_SET(:place, place) > 0 
              AND FIND_IN_SET(:state_ids, state_ids) > 0 
            LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':ship_type', $ship_type, PDO::PARAM_STR);
    $stmt->bindParam(':parcel_type', $parcel_type, PDO::PARAM_STR);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->bindParam(':place', $place, PDO::PARAM_STR);
    $stmt->bindParam(':state_ids', $state_ids, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    
    // Execute the query
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total records count
    $countQuery = "SELECT COUNT(*) as total FROM tbl_rate_card 
                   WHERE ship_type = :ship_type 
                     AND parcel_type = :parcel_type 
                     AND client_id = :client_id 
                     AND product_id = :product_id 
                     AND FIND_IN_SET(:place, place) > 0 
                     AND FIND_IN_SET(:state_ids, state_ids) > 0";
    $countStmt = $pdo->prepare($countQuery);
    
    // Bind parameters for count query
    $countStmt->bindParam(':ship_type', $ship_type, PDO::PARAM_STR);
    $countStmt->bindParam(':parcel_type', $parcel_type, PDO::PARAM_STR);
    $countStmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $countStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $countStmt->bindParam(':place', $place, PDO::PARAM_STR);
    $countStmt->bindParam(':state_ids', $state_ids, PDO::PARAM_STR);
    
    $countStmt->execute();
    $totalRecords = $countStmt->fetchColumn();

    // Return JSON response
    echo json_encode([
        "recordsTotal" => (int)$totalRecords,
        "data" => $data
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "An unexpected error occurred: " . $e->getMessage()]);
}
