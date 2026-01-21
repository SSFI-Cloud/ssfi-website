<?php
header('Content-Type: application/json');
include '../../config/config.php'; // Adjust this path if necessary
$response = ["success" => false, "message" => ""];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['client_id'], $data['product_id'], $data['place'], $data['state_ids'])) {
            throw new Exception("Invalid input data");
        }

        foreach ($data as $key => $values) {
            if (strpos($key, '_s_range') !== false && is_array($values)) {
                $parts = explode('_', $key);
                $ship_type = ucfirst($parts[1]); // Local or Air
                $parcel_type = ucfirst($parts[0]); // Parcel or Document
                
                $ps = $parts[0] . "_" . $parts[1];
                $id_key = $ps . "_id";

                foreach ($values as $index => $start_wt) {
                    $existing_id = $data[$id_key][$index] ?? 0;

                    if ($existing_id !== null && $existing_id != 0) {
                        // Update existing record
                        $stmt = $pdo->prepare("UPDATE tbl_rate_card SET start_wt = :start_wt, end_wt = :end_wt, min_wt = :min_wt, min_rate = :min_rate, addon_wt = :addon_wt, addon_rate = :addon_rate, ship_type = :ship_type, parcel_type = :parcel_type, state_ids = :state_ids, place = :place WHERE id = :id");
                        $stmt->execute([
                            ':id' => $existing_id,
                            ':start_wt' => $start_wt,
                            ':end_wt' => $data[$ps.'_e_range'][$index] ?? 0,
                            ':min_wt' => $data[$ps.'_min_wt'][$index] ?? 0,
                            ':min_rate' => $data[$ps.'_min_rate'][$index] ?? 0,
                            ':addon_wt' => $data[$ps.'_addon_wt'][$index] ?? 0,
                            ':addon_rate' => $data[$ps.'_addon_rate'][$index] ?? 0,
                            ':ship_type' => $ship_type,
                            ':parcel_type' => $parcel_type,
                            ':state_ids' => $data['state_ids'],
                            ':place' => $data['place']
                        ]);
                    } else {
                        // Insert new record
                        $stmt = $pdo->prepare("INSERT INTO tbl_rate_card (client_id, product_id, start_wt, end_wt, min_wt, min_rate, addon_wt, addon_rate, ship_type, parcel_type, state_ids, place) 
                                                VALUES (:client_id, :product_id, :start_wt, :end_wt, :min_wt, :min_rate, :addon_wt, :addon_rate, :ship_type, :parcel_type, :state_ids, :place)");
                        $stmt->execute([
                            ':client_id' => $data['client_id'],
                            ':product_id' => $data['product_id'],
                            ':start_wt' => $start_wt,
                            ':end_wt' => $data[$ps.'_e_range'][$index] ?? 0,
                            ':min_wt' => $data[$ps.'_min_wt'][$index] ?? 0,
                            ':min_rate' => $data[$ps.'_min_rate'][$index] ?? 0,
                            ':addon_wt' => $data[$ps.'_addon_wt'][$index] ?? 0,
                            ':addon_rate' => $data[$ps.'_addon_rate'][$index] ?? 0,
                            ':ship_type' => $ship_type,
                            ':parcel_type' => $parcel_type,
                            ':state_ids' => $data['state_ids'],
                            ':place' => $data['place']
                        ]);
                    }
                }
            }
        }

        $response["success"] = true;
        $response["message"] = "Data processed successfully.";
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    $response["message"] = $e->getMessage();
}

echo json_encode($response);
