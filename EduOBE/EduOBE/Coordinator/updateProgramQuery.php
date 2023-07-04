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
        UPDATE eduobe.program
        SET program_name = '$programName',
            type ='$type',
            number_of_semester =  '$numOfSemester',
            program_level = '$progLevel',
            Assessment_method = '$assesMethod' ,
            passing_marks_per = '$passingMarksPer',
            learning_type = '$learningfType'
        WHERE program_code = '$programCode'";

    // Prepare and execute create table query
    $createTableStmt = $conn->prepare($createTableQuery);
    if (!$createTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$createTableStmt->execute()) {
        die("Execute failed: " . $createTableStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-Program-Managment.php?userName=".$username);
    }

    $conn->close();

}
?>
