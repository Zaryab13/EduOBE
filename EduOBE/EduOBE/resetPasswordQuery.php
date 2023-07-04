<?php
session_start();

$username = $_SESSION["username"];
$password = $_POST['password'];

$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Insert data query
    $updateSuperAdminQuery = "UPDATE eduobe.superadmin SET Password = SHA2('$password', 256) WHERE username = '$username'";
    $updateAdminRegQuery = "UPDATE eduobe.adminregisteration SET password = SHA2('$password', 256) WHERE user_name = '$username'";
    $updateFacultyQuery = "UPDATE eduobe.faculty SET password = SHA2('$password', 256) WHERE username = '$username'";

    $resultSuperAdminQuery = $conn->query($updateSuperAdminQuery);
    $resultAdminRegQuery = $conn->query($updateAdminRegQuery);
    $resultFacultyQuery = $conn->query($updateFacultyQuery);

    $atLeastOneQueryExecuted = ($resultSuperAdminQuery || $resultAdminRegQuery || $resultFacultyQuery);

    if ($atLeastOneQueryExecuted) {
        // At least one query was executed successfully
        header("Location: login.html");
    } else {
        // None of the queries were executed successfully
        header("Location: resetPassword.php");

    }
}
?>
