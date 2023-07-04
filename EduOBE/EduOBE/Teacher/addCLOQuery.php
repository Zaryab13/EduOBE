<?php
    $code = $_POST["code"];
    $name = $_POST["name"];
    $KPI = $_POST["KPI"];
    $domain = $_POST["domain"];
    $bloomTexonomyLevel = $_POST["bloomTexonomyLevel"];
    $description = $_POST["description"];
    

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    $batch_name = $_GET["batchName"];
    // echo $name;
    // echo $numOfStudent;
    // echo $startingDate;
    // echo $endingDate;
    // echo $program;
    // echo $BOS;

    // Database connection
    $conn = new mysqli("localhost", "root", "", "eduobe");
    if ($conn->connect_error) {
        die("Failed to connect: " . $conn->connect_error);
    } else {
        // Create table query
        $createTableQuery ="CREATE TABLE IF NOT EXISTS CLO (
            code VARCHAR(25) PRIMARY KEY,
            name VARCHAR(50),
            KPI VARCHAR(100),
            domain VARCHAR(50),
            bloomTexonomyLevel VARCHAR(50),
            description VARCHAR(500)
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
        $insertDataQuery = "INSERT INTO CLO (code, name, KPI, domain, bloomTexonomyLevel, description)
            VALUES (?,?,?,?,?,?)";

        // Prepare and execute insert data query
        $insertDataStmt = $conn->prepare($insertDataQuery);
        $insertDataStmt->bind_param("ssssss",$code, $name, $KPI, $domain, $bloomTexonomyLevel, $description);
        if (!$insertDataStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$insertDataStmt->execute()) {
            die("Execute failed: " . $insertDataStmt->error);
        }else{
            // -------------------->  Success
            echo "Success";
            // header("Location: coordinator-Batch-Management.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo."&batchName=".$batch_name);
        }
        // Perform your desired operations with each selected option
        

        $insertDataStmt->close();
        $conn->close();
    }
?>
