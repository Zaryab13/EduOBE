<?php
$courseCode = $_GET['code'];
$BOSCode= $_GET['clickdBOSCode'];

$username = $_GET["userName"];
$uni_logo = $_GET["uniLogo"];
$deptt_logo = $_GET["depttLogo"];

// echo $courseCode." ------  ";
// echo $BOSCode;
// echo $code;
// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Delete query
    $deleteQuery = "
        DELETE FROM eduobe.bosdetail
        WHERE course_code = ? AND BOS_code = ?
    ";

    // Prepare and execute delete query
    $deleteStmt = $conn->prepare($deleteQuery);
    if (!$deleteStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $deleteStmt->bind_param("ss",$courseCode,$BOSCode);
    if (!$deleteStmt->execute()) {
        die("Execute failed: " . $deleteStmt->error);
    } else {
        $redirectURL = "coordinator-BOS-Managment-bos-details.php?clickedBOSCode=" . urlencode($BOSCode)."&userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo;
        // echo $updateTableStmt;
        header("Location: " . $redirectURL);
    }

    $deleteStmt->close();
    $conn->close();
}
?>