<?php
session_start();
include('../dbconn/dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    // Get form data
    $accountName = $_POST["accountName"];
    $accountSector = $_POST["accountSector"];
    $projectName = $_POST["projectName"];

    // Prepare and execute SQL query
    $checkSql = "SELECT * FROM account WHERE AccountName = '$accountName'";
    $result = $dbconn->query($checkSql);

    if ($result->num_rows > 0) {
        echo "Account already exists in the database.";
    } else {
        // Prepare and execute SQL query
        $insertSql = "INSERT INTO account (AccountName, AccountSector, Project) VALUES ('$accountName', '$accountSector', '$projectName')";

        if ($dbconn->query($insertSql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertSql . "<br>" . $dbconn->error;
        }
    }

    // Close connection
    $dbconn->close();
}
?>
