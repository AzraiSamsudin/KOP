<?php
session_start();
include('../dbconn/dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    // Get form data
    $promiseOwner = $_POST["PromiseOwner"];
    $account = $_POST["Account"];
    $PromiseMadeTo = $_POST["madeTo"];
    $DesignationLevel = $_POST["Designation-level"];
    $category = $_POST["Category"];
    $Description = $_POST["Description"];
    $DueDate = $_POST["duedate"];
    $ActionBy = $_POST["actionBy"];
    $Status = $_POST["status"];
    $Remark = $_POST["Remark"];
   

    // Insert into promise_detail table
    $sql2 = "INSERT INTO promise_detail (Promise_Description, Designation_Level, DueDate, ActionBy, Status, Remark) 
            VALUES ('$Description', '$DesignationLevel', '$DueDate', '$ActionBy', '$Status', '$Remark')";

    // Execute the SQL query for promise_detail
    if ($dbconn->query($sql2) === TRUE) {
        // Retrieve the auto-generated Promise_ID from the last insert operation
        $lastInsertedID = $dbconn->insert_id;

        // Insert into promises table, referencing the auto-generated Promise_ID
        $sql = "INSERT INTO promises (Promise_ID, AccountName, Promise_Owner, Client_Name, Category_Promise) 
                VALUES ('$lastInsertedID', '$account', '$promiseOwner', '$PromiseMadeTo', '$category')";

        // Execute the SQL query for promises
        if ($dbconn->query($sql) === TRUE) {
            echo "Record inserted successfully.";
        } else {
            echo "Error inserting record into promises table: " . $dbconn->error;
        }
    } else {
        echo "Error inserting record into promise_detail table: " . $dbconn->error;
    }

    // Close connection
    $dbconn->close();
}
?>
