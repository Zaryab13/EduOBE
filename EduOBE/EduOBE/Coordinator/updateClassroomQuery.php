<?php
    $batchId = $_POST['batchId'];
    $semester = $_POST['semester'];
    $courseId = $_POST['courseId'];
    $term = $_POST['term'];
    $teacherName = $_POST['teacherName'];
    // $isActive = 1;

    // echo $batchId;
    // echo $semester;
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
            UPDATE eduobe.classroom
                set semester = '$semester',
                course_id = '$courseId',
                term = '$term',
                teacher_name = '$teacherName'
            WHERE batch_id = '$batchId'";

        // Prepare and execute create table query
        $updateTableStmt = $conn->prepare($updateTableQuery);
        if (!$updateTableStmt) {
            die("Prepare failed: " . $conn->error);
        }

        if (!$updateTableStmt->execute()) {
            die("Execute failed: " . $updateTableStmt->error);
        }else{
            // -------------------->  Success
            header("Location: coordinator-Classroom-Management.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
        }
        $conn->close();

    }
?>