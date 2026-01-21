<?php  ob_start();
session_start(); 
require_once __DIR__ . '/../../config/config.php';

// Check if the form is submitted via POST
if ("POST" == "POST") {
    // Get username and password from POST data
     
    $username = $_POST['username']?? '';
    $password = $_POST['password']?? '';

    // Prepare the SQL statement to fetch user based on the provided username
    $stmt = $pdo->prepare("SELECT * FROM `tbl_user` WHERE username = :username and password = :password");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    try {
        // Execute the query
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // Check if user exists
        if ($user) {
            //if ($password == $user['password']) {
                $_SESSION['username'] = $user['username'];  
                $_SESSION['user_id'] = $user['user_id'];  
                $_SESSION['role_id'] = $user['role_id']; 
                $_SESSION['state_id'] = $user['state_id'];
                $_SESSION['district_id'] = $user['district_id'];
                $_SESSION['club_id'] = $user['club_id'];
                $_SESSION['ssfi'] = $user;
                
                
                
                echo json_encode(['status' => 'success','message' => 'Logged in successfully.']); // Send success response
                exit();
            /*} else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid password.']);
                exit();
            }*/
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User credentials not found.']);
            exit();
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}
?>