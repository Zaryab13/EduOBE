<?php
 $ploCode = $_POST["PLOCode"];
 $ploName = $_POST["PLOName"];
 $description = $_POST["PLODescription"];
 $mappToPLO = $_POST["PLOMapping"];
 $KPI = $_POST["PLOKpi"];

 $PEOData = implode(' ', $mappToPLO);

$username = $_GET["userName"];
$uni_logo = $_GET["uniLogo"];
$deptt_logo = $_GET["depttLogo"];

// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    // UPDATE eduobe.PLOS SET name = 'PLO-09', description = 'nanannnaana', KPI = '90' WHERE PLO_code = '345' AND mapp_to_peos = 'PEO-01'
    $updateTableQuery = "
    UPDATE eduobe.PLOS
        SET name = '$ploName',
        description = '$description',
        KPI =  '$KPI',
        mapp_to_peos = '$PEOData'
    WHERE PLO_code = '$ploCode'";

    // Prepare and execute create table query
    $updateTableStmt = $conn->prepare($updateTableQuery);
    if (!$updateTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$updateTableStmt->execute()) {
        die("Execute failed: " . $updateTableStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-PEO-PLO-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    }
    // // Insert data query
    // $insertDataQuery = "INSERT INTO EDUOBE.PLOs (PLO_code, name, description, KPI, mapp_to_peos)
    //     VALUES (?,?,?,?,?)";

    // // Prepare and execute insert data query
    // $insertDataStmt = $conn->prepare($insertDataQuery);
    // if (!$insertDataStmt) {
    //     die("Prepare failed: " . $conn->error);
    // }

    // foreach ($mappToPLO as $option) {
    //     // echo $option . "<br>";
    //     $insertDataStmt->bind_param("sssss", $ploCode, $ploName, $description, $KPI, $option);
    //     if (!$insertDataStmt->execute()) {
    //         die("Execute failed: " . $insertDataStmt->error);
    //     }else{
    //         // -------------------->  Success
    //         // echo "Success";
    //         header("Location: coordinator-PEO-PLO-Managment.php");
    //     }
    //     // Perform your desired operations with each selected option
    // }

    $updateTableStmt->close();
    $conn->close();
}

?>
