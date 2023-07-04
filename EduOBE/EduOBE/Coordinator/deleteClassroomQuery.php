<?php
    $batchId = $_GET['batchId'];

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];

    // echo $batchId."  ---  ";
    // echo $username."  ---  ";
    // echo $uni_logo."  ---  ";
    // echo $deptt_logo."  ---  ";
    // Database connection
    $conn = new mysqli("localhost", "root", "", "eduobe");
    if ($conn->connect_error) {
        die("Failed to connect: " . $conn->connect_error);
    } else {
        // Delete query
        $deleteQuery = "
            DELETE FROM eduobe.classroom
            WHERE classroom_id = ?
        ";

        // Prepare and execute delete query
        $deleteStmt = $conn->prepare($deleteQuery);
        if (!$deleteStmt) {
            die("Prepare failed: " . $conn->error);
        }

        $deleteStmt->bind_param("s", $batchId);
        if (!$deleteStmt->execute()) {
            die("Execute failed: " . $deleteStmt->error);
        } else {
            header("Location: coordinator-Classroom-Management.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
            // echo "Record deleted successfully.";
            // Redirect or perform any other actions after the delete
        }

        $deleteStmt->close();
        $conn->close();
    }
?>