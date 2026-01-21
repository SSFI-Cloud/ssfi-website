<?php
require_once '../../config/config.php';

try {
    $event_id = 12; // Static for now — can be dynamic later
    $categoryFilter = isset($_GET['category']) ? trim($_GET['category']) : '';

    $sql = "
    SELECT * FROM (
        -- Category Group
        SELECT 
            1 AS sort_order,
            ct.cat_name AS group_header,
            '' AS membership_id,
            '' AS full_name,
            '' AS date_of_birth,
            '' AS cat_name,
            '' AS age,
            '' AS age_category,
            '' AS gender,
            '' AS club_name,
            '' AS district_name,
            '' AS payment_id,
            '' AS created_at,
            ct.cat_name AS sort_cat,
            '' AS sort_age,
            '' AS sort_gender,
            '' AS sort_name
        FROM tbl_event_registration er
        LEFT JOIN tbl_skaters s ON er.skater_id = s.id
        LEFT JOIN tbl_clubs c ON s.club_id = c.id
        LEFT JOIN tbl_districts ddd ON ddd.id = s.district_id
        LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
        LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id
        WHERE er.event_id = :event_id 
          AND er.payment_id IS NOT NULL
          " . (!empty($categoryFilter) ? " AND ct.cat_name = :cat_name " : "") . "
        GROUP BY ct.cat_name

        UNION ALL

        -- Age Group
        SELECT 
            2 AS sort_order,
            CONCAT('  ', sr.age_category) AS group_header,
            '' AS membership_id,
            '' AS full_name,
            '' AS date_of_birth,
            '' AS cat_name,
            '' AS age,
            '' AS age_category,
            '' AS gender,
            '' AS club_name,
            '' AS district_name,
            '' AS payment_id,
            '' AS created_at,
            ct.cat_name AS sort_cat,
            sr.age_category AS sort_age,
            '' AS sort_gender,
            '' AS sort_name
        FROM tbl_event_registration er
        LEFT JOIN tbl_skaters s ON er.skater_id = s.id
        LEFT JOIN tbl_clubs c ON s.club_id = c.id
        LEFT JOIN tbl_districts ddd ON ddd.id = s.district_id
        LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
        LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id
        WHERE er.event_id = :event_id 
          AND er.payment_id IS NOT NULL
          " . (!empty($categoryFilter) ? " AND ct.cat_name = :cat_name " : "") . "
        GROUP BY ct.cat_name, sr.age_category

        UNION ALL

        -- Gender Group
        SELECT 
            3 AS sort_order,
            CONCAT('    ', s.gender) AS group_header,
            '' AS membership_id,
            '' AS full_name,
            '' AS date_of_birth,
            '' AS cat_name,
            '' AS age,
            '' AS age_category,
            s.gender AS gender,
            '' AS club_name,
            '' AS district_name,
            '' AS payment_id,
            '' AS created_at,
            ct.cat_name AS sort_cat,
            sr.age_category AS sort_age,
            s.gender AS sort_gender,
            '' AS sort_name
        FROM tbl_event_registration er
        LEFT JOIN tbl_skaters s ON er.skater_id = s.id
        LEFT JOIN tbl_clubs c ON s.club_id = c.id
        LEFT JOIN tbl_districts ddd ON ddd.id = s.district_id
        LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
        LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id
        WHERE er.event_id = :event_id 
          AND er.payment_id IS NOT NULL
          " . (!empty($categoryFilter) ? " AND ct.cat_name = :cat_name " : "") . "
        GROUP BY ct.cat_name, sr.age_category, s.gender

        UNION ALL

        -- Skater Rows (unique per membership_id)
        SELECT 
            4 AS sort_order,
            '' AS group_header,
            s.membership_id,
            s.full_name,
            s.date_of_birth,
            ct.cat_name,
            sr.age,
            sr.age_category,
            s.gender,
            c.club_name,
            ddd.district_name,
            MIN(er.payment_id) AS payment_id,
            MIN(er.created_at) AS created_at,
            ct.cat_name AS sort_cat,
            sr.age_category AS sort_age,
            s.gender AS sort_gender,
            s.full_name AS sort_name
        FROM tbl_event_registration er
        LEFT JOIN tbl_skaters s ON er.skater_id = s.id
        LEFT JOIN tbl_clubs c ON s.club_id = c.id
        LEFT JOIN tbl_districts ddd ON ddd.id = s.district_id
        LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
        LEFT JOIN tbl_category_type ct ON ct.id = eel.category_type_id
        LEFT JOIN tbl_session_renewal sr ON sr.skater_id = s.id AND sr.session_id = er.session_id
        WHERE er.event_id = :event_id 
          AND er.payment_id IS NOT NULL
          " . (!empty($categoryFilter) ? " AND ct.cat_name = :cat_name " : "") . "
        GROUP BY s.membership_id
    ) AS full_result
    ORDER BY sort_cat, sort_age, sort_gender, sort_order, sort_name
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
    if (!empty($categoryFilter)) {
        $stmt->bindValue(':cat_name', $categoryFilter, PDO::PARAM_STR);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ✅ Define event levels
    $eventLevelsList = ['200 M', '400 M', '1000 M', 'Road Race 100 M', 'Point to Point', 'Road Race 2000 M'];

    // ✅ Populate levels (YES/NO) and make sure membership_id rows are unique
    foreach ($data as &$row) {
        foreach ($eventLevelsList as $level) {
            $row[$level] = '';
        }

        if (!empty($row['membership_id'])) {
            $stmtSkaterId = $pdo->prepare("SELECT id FROM tbl_skaters WHERE membership_id = :membership_id LIMIT 1");
            $stmtSkaterId->execute([':membership_id' => $row['membership_id']]);
            $skater_id = $stmtSkaterId->fetchColumn();

            if ($skater_id) {
                $stmtLevels = $pdo->prepare("
                    SELECT eel.event_level
                    FROM tbl_event_registration er
                    LEFT JOIN tbl_eligible_event_level eel ON eel.id = er.eligible_event_level_id
                    WHERE er.skater_id = :skater_id AND er.event_id = :event_id
                ");
                $stmtLevels->execute([
                    ':skater_id' => $skater_id,
                    ':event_id' => $event_id
                ]);
                $skaterEventLevels = $stmtLevels->fetchAll(PDO::FETCH_COLUMN);

                foreach ($skaterEventLevels as $levelName) {
                    if (in_array($levelName, $eventLevelsList)) {
                        $row[$levelName] = 'YES';
                    }
                }
            }
        }
    }

    echo json_encode([
        "status" => "success",
        "data" => $data
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
