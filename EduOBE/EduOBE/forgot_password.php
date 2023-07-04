<?php
    require 'vendor/autoload.php'; // PHPMailer installed via Composer

    // Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    $username = $_POST["username"];

    try {
        $conn = new mysqli("localhost", "root", "", "eduobe");
        if ($conn->connect_error) {
            die("Failed to connect: " . $conn->connect_error);
        } else {
                // $qry1 = $conn->prepare("SELECT * FROM eduobe.superadmin WHERE Email = ? AND Password = SHA2(?,256)");
    
                $qry = "SELECT Email AS Email , username AS username ,Password AS Password  FROM eduobe.superadmin WHERE username = '$username'";
                $result1 = $conn->query($qry);
    
                $qry2 = "SELECT Email AS Email ,user_name AS user_name, password AS password , department_name AS department_name FROM eduobe.adminregisteration WHERE user_name = '$username'";
                $result2 = $conn->query($qry2);
            
                if ($result1->num_rows > 0) {
                    // echo "Super Admin";
                    $row = $result1->fetch_assoc(); // Fetch the row as an associative array
                    $email = $row['Email'];
                    $username = $row['username'];
                    $password = $row['Password'];
                    $name = '';
                    // echo $email;
                    // echo $username;
                    // echo $password;
                    
                    // Authentication successful
                    // header("Location: SuperAdmin.php");
                    // echo $emailSuperAdmin;
                    // exit();
                }elseif($result2->num_rows > 0){
                    $row = $result2->fetch_assoc(); // Fetch the row as an associative array
                    $email = $row['Email'];
                    $username = $row['user_name'];
                    $password = $row['password'];
                    $name = $row['department_name'];
                    // echo $email;
                    // echo $username;
                    // echo $password;

                    // echo $emailAdmin;
                    // header("Location: Admin/depttAdminManageUniDepttInfo.php");
                    // exit();
                
                }else {
                    // Authentication failed
                    header("Location: forgot-password.html?error=1");
                    exit();
                }

                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
                // echo $mail;
                // echo $email;
                // echo $username;
                // echo $password;

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
                    $mail->addAddress($email, $name);

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'A Test Message';
                    $mail->Body = " <div>
                                        <h3>Your username is: " . $username . "</h3>
                                        <h3>Your password is: ".$password." </h3>
                                    </div>";

                    // Send email
                    $mail->send();

                    echo "Email sent successfully!";
                } catch (Exception $e) {
                    echo "Email sending failed. Error: " . $mail->ErrorInfo;
                }

            
            }
    } catch (PDPException $err) {
        echo $err;
    }
?>
