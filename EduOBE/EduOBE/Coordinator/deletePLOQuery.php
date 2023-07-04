<?php
 $ploCode = $_GET["PLOCode"];

 $username = $_GET["userName"];
$uni_logo = $_GET["uniLogo"];
$deptt_logo = $_GET["depttLogo"];
// echo $user_name;


// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Delete query
    $deleteQuery = "
        DELETE FROM eduobe.PLOS
        WHERE PLO_code = ?";

    // Prepare and execute delete query
    $deleteStmt = $conn->prepare($deleteQuery);
    if (!$deleteStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $deleteStmt->bind_param("s", $ploCode);
    if (!$deleteStmt->execute()) {
        die("Execute failed: " . $deleteStmt->error);
    } else {
        header("Location: coordinator-PEO-PLO-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
        // echo "Record deleted successfully.";
        // Redirect or perform any other actions after the delete
    }

    $deleteStmt->close();
    $conn->close();
}
?>