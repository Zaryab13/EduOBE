<?php
    $batchId = $_POST["batchId"];
    $name = $_POST["name"];
    $numOfStudent = $_POST["numOfStudent"];
    $startingDate = $_POST["startingDate"];
    $endingDate = $_POST["endingDate"];
    $program = $_POST["program"];
    $BOS = $_POST["BOS"];
    $semester = $_POST["semester"];
    

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
        $createTableQuery ="
        CREATE TABLE IF NOT EXISTS eduobe.Batch (
            batch_id VARCHAR(25) PRIMARY KEY,
            name VARCHAR(50),
            num_of_std VARCHAR(25),
            starting_date VARCHAR(25),
            ending_date VARCHAR(25),
            program VARCHAR(25),
            bos VARCHAR(25),
            semester VARCHAR(25),
            FOREIGN KEY (bos) REFERENCES eduobe.BOS(code),
            FOREIGN KEY (program) REFERENCES eduobe.program(program_code)
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
        $insertDataQuery = "INSERT INTO EDUOBE.Batch (batch_id, name, num_of_std, starting_date, ending_date, program, bos, semester)
            VALUES (?,?,?,?,?,?,?,?)";

        // Prepare and execute insert data query
        $insertDataStmt = $conn->prepare($insertDataQuery);
        $insertDataStmt->bind_param("ssssssss",$batchId, $name, $numOfStudent, $startingDate, $endingDate, $program, $BOS, $semester);
        if (!$insertDataStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$insertDataStmt->execute()) {
            die("Execute failed: " . $insertDataStmt->error);
        }else{
            // -------------------->  Success
            // echo "Success";
            header("Location: coordinator-Batch-Management.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo."&batchName=".$batch_name);
        }
        // Perform your desired operations with each selected option
        

        $insertDataStmt->close();
        $conn->close();
    }
?>
