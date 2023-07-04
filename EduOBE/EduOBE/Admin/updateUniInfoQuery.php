<?php
    $universityName = $_POST["University_Name"];
    $uniShortName = $_POST["uniShortName"];
    $uniIssuingAuthority = $_POST["uniIssuingAuthority"];
    $uniType = $_POST["uniType"];
    $uniPhone = $_POST["uniPhone"];
    $uniWebsite = $_POST["uniWebsite"];
    $uniCity = $_POST["uniCity"];
    $uniCountry = $_POST["uniCountry"];
    $uniAddress = $_POST["uniAddress"];

    $username = $_GET["userName"];
    // echo $username;
      
    // --------------------------> Connection
    $conn = new mysqli("localhost", "root", "", "eduobe");

    //---------------------------> File upload handling
    $targetDir = "../uploads/logos/";
    $fileName = $_FILES['uni_logo']['name'];
    // echo "file name is " . $fileName;
    $targetPath = $targetDir . $fileName;

    $get_faculty = "SELECT * FROM EDUOBE.university_info";
    $result_uni_data = $conn->query($get_faculty);
    
    $img = "../icons/profile.svg";
    if ($result_uni_data && $result_uni_data->num_rows > 0){
        // update query
        if (strlen($fileName) === 0){
            
            $updateDataQuery = "UPDATE eduobe.university_info set name='$universityName', short_name='$uniShortName', issuing_authority='$uniIssuingAuthority', type='$uniType', phone='$uniPhone', website='$uniWebsite', city='$uniCity', country='$uniCountry', address='$uniAddress' where name='$universityName'";
                
            if ($conn->query($updateDataQuery) === TRUE) {
                header("Location: depttAdminManageUniDepttInfo.php?userName=".$username);
            } else {
                echo "Error saving file path to database: " . $conn->error;
            }
        }else{
            if (move_uploaded_file($_FILES["uni_logo"]["tmp_name"], $targetPath)) {
                // $sql = "INSERT INTO images (file_path) VALUES ('$targetPath')";
                $updateDataQuery = "UPDATE eduobe.university_info set name='$universityName', short_name='$uniShortName', issuing_authority='$uniIssuingAuthority', type='$uniType', phone='$uniPhone', website='$uniWebsite', city='$uniCity', country='$uniCountry', address='$uniAddress', file_path =  '$targetPath' where name='$universityName'";
              
                if ($conn->query($updateDataQuery) === TRUE) {
                    header("Location: depttAdminManageUniDepttInfo.php?userName=".$username);
                } else {
                    echo "Error saving file path to database: " . $conn->error;
                }
            } else {
                echo "Error uploading the file.";
            }
        }


    }else{
        // insert query
        if (strlen($fileName) === 0){
            $insertDataQuery = "INSERT INTO eduobe.university_info (name, short_name, issuing_authority, type, phone, website, city, country, address, file_path)
                                VALUES ('$universityName', '$uniShortName', '$uniIssuingAuthority', '$uniType', '$uniPhone', '$uniWebsite', '$uniCity', '$uniCountry', '$uniAddress', '$img')";
            
            if ($conn->query($insertDataQuery) === TRUE) {
                header("Location: depttAdminManageUniDepttInfo.php?userName=".$username);
            } else {
                echo "Error saving file path to database: " . $conn->error;
            }
        }else{
            if (move_uploaded_file($_FILES["uni_logo"]["tmp_name"], $targetPath)) {
                // $sql = "INSERT INTO images (file_path) VALUES ('$targetPath')";
                $insertDataQuery = "INSERT INTO eduobe.university_info (name, short_name, issuing_authority, type, phone, website, city, country, address, file_path)
                                    VALUES ('$universityName', '$uniShortName', '$uniIssuingAuthority', '$uniType', '$uniPhone', '$uniWebsite', '$uniCity', '$uniCountry', '$uniAddress', '$targetPath')";
                
                if ($conn->query($insertDataQuery) === TRUE) {
                    header("Location: depttAdminManageUniDepttInfo.php?userName=".$username);
                } else {
                    echo "Error saving file path to database: " . $conn->error;
                }
            } else {
                echo "Error uploading the file.";
            }
        }
    }

    

?>
