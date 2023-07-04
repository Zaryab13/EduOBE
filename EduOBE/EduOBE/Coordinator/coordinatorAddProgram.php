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


    // --------------------------> Connection
    $conn = new mysqli("localhost", "root", "", "eduobe");

    //---------------------------> File upload handling
    $targetDir = "../uploads/faculty/";
    $fileName = $_FILES['picture']['name'];
    // echo "file name is " . $fileName;
    $targetPath = $targetDir . $fileName;


    $create_table = "CREATE TABLE IF NOT EXISTS EDUOBE.Faculty ( first_name VARCHAR(50), middle_name VARCHAR(50), last_name VARCHAR(50), Employee_id INT PRIMARY KEY, gender ENUM('Male', 'Female', 'Other'), Designation VARCHAR(50), highest_degree VARCHAR(50), appointment_type VARCHAR(50), role VARCHAR(50), DOB DATE, email VARCHAR(100), phone VARCHAR(20), experience INT, cnic VARCHAR(15), joining_date DATE, leaving_date DATE, address VARCHAR(200), pic_path VARCHAR(150) )";
    $conn->query($create_table);

    if (strlen($fileName) === 0){
        $img = "../icons/profile.svg";
        $insertDataQuery = "INSERT INTO eduobe.faculty (first_name, middle_name, last_name, Employee_id, gender, Designation, highest_degree, appointment_type, role, DOB, email, phone, experience, cnic, joining_date, leaving_date, address, pic_path)
                            VALUES ('$firstName', '$middleName', '$lastName', '$employeeId', '$gender', '$designation', '$highestDegree', '$appointmentType', '$role', '$dob', '$email', '$phone', '$experience', '$cnic', '$joiningDate', '$leavingDate', '$address' ,'$img')";
        
        if ($conn->query($insertDataQuery) === TRUE) {
            header("Location: depttAdminManageFaculty.php");
        } else {
            echo "Error saving file path to database: " . $conn->error;
        }

    }else{
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath)) {
            // $sql = "INSERT INTO images (file_path) VALUES ('$targetPath')";
            $insertDataQuery = "INSERT INTO eduobe.faculty (first_name, middle_name, last_name, Employee_id, gender, Designation, highest_degree, appointment_type, role, DOB, email, phone, experience, cnic, joining_date, leaving_date, address, pic_path)
                                VALUES ('$firstName', '$middleName', '$lastName', '$employeeId', '$gender', '$designation', '$highestDegree', '$appointmentType', '$role', '$dob', '$email', '$phone', '$experience', '$cnic', '$joiningDate', '$leavingDate', '$address' ,'$targetPath')";
            
            if ($conn->query($insertDataQuery) === TRUE) {
                header("Location: depttAdminManageFaculty.php");
            } else {
                echo "Error saving file path to database: " . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    }

?>
