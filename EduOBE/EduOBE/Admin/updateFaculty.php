<?php
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $employeeId = $_POST["employee_id"];
    $gender = $_POST["gender"];
    $designation = $_POST["designation"];
    $highestDegree = $_POST["highest_degree"];
    $appointmentType = $_POST["appointment_type"];
    $role = $_POST["role"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $experience = $_POST["experience"];
    $cnic = $_POST["cnic"];
    $joiningDate = $_POST["joining_date"];
    $leavingDate = $_POST["leaving_date"];
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

    // find the length of the file path
    if (strlen($fileName) === 0){
        // $img = "../icons/profile.svg";
        $updateDataQuery = "UPDATE eduobe.faculty set first_name = '$firstName', middle_name = '$middleName', last_name='$lastName', gender='$gender', Designation='$designation', highest_degree='$highestDegree', appointment_type='$appointmentType', role='$role', DOB='$dob', Email='$email', phone='$phone', experience='$experience', cnic='$cnic', joining_date='$joiningDate', leaving_date='$leavingDate', address='$address' WHERE Employee_id='$employeeId'";
       
        if ($conn->query($updateDataQuery) === TRUE) {
            header("Location: depttAdminManageFaculty.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
        } else {
            echo "Error saving file path to database: " . $conn->error;
        }
        
    }else{
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath)) {
            $updateDataQuery = "UPDATE eduobe.faculty set first_name = '$firstName', middle_name = '$middleName', last_name='$lastName', gender='$gender', Designation='$designation', highest_degree='$highestDegree', appointment_type='$appointmentType', role='$role', DOB='$dob', Email='$email', phone='$phone', experience='$experience', cnic='$cnic', joining_date='$joiningDate', leaving_date='$leavingDate', address='$address', pic_path='$targetPath' WHERE Employee_id='$employeeId'";
        
            if ($conn->query($updateDataQuery) === TRUE) {
                header("Location: depttAdminManageFaculty.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
            } else {
                echo "Error saving file path to database: " . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    }

?>
