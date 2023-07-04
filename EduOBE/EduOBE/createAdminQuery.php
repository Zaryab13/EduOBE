<?php
// =========================================  for Email
require 'vendor/autoload.php'; // PHPMailer installed via Composer

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// ====================================================



$university_name = $_POST["University_Name"];
$department_name = $_POST["Department_Name"];
$email = $_POST["Email"];
$user_name = $_POST["UserName"];
$Years_of_liciensing = $_POST["years_of_liciense"];

// Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Create table query
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS eduobe.AdminRegisteration (
            id INT AUTO_INCREMENT PRIMARY KEY,
            university_name VARCHAR(255),
            department_name VARCHAR(255),
            Email VARCHAR(255),
            registration_date DATE,
            liciense_expiry DATE,
            user_name VARCHAR(50) UNIQUE,
            password VARCHAR(300)
        )
    ";

    // Prepare and execute create table query
    $createTableStmt = $conn->prepare($createTableQuery);
    if (!$createTableStmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$createTableStmt->execute()) {
        die("Execute failed: " . $createTableStmt->error);
    }

    $createTableStmt->close();

    // Insert data query
    $insertDataQuery = "
        INSERT INTO eduobe.AdminRegisteration (university_name, department_name, Email, registration_date, liciense_expiry, user_name, password)
        VALUES (?, ?, ?, NOW(), NOW() + INTERVAL ? YEAR, ?, SHA2('123456', 256))
    ";

    // Prepare and execute insert data query
    $insertDataStmt = $conn->prepare($insertDataQuery);
    if (!$insertDataStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $insertDataStmt->bind_param("sssis", $university_name, $department_name, $email, $Years_of_liciensing, $user_name);
    if (!$insertDataStmt->execute()) {
        die("Execute failed: " . $insertDataStmt->error);
    }else{
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
        $mail->addAddress($email, $department_name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Department Created';
        // $mail->Body = 'kjahskda';
        $mail->Body = "<div>
                        <h3>Your username is: " . $user_name . "</h3>
                        <h3>Your password is: 123456 </h3>
                    </div>";

        // Send email
        $mail->send();
        header("Location: SuperAdmin.php");
        // echo "Email sent successfully!";
    } catch (Exception $e) {
        echo "Admin created Successfully, but";
        echo "Email sending failed. Error: " . $mail->ErrorInfo;
    }
    // ================================================================================
   
    }

    $insertDataStmt->close();
    $conn->close();
}

?>
