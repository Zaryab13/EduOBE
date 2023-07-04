<?php
    $semester = $_POST["semester"];
    $term = $_POST["term"];
    $courseCode = $_POST["courseCode"];
    $courseType = $_POST["courseType"];
    $credits = $_POST["credits"];

    $BOScode = $_GET['clickdBOSCode'];

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    


// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS EDUOBE.BOSDetail(
        semester VARCHAR(50),
        term VARCHAR(25),
        course_code VARCHAR(50),
        course_type VARCHAR(25),
        credits INT(25),
        BOS_code VARCHAR(25),
        PRIMARY KEY (course_code,BOS_code)
        )";

    // Prepare and execute create table query
    $createTableStmt = $conn->prepare($createTableQuery);
    if (!$createTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$createTableStmt->execute()) {
        die("Execute failed: " . $createTableStmt->error);
    }
    $createTableStmt->close();

    // Insert data query
    $insertDataQuery = "INSERT INTO EDUOBE.BOSDetail (semester, term, course_code, course_type, credits, BOS_code)
        VALUES (?,?,?,?,?,?)";

    // Prepare and execute insert data query
    $insertDataStmt = $conn->prepare($insertDataQuery);
    $insertDataStmt->bind_param("ssssis", $semester, $term, $courseCode, $courseType, $credits, $BOScode);
    if (!$insertDataStmt) {
        die("Prepare failed: " . $conn->error);
    }
    if (!$insertDataStmt->execute()) {
        die("Execute failed: " . $insertDataStmt->error);
    }else{
        // -------------------->  Success
        // echo "Success";
        $redirectURL = "coordinator-BOS-Managment-bos-details.php?clickedBOSCode=" . urlencode($BOScode)."&userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo;
        header("Location: " . $redirectURL);
        // // header("Location: coordinator-BOS-Managment-bos-details.php");
        // // echo "Location: coordinator-BOS-Managment-bos-details.php?clickdBOSCode=".$BOScode;
        // echo $redirectURL;
    }
    // Perform your desired operations with each selected option
    

    $insertDataStmt->close();
    $conn->close();
}

?>
