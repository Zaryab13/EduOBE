<?php
$programCode = $_GET['programCode'];
// echo $user_name;
$username = $_GET["userName"];




// echo $programCode;
// echo $username;
// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Delete query
    $deleteQuery = "
        DELETE FROM eduobe.program
        WHERE program_code = ?
    ";

    // Prepare and execute delete query
    $deleteStmt = $conn->prepare($deleteQuery);
    if (!$deleteStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $deleteStmt->bind_param("s", $programCode);
    if (!$deleteStmt->execute()) {
        die("Execute failed: " . $deleteStmt->error);
    } else {
        header("Location: coordinator-Program-Managment.php?userName=".$username);
        // echo "Record deleted successfully.";
        // Redirect or perform any other actions after the delete
    }

    $deleteStmt->close();
    $conn->close();
}
?>