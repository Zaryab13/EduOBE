<?php
$code = $_GET['code'];
$isOBE = $_GET['isOBE'];
// echo $code;
// echo $isOBE;

$username = $_GET["userName"];
$uni_logo = $_GET["uniLogo"];
$deptt_logo = $_GET["depttLogo"];

if($isOBE === 'true'){
    $isOBE = 1;
}else{
    $isOBE = 0;
}

// echo $code;
// echo $isOBE;

// / Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");

if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $updateTableQuery = "
        UPDATE eduobe.BOS
            SET isOBE = '$isOBE'
        WHERE code = '$code'";

    // Prepare and execute create table query
    $updateTableStmt = $conn->prepare($updateTableQuery);
    if (!$updateTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$updateTableStmt->execute()) {
        die("Execute failed: " . $updateTableStmt->error);
    }else{
        // -------------------->  Success
        header("Location: coordinator-BOS-Managment.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    }

    $conn->close();

}


?>