<?php
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    
    // --------------------------> Connection
    $conn = new mysqli("localhost", "root", "", "eduobe");

    //---------------------------> File upload handling
    $targetDir = "../uploads/faculty/";
    $fileName = $_FILES['picture']['name'];
    // echo "file name is " . $fileName;
    $targetPath = $targetDir . $fileName;


    // $updateDataQuery1 = "SELECT eduobe. SET Password = SHA2($password, 256) WHERE username = '$username'";
    // $updateDataQuery2 = "SELECT eduobe.adminregisteration SET password = SHA2($password, 256) WHERE user_name = '$username'";
    

    $create_table = "CREATE TABLE IF NOT EXISTS EDUOBE.Faculty ( first_name VARCHAR(50), middle_name VARCHAR(50), last_name VARCHAR(50), Employee_id VARCHAR(25) PRIMARY KEY, gender ENUM('Male', 'Female', 'Other'), Designation VARCHAR(50), highest_degree VARCHAR(50), appointment_type VARCHAR(50), role VARCHAR(50), DOB DATE, Email VARCHAR(100), phone VARCHAR(20), experience INT, cnic VARCHAR(15), joining_date DATE, leaving_date DATE, address VARCHAR(200), username VARCHAR(50) , password VARCHAR(300), pic_path VARCHAR(150) )";
    $conn->query($create_table);



    if (strlen($fileName) === 0){
        // $img = "../icons/profile.svg";
        $updateDataQuery = "UPDATE eduobe.faculty set Email='$email', phone='$phone', address='$address' WHERE username='$username'";
       
        if ($conn->query($updateDataQuery) === TRUE) {
            header("Location: CoordinatorProfile.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
        } else {
            echo "Error saving file path to database: " . $conn->error;
        }
        
    }else{
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath)) {
            $updateDataQuery = "UPDATE eduobe.faculty set Email='$email', phone='$phone', address='$address', pic_path='$targetPath' WHERE username='$username'";
        
            if ($conn->query($updateDataQuery) === TRUE) {
                header("Location: CoordinatorProfile.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
            } else {
                echo "Error saving file path to database: " . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    }
    
?>
