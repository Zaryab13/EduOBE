<?php
    $employeeId = $_GET["Employee_id"];

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];

    $conn = new mysqli("localhost", "root", "", "eduobe");
    //---------------------------> File upload handling
    
    $insertDataQuery = "DELETE FROM EDUOBE.Faculty WHERE Employee_id = '$employeeId'";
    
    if ($conn->query($insertDataQuery) === TRUE) {
        header("Location: depttAdminManageFaculty.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    } else {
        echo "Error saving file path to database: " . $conn->error;
    }

?>
