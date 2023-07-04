<?php
    $ploCode = $_POST["PLOCode"];
    $ploName = $_POST["PLOName"];
    $description = $_POST["PLODescription"];
    $mappToPLO = $_POST["PLOMapping"];
    $KPI = $_POST["PLOKpi"];
    // $array="";
    $PEOData = implode(' ', $mappToPLO);
    // foreach($mappToPLO as $data){
    //     $array += $data;
    //     $array += ",";
    // }
    // echo $array; 
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
        CREATE TABLE IF NOT EXISTS EDUOBE.PLOs(
        PLO_code VARCHAR(50),
        name VARCHAR(100),
        description VARCHAR(500),
        KPI VARCHAR(100),
        mapp_to_peos VARCHAR(50),
        PRIMARY KEY (PLO_code)
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
    $insertDataQuery = "INSERT INTO EDUOBE.PLOs (PLO_code, name, description, KPI, mapp_to_peos)
        VALUES (?,?,?,?,?)";

    // Prepare and execute insert data query
    $insertDataStmt = $conn->prepare($insertDataQuery);
    $insertDataStmt->bind_param("sssss", $ploCode, $ploName, $description, $KPI, $PEOData);
    if (!$insertDataStmt) {
        die("Prepare failed: " . $conn->error);
    }
    if (!$insertDataStmt->execute()) {
        die("Execute failed: " . $insertDataStmt->error);
    }else{
        // -------------------->  Success
        // echo "Success";
        header("Location: coordinator-PEO-PLO-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    }
    // Perform your desired operations with each selected option
    

    $insertDataStmt->close();
    $conn->close();
}

?>
