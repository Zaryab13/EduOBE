<?php
$user_name = $_GET["userName"];
// echo $user_name;


// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Delete query
    $deleteQuery = "
        DELETE FROM eduobe.AdminRegisteration
        WHERE user_name = ?
    ";

    // Prepare and execute delete query
    $deleteStmt = $conn->prepare($deleteQuery);
    if (!$deleteStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $deleteStmt->bind_param("s", $user_name);
    if (!$deleteStmt->execute()) {
        die("Execute failed: " . $deleteStmt->error);
    } else {
        header("Location: SuperAdmin.php");
        // echo "Record deleted successfully.";
        // Redirect or perform any other actions after the delete
    }

    $deleteStmt->close();
    $conn->close();
}
?>