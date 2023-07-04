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
    $Quota = $_POST["Quota"];
    $extraInfo = $_POST["extraInfo"];


    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];
    $deptt_logo = $_GET["batchName"];


    $targetDir = "../uploads/students/";
    $fileName = $_FILES['picture']['name'];
    $targetPath = $targetDir . $fileName;

    // --------------------------> Connection
    $conn = new mysqli("localhost", "root", "", "eduobe");

    if (strlen($fileName) === 0) {
        $img = "../icons/profile.svg";

        $updateDataQuery = "UPDATE eduobe.Students SET
            enrollNo = '$enrollNo',
            name = '$name',
            university = '$university',
            department = '$department',
            program = '$program',
            batch = '$batch',
            CNIC = '$CNIC',
            semester = '$semester',
            gender = '$gender',
            fatherName = '$fatherName',
            Email = '$email',
            studyMode = '$studyMode',
            MaritalStatus = '$MaritalStatus',
            Religion = '$Religion',
            DOB = '$DOB',
            number = '$number',
            permanentAddress = '$permanentAddress',
            postalAddress = '$postalAddress',
            currentCity = '$currentCity',
            District = '$District',
            province = '$province',
            country = '$country',
            HSSCType = '$HSSCType',
            HSSCMarksPer = '$HSSCMarksPer',
            AddApplicationNum = '$AddApplicationNum',
            AdmisionDate = '$AdmisionDate',
            admisionCategory = '$admisionCategory',
            admissionType = '$admissionType',
            entryTestMarksPer = '$entryTestMarksPer',
            Quota = '$Quota',
            extraInfo = '$extraInfo'
            WHERE Reg_No = '$Reg_No'";
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath)) {
            $updateDataQuery = "UPDATE Students SET
            enrollNo = '$enrollNo',
            name = '$name',
            university = '$university',
            department = '$department',
            program = '$program',
            batch = '$batch',
            CNIC = '$CNIC',
            semester = '$semester',
            gender = '$gender',
            fatherName = '$fatherName',
            email = '$email',
            studyMode = '$studyMode',
            MaritalStatus = '$MaritalStatus',
            Religion = '$Religion',
            DOB = '$DOB',
            number = '$number',
            permanentAddress = '$permanentAddress',
            postalAddress = '$postalAddress',
            currentCity = '$currentCity',
            District = '$District',
            province = '$province',
            country = '$country',
            HSSCType = '$HSSCType',
            HSSCMarksPer = '$HSSCMarksPer',
            AddApplicationNum = '$AddApplicationNum',
            AdmisionDate = '$AdmisionDate',
            admisionCategory = '$admisionCategory',
            admissionType = '$admissionType',
            entryTestMarksPer = '$entryTestMarksPer',
            Quota = '$Quota',
            extraInfo = '$extraInfo',
            pic_path = '$targetPath'
            WHERE Reg_No = '$Reg_No'";
        } else {
            echo "Error uploading the file.";
        }
    }
    
    if ($conn->query($updateDataQuery) === TRUE) {
        header("Location: coordinator-Student-Managment-batch-students-list.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo."&batchName=".$batch);
    } else {
        echo "Error updating data: " . $conn->error;
    }
?>
