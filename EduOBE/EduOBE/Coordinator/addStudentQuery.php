<?php
    $Reg_No = $_POST["Reg_No"];
    $enrollNo = $_POST["enrollNo"];
    $name = $_POST["name"];
    $university = $_POST["university"];
    $department = $_POST["department"];
    $program = $_POST["program"];
    $batch = $_POST["batch"];
    $CNIC = $_POST["CNIC"];
    $semester = $_POST["semester"];
    $gender = $_POST["gender"];
    $fatherName = $_POST["fatherName"];
    $email = $_POST["email"];
    $studyMode = $_POST["studyMode"];
    $MaritalStatus = $_POST["MaritalStatus"];
    $Religion = $_POST["Religion"];
    $DOB = $_POST["DOB"];
    $number = $_POST["number"];
    $permanentAddress = $_POST["permanentAddress"];
    $postalAddress = $_POST["postalAddress"];
    $currentCity = $_POST["currentCity"];
    $District = $_POST["District"];
    $province = $_POST["province"];
    $country = $_POST["country"];


    $HSSCType = $_POST["HSSCType"];
    $HSSCMarksPer = $_POST["HSSCMarksPer"];
    $AddApplicationNum = $_POST["AddApplicationNum"];
    $AdmisionDate = $_POST["AdmisionDate"];
    $admisionCategory = $_POST["admisionCategory"];
    $admissionType = $_POST["admissionType"];
    $entryTestMarksPer = $_POST["entryTestMarksPer"];
    $Quota = $_POST["Quota"];
    $extraInfo = $_POST["extraInfo"];

    
    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    $batchName = $_GET["batchName"];

    
    $targetDir = "../uploads/students/";
    $fileName = $_FILES['picture']['name'];
    $targetPath = $targetDir . $fileName;

    // --------------------------> Connection
    $conn = new mysqli("localhost", "root", "", "eduobe");
    $create_table = "CREATE TABLE IF NOT EXISTS eduobe.Students ( Reg_No VARCHAR(255) PRIMARY KEY, enrollNo VARCHAR(255), name VARCHAR(255), university VARCHAR(255), department VARCHAR(255), program VARCHAR(255), batch VARCHAR(255), CNIC VARCHAR(255), semester VARCHAR(255), gender VARCHAR(255), fatherName VARCHAR(255), Email VARCHAR(255), studyMode VARCHAR(255), MaritalStatus VARCHAR(255), Religion VARCHAR(255), DOB DATE, number VARCHAR(25), permanentAddress VARCHAR(255), postalAddress VARCHAR(255), currentCity VARCHAR(255), District VARCHAR(255), province VARCHAR(255), country VARCHAR(255), HSSCType VARCHAR(255), HSSCMarksPer DECIMAL(5,2), AddApplicationNum VARCHAR(255), AdmisionDate DATE, admisionCategory VARCHAR(255), admissionType VARCHAR(255), entryTestMarksPer VARCHAR(255), Quota VARCHAR(255), extraInfo VARCHAR(255), password VARCHAR(300), pic_path VARCHAR(255))";
    $conn->query($create_table);

    if (strlen($fileName) === 0) {
        $img = "../icons/profile.svg";

        $insertDataQuery = "INSERT INTO Students (Reg_No, enrollNo, name, university, department, program, batch, CNIC, semester, gender, fatherName, Email, studyMode, MaritalStatus, Religion, DOB, number, permanentAddress, postalAddress, currentCity, District, province, country, HSSCType, HSSCMarksPer, AddApplicationNum, AdmisionDate, admisionCategory, admissionType, entryTestMarksPer, Quota, extraInfo, password,pic_path)
        VALUES ('$Reg_No','$enrollNo','$name','$university','$department','$program','$batch','$CNIC','$semester','$gender','$fatherName','$email','$studyMode','$MaritalStatus','$Religion','$DOB', '$number','$permanentAddress','$postalAddress','$currentCity','$District','$province','$country','$HSSCType','$HSSCMarksPer','$AddApplicationNum','$AdmisionDate','$admisionCategory','$admissionType', '$entryTestMarksPer', '$Quota', '$extraInfo', SHA2('123456', 256) , '$img')";
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath)) {
            $insertDataQuery = "INSERT INTO Students (Reg_No, enrollNo, name, university, department, program, batch, CNIC, semester, gender, fatherName, Email, studyMode, MaritalStatus, Religion, DOB, number, permanentAddress, postalAddress, currentCity, District, province, country, HSSCType, HSSCMarksPer, AddApplicationNum, AdmisionDate, admisionCategory, admissionType, entryTestMarksPer, Quota, extraInfo, password, pic_path)
        VALUES ('$Reg_No','$enrollNo','$name','$university','$department','$program','$batch','$CNIC','$semester','$gender','$fatherName','$email','$studyMode','$MaritalStatus','$Religion','$DOB', '$number','$permanentAddress','$postalAddress','$currentCity','$District','$province','$country','$HSSCType','$HSSCMarksPer','$AddApplicationNum','$AdmisionDate','$admisionCategory','$admissionType','$entryTestMarksPer', '$Quota', '$extraInfo', SHA2('123456', 256),  '$targetPath')";
        } else {
            echo "Error uploading the file.";
        }
    }
    
    if ($conn->query($insertDataQuery) === TRUE) {
        header("Location: coordinator-Student-Managment-batch-students-list.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo."&batchName=".$batch);
    } else {
        echo "Error saving file path to database: " . $conn->error;
    }
?>
