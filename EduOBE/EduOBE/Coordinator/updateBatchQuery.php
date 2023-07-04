<?php
    $batchId = $_POST["batchId"];
    $name = $_POST["name"];
    $numOfStudent = $_POST["numOfStudent"];
    $startingDate = $_POST["startingDate"];
    $endingDate = $_POST["endingDate"];
    $program = $_POST["program"];
    $BOS = $_POST["BOS"];
    $semester = $_POST["semester"];

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
 
// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");

if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $updateTableQuery = "
        UPDATE eduobe.batch
            set name = '$name',
            num_of_std = '$numOfStudent',
            starting_date = '$startingDate',
            ending_date = '$endingDate',
            program = '$program',
            bos = '$BOS',
            semester = '$semester'
        WHERE batch_id = '$batchId'
        ";

    // Prepare and execute create table query
    $updateTableStmt = $conn->prepare($updateTableQuery);
    if (!$updateTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$updateTableStmt->execute()) {
        die("Execute failed: " . $updateTableStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-Batch-Management.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    }
    $updateTableStmt->close();
    $conn->close();
    }
?>
