<?php

error_log(json_encode($_POST));    
require_once __DIR__ . '/../../config/config.php';

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from POST data
    
    error_log(json_encode($_POST));    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to fetch user based on the provided username
    $stmt = $pdo->prepare("SELECT username, password FROM `tbl_user` WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    try {
        // Execute the query
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if ($user) {
            // Verify the password (assuming passwords are hashed in the database)
            if ($password == $user['password']) {
                $_SESSION['username'] = $user['username'];  // Store username in session
                echo json_encode(['success' => true]); // Send success response
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid password.']);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Username not found.']);
            exit();
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit();
}
?>
