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

    $ProfileUsername = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];

    $username = $firstName.$middleName.$lastName."@uom.se";


    // =========================================  for Email
    require '../vendor/autoload.php'; // PHPMailer installed via Composer

    // Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    // ====================================================


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
        $img = "../icons/profile.svg";
        $insertDataQuery = "INSERT INTO eduobe.faculty (first_name, middle_name, last_name, Employee_id, gender, Designation, highest_degree, appointment_type, role, DOB, Email, phone, experience, cnic, joining_date, leaving_date, address, username, password, pic_path)
                            VALUES ('$firstName', '$middleName', '$lastName', '$employeeId', '$gender', '$designation', '$highestDegree', '$appointmentType', '$role', '$dob', '$email', '$phone', '$experience', '$cnic', '$joiningDate', '$leavingDate', '$address','$username', SHA2('123456', 256) ,'$img')";
        
    }else{
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath)) {
            // $sql = "INSERT INTO images (file_path) VALUES ('$targetPath')";
            $insertDataQuery = "INSERT INTO eduobe.faculty (first_name, middle_name, last_name, Employee_id, gender, Designation, highest_degree, appointment_type, role, DOB, Email, phone, experience, cnic, joining_date, leaving_date, address, username, password, pic_path)
                                VALUES ('$firstName', '$middleName', '$lastName', '$employeeId', '$gender', '$designation', '$highestDegree', '$appointmentType', '$role', '$dob', '$email', '$phone', '$experience', '$cnic', '$joiningDate', '$leavingDate', '$address' ,'$username', SHA2('123456', 256) ,'$targetPath')";
            
        } else {
            echo "Error uploading the file.";
        }
    }
    
    if ($conn->query($insertDataQuery) === TRUE) {
    // ===================================================== Email sending Logic
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration for Outlook.com
        // Uncomment the following lines if you want to send emails using Outlook.com
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'edu.obe.uom@outlook.com';
        $mail->Password = 'arsalan123';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set sender and recipient
        $mail->setFrom('edu.obe.uom@outlook.com', 'EDU OBE SYSTEM');
        $mail->addAddress($email,"SE");

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Faculty Created';
        // $mail->Body = 'kjahskda';
        $mail->Body = "<div>
                        <h3>Your username is: " . $username . "</h3>
                        <h3>Your password is: 123456 </h3>
                    </div>";

        // Send email
        $mail->send();
        header("Location: SuperAdmin.php");
        // echo "Email sent successfully!";
    }catch (Exception $e) {
        echo "Admin created Successfully, but";
        echo "Email sending failed. Error: " . $mail->ErrorInfo;
    }
        header("Location: depttAdminManageFaculty.php?userName=".$ProfileUsername."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
    } else {
        echo "Error saving file path to database: " . $conn->error;
    }

?>
