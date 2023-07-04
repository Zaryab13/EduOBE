<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">


    <link rel="stylesheet" href="css/index.css">


    <title>Document</title>
</head>

<body>
    <?php
        // =========================================  for Email
        require './vendor/autoload.php'; // PHPMailer installed via Composer

        // Import PHPMailer classes into the global namespace
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        // ====================================================
 

        if(isset($_POST["username"])){
            $username = $_POST["username"];
        }elseif(isset($_GET["username"])){
            $username = $_GET["username"];
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get the username from the form submission
                
                
                // echo $username;
                try {
                    $conn = new mysqli("localhost", "root", "", "eduobe");
                    if ($conn->connect_error) {
                        die("Failed to connect: " . $conn->connect_error);
                    } else {
                            $qry = "SELECT Email FROM eduobe.superadmin WHERE username = '$username'";
                            $result1 = $conn->query($qry);
                
                            $qry2 = "SELECT Email FROM eduobe.adminregisteration WHERE user_name = '$username'";
                            $result2 = $conn->query($qry2);
        
                            $qry3 = "SELECT Email FROM eduobe.faculty WHERE username = '$username'";
                            $result3 = $conn->query($qry3);
                        
                            if ($result1->num_rows > 0){
                                $Data = array();
                                while ($row = $result1->fetch_assoc()) {
                                    $Data[] = $row;
                                }
                            }elseif($result2->num_rows > 0){
                                $Data = array();
                                while ($row = $result2->fetch_assoc()) {
                                    $Data[] = $row;
                                }
                            }elseif($result3->num_rows > 0){
                                $Data = array();
                                while ($row = $result3->fetch_assoc()) {
                                    $Data[] = $row;
                                }
                            }
                            
                            $email = $Data[0]['Email']; 
                            // echo "0--------0".$email;
                            $randomNumber = mt_rand(100000, 999999);
                            // echo "-----".$randomNumber;

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
                                $mail->addAddress($email,"etyaysey");

                                // Email content
                                $mail->isHTML(true);
                                $mail->Subject = 'Reset Password';
                                // $mail->Body = 'kjahskda';
                                $mail->Body = "<div>
                                                <h2>Your Reset Password Varification Code is </h2>
                                                <h3> ".$randomNumber." </h3>
                                            </div>";

                                // Send email
                                $mail->send();

                                // header("Location: SuperAdmin.php?userName=".$username."&".);
                                // echo "Email sent successfully!";
                            }catch (Exception $e) {
                                echo "Email sending failed. Error: " . $mail->ErrorInfo;
                            }

                            $usernameJsonData = json_encode($username);
                            echo "<script>var usernameJsonData = $usernameJsonData;</script>";                                                  
                            
                            $randomCodeJsonData = json_encode($randomNumber);
                            echo "<script>var randomCodeJsonData = $randomCodeJsonData;</script>";
                            
                            
                            // && $result2->num_rows === 0 && $result3->num_rows === 0) {
                            //     header("Location: forgot-password.html?error=1");
                            //     exit();
                            // }
                            // Store the username in a session variable
                            // $_SESSION["username"] = $username;
                        }
                } catch (PDPException $err) {
                    echo $err;
                } 
            }

    ?>

    <section class="forgot-password">
        <div class="row forgot-pass-container">
            <div class="col-4 logo-container d-flex align-items-center justify-content-center">
                <img src="img/Logo.png" alt="">
            </div>
            <div class="col-8 d-flex align-items-center justify-content-center flex-column">
                <div class="form-container text-center">
                    <h4 class="pb-4">Verify Code</h4>
                    <form id="verifyPasswordForm" action= "resetPassword.php?username=<?php echo $username ?>" method ="POST" id="forgotPassword">
                        <input class="form-control form-animation" id="verificationCode" maxlength="6" name="code" type="text" placeholder="Enter Code">
                    </form>
                    <div class="login-forgot-password d-flex align-items-start justify-content-start">
                        <p id='resendCodeBtn'>Didn't get code?</p>
                    </div>
                    <input class="btn btn-primary"id="submitBtn" type="submit" value="Verify">
                </div>
            </div>
        </div>
    </section>

    <script>
        let username = usernameJsonData;
        let randomCode = randomCodeJsonData;

        const verifyPasswordForm = document.getElementById('verifyPasswordForm');
        const verificationCode = document.getElementById('verificationCode');
        const submitBtn = document.getElementById('submitBtn');
        const resendCodeBtn = document.getElementById('resendCodeBtn');

        submitBtn.addEventListener('click', () => {
            console.log('verification input value: ', verificationCode.value);
            if(randomCode === parseInt(verificationCode.value)){
                console.log('true');
                verifyPasswordForm.submit();
            }else{
                console.log('false');
            }
        });


        resendCodeBtn.addEventListener('click', () => {
            const url = `resetPassword.php?username=${username}`;
            window.location.href = url;
        });

        
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>

</html>