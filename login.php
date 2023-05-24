<?php
$email = $_POST["Email"];
$password = $_POST["Password"];

// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    $qry = $conn->prepare("SELECT * FROM eduobe.superadmin WHERE Email = ? AND Password = SHA2(?, 256)");
    if (!$qry) {
        die("Prepared statement error: " . $conn->error);
    }
    $qry->bind_param("ss", $email, $password);
    if (!$qry->execute()) {
        die("Execution error: " . $qry->error);
    }
    $result = $qry->get_result();
    if ($result->num_rows > 0) {
        // Authentication successful
        header("Location: Admin.html");
        exit();
    } else {
        // Authentication failed
        header("Location: login.html?error=1");
        exit();
    }
}
?>
