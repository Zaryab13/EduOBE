<?php
    $depttName = $_POST["depttName"];
    $depttShortName = $_POST["depttShortName"];
    $depttVision = $_POST["depttVision"];
    $depttMission = $_POST["depttMission"];

    $ProfileUsername = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    

    $conn = new mysqli("localhost", "root", "", "eduobe");
    //---------------------------> File upload handling
    $targetDir = "../uploads/logos/";
    $fileName = $_FILES['deptt_logo']['name'];
    // echo "file name is " . $fileName;
    $targetPath = $targetDir . $fileName;


    $get_dep_data= "SELECT * FROM EDUOBE.department_info";
    $result_deptt_data = $conn->query($get_dep_data);
    
    
    // $img = "../icons/profile.svg";
    if ($result_deptt_data && $result_deptt_data->num_rows > 0){
        // update query
        if (strlen($fileName) === 0){
            $updateDataQuery = "UPDATE eduobe.department_info set short_name = '$depttShortName', vision = '$depttVision', Mission = '$depttMission' WHERE name = '$depttName'";
            if ($conn->query($updateDataQuery) === TRUE) {
                header("Location: depttAdminManageUniDepttInfo.php?userName=".$ProfileUsername."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
            } else {
                echo "Error saving file path to database: " . $conn->error;
            }
        }else{
            if (move_uploaded_file($_FILES["deptt_logo"]["tmp_name"], $targetPath)) {
                // $sql = "INSERT INTO images (file_path) VALUES ('$targetPath')";
                $updateDataQuery = "UPDATE eduobe.department_info set short_name='$depttShortName', vision='$depttVision', Mission='$depttMission', file_path='$targetPath' where name = '$depttName'";
        
                if ($conn->query($updateDataQuery) === TRUE) {
                    header("Location: depttAdminManageUniDepttInfo.php?userName=".$ProfileUsername."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
                } else {
                    echo "Error saving file path to database: " . $conn->error;
                }
            } else {
                echo "Error uploading the file.";
            }
        }
    }else{
        // find the length of the file path
        if (strlen($fileName) === 0){
            $insertDataQuery = "INSERT INTO eduobe.department_info (name,  short_name, vision, Mission)
                                VALUES ('$depttName', '$depttShortName', '$depttVision', '$depttMission')";
            
            if ($conn->query($insertDataQuery) === TRUE) {
                header("Location: depttAdminManageUniDepttInfo.php?userName=".$ProfileUsername);
            } else {
                echo "Error saving file path to database: " . $conn->error;
            }

        }else{
            if (move_uploaded_file($_FILES["deptt_logo"]["tmp_name"], $targetPath)) {
                // $sql = "INSERT INTO images (file_path) VALUES ('$targetPath')";
                $insertDataQuery = "INSERT INTO eduobe.department_info (name,  short_name, vision, Mission, file_path)
                                    VALUES ('$depttName', '$depttShortName', '$depttVision', '$depttMission', '$targetPath')";
                
                if ($conn->query($insertDataQuery) === TRUE) {
                    header("Location: depttAdminManageUniDepttInfo.php?userName=".$ProfileUsername."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
                } else {
                    echo "Error saving file path to database: " . $conn->error;
                }
            } else {
                echo "Error uploading the file.";
            }
        }
    }

?>
