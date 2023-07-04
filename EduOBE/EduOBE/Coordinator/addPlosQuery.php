<?php
$ploCode = $_POST["PLO_Code"];
$ploName = $_POST["PLO_Name"];
$description = $_POST["PLO_Description"];
$KPI = $_POST["KPI"];
$peoId = $_POST["PEO_Id"];

// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $createTableQuery = "
    CREATE TABLE IF NOT EXISTS EDUOBE.PLOs (
        code VARCHAR(50) PRIMARY KEY,
        name VARCHAR(100),
        description VARCHAR(500),
        KPI VARCHAR(100),
        mapping_peos_id INT,
        FOREIGN KEY (mapping_peos_id) REFERENCES PEO(mapping_peos_id))";

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
    $insertDataQuery = "INSERT INTO EDUOBE.PLOs (code, name, description, KPI, mapping_peos_id)
        VALUES (?,?,?,?,?)";

    // Prepare and execute insert data query
    $insertDataStmt = $conn->prepare($insertDataQuery);
    if (!$insertDataStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $insertDataStmt->bind_param("ssssi", $ploCode, $ploName, $description, $KPI, $peoId);
    if (!$insertDataStmt->execute()) {
        die("Execute failed: " . $insertDataStmt->error);
    }else{
        header("Location: coordinator-PEO-PLO-Managment.html");
    }

    $insertDataStmt->close();
    $conn->close();
}

?>
