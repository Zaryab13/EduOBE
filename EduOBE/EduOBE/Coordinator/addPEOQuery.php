<?php
$peoCode = $_POST["peoCode"];
$peoName = $_POST["peoName"];
$ref_peoProgram = $_POST["peoProgram"];
$peoDescription = $_POST["peoDescription"];

$username = $_GET["userName"];
$uni_logo = $_GET["uniLogo"];
$deptt_logo = $_GET["depttLogo"];

// echo $peoCode;
// echo $peoName;
// echo $peoProgram;
// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS EDUOBE.PEO (
        PEO_code VARCHAR(50) PRIMARY KEY,
        name VARCHAR(100),
        description VARCHAR(500),
        ref_program_code VARCHAR(25),
        FOREIGN KEY (ref_program_code) REFERENCES eduobe.program(program_code)
      )";

    // Prepare and execute create table query
    $createTableStmt = $conn->prepare($createTableQuery);
    if (!$createTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$createTableStmt->execute()) {
        die("Execute failed: " . $createTableStmt->error);
    }
    $createTableStmt->close();

    // Insert data query
    $insertDataQuery = "INSERT INTO EDUOBE.PEO (PEO_code, name, description, ref_program_code)
        VALUES (?,?,?,?)";

    // Prepare and execute insert data query
    $insertDataStmt = $conn->prepare($insertDataQuery);
    if (!$insertDataStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $insertDataStmt->bind_param("ssss", $peoCode, $peoName, $peoDescription, $ref_peoProgram);
    if (!$insertDataStmt->execute()) {
        die("Execute failed: " . $insertDataStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-PEO-PLO-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
        // echo "success";
    }

    $insertDataStmt->close();
    $conn->close();
}

?>
