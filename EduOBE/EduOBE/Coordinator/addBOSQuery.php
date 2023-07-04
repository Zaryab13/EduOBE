<?php
    $code = $_POST["code"];
    $name = $_POST["name"];
    $career = $_POST["career"];
    $scheme = $_POST["scheme"];
    $program = $_POST["program"];
    $isOBE = 1;

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    

// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $createTableQuery ="
        CREATE TABLE IF NOT EXISTS eduobe.BOS (
        code VARCHAR(50),
        name VARCHAR(50),
        career VARCHAR(500),
        scheme VARCHAR(50),
        program VARCHAR(50),
        isOBE BOOLEAN
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
    $insertDataQuery = "INSERT INTO EDUOBE.BOS (code, name, career, scheme, program, isOBE)
        VALUES (?,?,?,?,?,?)";

    // Prepare and execute insert data query
    $insertDataStmt = $conn->prepare($insertDataQuery);
    $insertDataStmt->bind_param("sssssi", $code, $name, $career, $scheme, $program, $isOBE);
    if (!$insertDataStmt) {
        die("Prepare failed: " . $conn->error);
    }
    if (!$insertDataStmt->execute()) {
        die("Execute failed: " . $insertDataStmt->error);
    }else{
        // -------------------->  Success
        // echo "Success";
        header("Location: coordinator-BOS-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    }
    // Perform your desired operations with each selected option
    

    $insertDataStmt->close();
    $conn->close();
}

?>
