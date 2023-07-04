<?php
    $code = $_POST["code"];
    $name = $_POST["name"];
    $deliveryFormate = $_POST["deliveryFormate"];
    $courseLevel = $_POST["courseLevel"];

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    

    // echo $code;

    // Database connection
    $conn = new mysqli("localhost", "root", "", "eduobe");
    if ($conn->connect_error) {
        die("Failed to connect: " . $conn->connect_error);
    } else {
        // Create table query
        $createTableQuery ="
            CREATE TABLE IF NOT EXISTS eduobe.courses (
            code VARCHAR(25) PRIMARY KEY,
            name VARCHAR(50),
            delivery_formate VARCHAR(500),
            course_level VARCHAR(50)
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
        $insertDataQuery = "INSERT INTO EDUOBE.courses (code, name, delivery_formate, course_level)
            VALUES (?,?,?,?)";

        // Prepare and execute insert data query
        $insertDataStmt = $conn->prepare($insertDataQuery);
        $insertDataStmt->bind_param("ssss", $code, $name, $deliveryFormate, $courseLevel);
        if (!$insertDataStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$insertDataStmt->execute()) {
            die("Execute failed: " . $insertDataStmt->error);
        }else{
            // -------------------->  Success
            // echo "Success";
            header("Location: coordinator-Course-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
        }
        // Perform your desired operations with each selected option
        

        $insertDataStmt->close();
        $conn->close();
    }

?>
