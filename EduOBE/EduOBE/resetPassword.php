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
    session_start();
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
                    $qry = "SELECT * FROM eduobe.superadmin WHERE username = '$username'";
                    $result1 = $conn->query($qry);
        
                    $qry2 = "SELECT * FROM eduobe.adminregisteration WHERE user_name = '$username'";
                    $result2 = $conn->query($qry2);

                    $qry3 = "SELECT * FROM eduobe.faculty WHERE username = '$username'";
                    $result3 = $conn->query($qry3);
                
                    if ($result1->num_rows === 0 && $result2->num_rows === 0 && $result3->num_rows === 0) {
                        header("Location: forgot-password.html?error=1");
                        exit();
                    }
                    // Store the username in a session variable
                    $_SESSION["username"] = $username;
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
                    <h3 class="pb-4">Reset Password</h3>
                    
                    <form action= "resetPasswordQuery.php" method ="POST" id="resetPassword">
                        <h6 class="pb-4"><?php echo $username ?></h6>
                        <input class="form-control form-animation mb-4" name="password" type="password"
                            placeholder="New Password">
                        <input class="form-control form-animation mb-4" name="confirmPassword" type="password"
                            placeholder="Confirm Password">
                        <div class="w-100 text-center">
                            <input class="btn btn-primary mt-4" type="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
</body>

</html>