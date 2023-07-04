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

// // Database connection
$conn = new mysqli("localhost", "root", "", "eduobe");
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Insert data query
    $updateDataQuery = "UPDATE eduobe.AdminRegisteration
    SET university_name = ?,
        department_name = ?,
        Email = ?,
        registration_date = NOW(),
        liciense_expiry = NOW() + INTERVAL ? YEAR
    WHERE user_name = ?";

    $updateStmt = $conn->prepare($updateDataQuery);
    if (!$updateStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $updateStmt->bind_param("sssds", $university_name, $department_name, $email, $Years_of_liciensing, $user_name);
    if (!$updateStmt->execute()) {
        die("Execute failed: " . $updateStmt->error);
    } else {
        // ------------------------------------------------- select the Expiry date
        $newExpDate = "select liciense_expiry AS license_expiry from EDUOBE.AdminRegisteration where user_name = '$user_name'";
        $result1 = $conn->query($newExpDate);
        // -------------------------------------------------------------------------
        if ($result1->num_rows === 0) {
            die("Execute failed: " . $updateStmt->error);
        }else{
            $row = $result1->fetch_assoc(); // Fetch the row as an associative array
            $licenseExpiry = $row['license_expiry']; // Retrieve the specific column value

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
            $mail->Subject = 'License Extension';
            $mail->Body = "<div>
                            <h2>Your License is extended</h2>
                            <h3>It is Valid Upto ".$licenseExpiry."</h3>
                        </div>";

            // Send email
            $mail->send();
            header("Location: SuperAdmin.php");
            // echo "Email sent successfully!";
            } catch (Exception $e) {
                echo "Admin Update Successfully, but";
                echo "Email sending failed. Error: " . $mail->ErrorInfo;
            }
            header("Location: SuperAdmin.php");
            // Redirect or perform any other actions after the update
        }
        }
        

    $updateStmt->close();
    $conn->close();
}

// ?>
