<?php
$code = $_POST["code"];
$name = $_POST["name"];
$deliveryFormate = $_POST["deliveryFormate"];
$courseLevel = $_POST["courseLevel"];

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
        UPDATE eduobe.courses
            SET name = '$name',
            delivery_formate = '$deliveryFormate',
            course_level =  '$courseLevel'
        WHERE code = '$code'";

    // Prepare and execute create table query
    $updateTableStmt = $conn->prepare($updateTableQuery);
    if (!$updateTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$updateTableStmt->execute()) {
        die("Execute failed: " . $updateTableStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-Course-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    }

    $conn->close();

}

?>
