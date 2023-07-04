<?php
    $Reg_No = $_GET["Reg_No"];

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    $batch = $_GET["batchName"];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "eduobe");
    if ($conn->connect_error) {
        die("Failed to connect: " . $conn->connect_error);
    } else {
        // Delete query
        $deleteQuery = "
            DELETE FROM eduobe.Students
            WHERE Reg_No = ?
        ";

        // Prepare and execute delete query
        $deleteStmt = $conn->prepare($deleteQuery);
        if (!$deleteStmt) {
            die("Prepare failed: " . $conn->error);
        }

        $deleteStmt->bind_param("s", $Reg_No);
        if (!$deleteStmt->execute()) {
            die("Execute failed: " . $deleteStmt->error);
        } else {
            header("Location: coordinator-Student-Managment-batch-students-list.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo."&batchName=".$batch);
            // echo "Record deleted successfully.";
            // Redirect or perform any other actions after the delete
        }

        $deleteStmt->close();
        $conn->close();
    }
?>