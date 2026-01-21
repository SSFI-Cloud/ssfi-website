<?php
$host = 'localhost';
$dbname = 'ssfibharat_dashboard';
$username = 'root';
$password = '';

// Set up a PDO connection 

// Define global variable for database connection
global $pdo;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get current SQL mode
    $stmt = $pdo->query("SELECT @@sql_mode");
    $currentModes = $stmt->fetchColumn();
    $modesArray = explode(',', $currentModes);

    // Remove ONLY_FULL_GROUP_BY if present
    $newModesArray = array_diff($modesArray, ['ONLY_FULL_GROUP_BY']);
    $newModeString = implode(',', $newModesArray);

    // Set the new SQL mode
    $pdo->exec("SET sql_mode = '$newModeString'");
    
    
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
