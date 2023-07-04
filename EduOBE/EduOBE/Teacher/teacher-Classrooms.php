<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Box-Icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/index.css">

</head>

<body class="preload">
<?php
     // get username from the index.php
        if(isset($_GET['userName'])){
            $userName = $_GET['userName'];
        }

        // $userName = $_GET['userName'];  // get username from the index.php

        $conn = new mysqli("localhost", "root", "", "eduobe");
        // require_once("config/db.php");
        $createTableQuery = " CREATE TABLE IF NOT EXISTS eduobe.Batch ( batch_id VARCHAR(25) PRIMARY KEY, name VARCHAR(50), num_of_std VARCHAR(25), starting_date VARCHAR(25), ending_date VARCHAR(25), program VARCHAR(25), bos VARCHAR(25), semester VARCHAR(25), FOREIGN KEY (bos) REFERENCES eduobe.BOS(code), FOREIGN KEY (program) REFERENCES eduobe.program(program_code))";
        $createTableStmt = $conn->prepare($createTableQuery);
        
        if (!$createTableStmt) {
            die("Prepare failed: " . $conn->error);
        }
    
        if (!$createTableStmt->execute()) {
            die("Execute failed: " . $createTableStmt->error);
        }
        $createTableStmt->close();


        $result = $conn->query("SELECT first_name,middle_name,last_name FROM eduobe.faculty where username='$userName'");
        if ($result !== false) {
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Fetch the data as an associative array
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                $name = $data[0]['first_name']." ".$data[0]['middle_name']." ".$data[0]['last_name'];
                
                $classroom = $conn->query("SELECT b.batch_id, b.num_of_std, c.code AS course_id, c.name AS course_name, cl.semester
                                            FROM eduobe.Batch AS b
                                            INNER JOIN eduobe.classroom AS cl ON b.batch_id = cl.batch_id
                                            INNER JOIN eduobe.courses AS c ON cl.course_id = c.code
                                            WHERE cl.teacher_name = '$name'");
                if ($classroom !== false) {
                    // Check if there are any rows returned
                    if ($classroom->num_rows > 0) {
                        // Fetch the data as an associative array
                        $classroomData = array();
                        while ($row = $classroom->fetch_assoc()) {
                            $classroomData[] = $row;
                        }
                    } else {
                        $classroomData = NULL;
                    }
                } else {
                    // Handle the case where the query execution failed
                    echo "Error executing the query: " . $conn->error;
                }

            } else {
                $data = NULL;
            }
        } else {
            // Handle the case where the query execution failed
            echo "Error executing the query: " . $conn->error;
        }

        // Convert the PHP array to a JSON string
        $jsonData = json_encode($data);
        echo "<script>var jsonData = $jsonData;</script>";


        $userNameJsonData = json_encode($userName);
        echo "<script>var userNameJsonData = $userNameJsonData;</script>";


        // ==============================================================  for logos
        $create_uni = "CREATE TABLE IF NOT EXISTS EDUOBE.university_info ( id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) UNIQUE, short_name VARCHAR(50), type VARCHAR(50), city VARCHAR(50), address VARCHAR(100), issuing_authority VARCHAR(100), country VARCHAR(50), website VARCHAR(100), phone VARCHAR(20), file_path VARCHAR(100))";
        $conn->query($create_uni);
        
        $create_deptt = "CREATE Table IF NOT EXISTS EDUOBE.Department_Info ( id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) UNIQUE, short_name VARCHAR(50), vision VARCHAR(500), Mission VARCHAR(500), file_path VARCHAR(100) )";
        $conn->query($create_deptt);
          
        $get_uni = "SELECT file_path FROM EDUOBE.university_info";
        $get_deptt = "SELECT file_path FROM EDUOBE.department_info";
        
        $result_uni = $conn->query($get_uni);
        $result_deptt = $conn->query($get_deptt);
        
        // Check if there are any rows returned
        if ($result_uni-> num_rows > 0) {
            // Fetch the data as an associative array
            $data_uni = array();
            while ($row = $result_uni->fetch_assoc()) {
                $data_uni[] = $row;
            }
        } else {
            // Assign default values if no data is found
            $data_uni = array(
                array(
                    'file_path' => "file_path",
                )
            );
        }
        // Check if there are any rows returned
        if ($result_deptt-> num_rows > 0) {
            // Fetch the data as an associative array
            $data_deptt = array();
            while ($row = $result_deptt->fetch_assoc()) {
                $data_deptt[] = $row;
            }
        } else {
            // Assign default values if no data is found
            $data_deptt = array(
                array(
                    'file_path' => "file_path",
                )
            );
        }
        if (!empty($data_uni)) {
            $uni_logo = $data_uni[0]['file_path'];
        } else {
            $uni_logo = "../icons/profile.svg";
        }
        
        if (!empty($data_deptt)) {
            $deptt_logo = $data_deptt[0]['file_path'];
        } else {
            $deptt_logo = "../icons/profile.svg";
        }
        // ================================================================================  logos section end
    
        // Close the connection
        $conn->close();
    ?>

    <div class="sidebar open">
        <div class="logo-details">
            <a href="index.html">
                <img src="../img/Logo 2.png" alt="">
                <span class="logo_name">edu obe</span>
            </a>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <img src="../icons/user.png" alt="">
                        <span class="link_name">Dashboard</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="#">Classrooms</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="toggle">
            <i class='bx bx-menu'></i>
        </div>
        <nav class="top-nav" id="header">
            <div class="nav-left">
            <div class="logos">
                <img src="<?php echo $uni_logo; ?>" alt="">
                <img src="<?php echo $deptt_logo; ?>" alt="">
            </div>
            <div class="top-link-items">
                <ul>
                    <li>
                        <a href="#">About</a>
                        <i class="bx bxs-chevron-down arrow"></i>
                        <div class="about-triangle">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="#fff">
                                <path
                                    d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z" />
                            </svg>
                        </div>
                        <ul class="about-sub-menu top-sub-menu">
                            <li><a href="#">About University</a></li>
                            <li><a href="#">About Department</a></li>
                            <li><a href="#">About App</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
            <div class="nav-right">
            <div class="top-link-items">
                <ul>
                    <li>
                        <div class="icon-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#fff">
                                <path
                                    d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                            </svg>
                            <button type="button" class="notifdropBtn">
                                <i class="bx bxs-chevron-down arrow"></i>
                            </button>
                        </div>
                        <ul class="notif-sub-menu" id="notifSubMenu">
                            <div class="notif-header">
                                <div class="title">
                                    <span>Notifications</span>
                                </div>
                                <div class="mrk-clr">
                                    <span>Mark as read</span>
                                    <span>Clear All</span>
                                </div>
                            </div>
                            <div class="notif-type">
                                <span>New</span>
                            </div>
                            <li class="notification"><a href="#"><img src="../icons/profile.svg" alt="">Muhammad Arsalan</a>
                                <div class="time-remain">
                                    <img src="../icons/clock.svg" alt="">
                                    <span>30 min</span>
                                </div>
                            </li>
                            <div class="notif-type">
                                <span>Earlier</span>
                            </div>
                            <li class="notification"><a href="#"><img src="../icons/profile.svg" alt="">Muhammad
                                    Waqas</a>
                                <div class="time-remain">
                                    <img src="../icons/clock.svg" alt="">
                                    <span>30 min</span>
                                </div>
                            </li>

                            <li class="notification"><a href="#"><img src="../icons/profile.svg" alt="">Faraz
                                    Khan</a>
                                <div class="time-remain">
                                    <img src="../icons/clock.svg" alt="">
                                    <span>30 min</span>
                                </div>
                            </li>
                            <div class="show-all-txt">
                                <span>Show All</span>
                            </div>

                        </ul>
                    </li>
                    <li>
                        <a id="user-name-link" href="#">
                        <?php echo $userName; ?>
                        </a>
                        <button type="button" class="dropBtn">
                            <i class="bx bxs-chevron-down arrow"></i>
                        </button>
                        <ul class="prof-sub-menu" id="profileSubMenu">
                            <li>
                                <a href="#">
                                    <img src="../icons/profile.svg" alt="">
                                    <span class="user-name-text">
                                    <?php echo $userName; ?>
                                    </span>
                                </a>
                            </li>
                            <li>
                            <a href="facultyProfile.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">
                                    <img src="../icons/add-user.svg" alt="">
                                    <span>
                                        Profile
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="../forgot-password.html?username=<?php echo $userName; ?>">
                                    <img src="../icons/key.svg" alt="">
                                    <span>
                                        Reset Password
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="../login.html">
                                    <img src="../icons/logout.svg" alt="">
                                    <span>
                                        Log Out
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </nav>


        <!-- Home Content -->
        <div class="main container-fluid">
            <h3 class="ms-3 my-4">Dashboard</h3>
            <div class="bread-crumbs d-flex">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mx-3">
                            <a href="index.html"><img src="../icons/home.svg" alt=""></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Teacher</a></li>

                    </ol>
                </div>
            </div>

            <div class="container-fluid pb-4">
                <div class="row justify-content-center">
                    <h3 class="section-heading">Classrooms Management</h3>
                    <div class="row teacher-classroom-cards">
                    <?php foreach ($classroomData as $item): ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="teacher-Classroom-CLO-Managment.php?batch_id=<?php echo $item['batch_id']; ?>&course_name=<?php echo $item['course_name']; ?>&course_id=<?php echo $item['course_id']; ?>&num_of_std=<?php echo $item['num_of_std']; ?>&semester=<?php echo $item['semester']; ?>&userName=<?php echo $userName; ?>&uniLogo=<?php echo $uni_logo; ?>&depttLogo=<?php echo $deptt_logo; ?>"> 
                                <div class="teacher-classroom-card">
                                    <div class="card-head">
                                        <h5><?php echo $item['batch_id']; ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p><?php echo $item['course_name']; ?></p>
                                        <span><?php echo $item['num_of_std']; ?></span>
                                    </div>
                                    <div class="card-footer">
                                        <p><?php echo $item['semester']." semester"; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="../js/index.js"></script>

    <script src="../js/scrips.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</body>

</html>