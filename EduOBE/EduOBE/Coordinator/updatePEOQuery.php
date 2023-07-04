<?php
$peoCode = $_POST["peoCode"];
$peoName = $_POST["peoName"];
$ref_peo_Program = $_POST["peoProgram"];
$peoDescription = $_POST["peoDescription"];

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
        UPDATE eduobe.PEO
            SET name = '$peoName',
            description = '$peoDescription',
            ref_program_code =  '$ref_peo_Program'
        WHERE PEO_code = '$peoCode'";

    // Prepare and execute create table query
    $updateTableStmt = $conn->prepare($updateTableQuery);
    if (!$updateTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$updateTableStmt->execute()) {
        die("Execute failed: " . $updateTableStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-PEO-PLO-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    }

    $conn->close();

}

?>
