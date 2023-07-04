<?php
    $programCode = $_POST['programCode'];
    $programName = $_POST["programName"];
    $type = $_POST["type"];
    $passingMarksPer = $_POST["passingMarksPer"];
    $numOfSemester = $_POST["numOfSemester"];
    $progLevel = $_POST["progLevel"];
    $assesMethod = $_POST["assesMethod"];
    $learningfType = $_POST["learningType"];

    $username = $_GET["userName"];

// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");

if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $createTableQuery = "
    CREATE TABLE IF NOT EXISTS EDUOBE.program (
        program_code VARCHAR(25) NOT NULL PRIMARY KEY,
        program_name VARCHAR(100),
        type VARCHAR(50),
        number_of_semester varchar(15),
        program_level VARCHAR(50),
        assessment_method VARCHAR(100),
        passing_marks_per VARCHAR(25),
        learning_type VARCHAR(100)
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
    $insertDataQuery = "INSERT INTO EDUOBE.program(program_code,program_name, type, number_of_semester, program_level, assessment_method, passing_marks_per, learning_type)
        VALUES (?,?,?,?,?,?,?,?)";

    // Prepare and execute insert data query
    $insertDataStmt = $conn->prepare($insertDataQuery);
    if (!$insertDataStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $insertDataStmt->bind_param("ssssssss", $programCode,$programName, $type, $numOfSemester, $progLevel, $assesMethod, $passingMarksPer, $learningfType);

    if (!$insertDataStmt->execute()) {
        die("Execute failed: " . $insertDataStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-Program-Managment.php?userName=".$username);
    }

    $insertDataStmt->close();
    $conn->close();

}
?>
