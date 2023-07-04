<?php
$semester = $_POST["semester"];
$term = $_POST["term"];
$courseCode = $_POST["courseCode"];
$courseType = $_POST["courseType"];
$credits = $_POST["credits"];

$bosCode= $_GET['clickdBOSCode'];

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
        UPDATE eduobe.bosdetail
            SET semester = '$semester',
            term  = '$term',
            course_type = '$courseType',
            credits = '$credits'
        WHERE  course_code = '$courseCode' AND BOS_code = '$bosCode'";

    // Prepare and execute create table query
    $updateTableStmt = $conn->prepare($updateTableQuery);
    if (!$updateTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$updateTableStmt->execute()) {
        die("Execute failed: " . $updateTableStmt->error);
    }else{
        // -------------------->  Success
        $redirectURL = "coordinator-BOS-Managment-bos-details.php?clickedBOSCode=" . urlencode($bosCode)."&userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo;
        // echo $updateTableStmt;
        header("Location: " . $redirectURL);
    }

    $conn->close();

}

?>
