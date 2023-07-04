<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduOBE | Coordinator</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Box-Icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/index.css">

     <!-- Include jQuery library -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Include Bootstrap 5 CSS and DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
 
     <!-- Include DataTables and Bootstrap 5 JavaScript files -->
     <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

</head>

<body class="preload">

<?php
        if(isset($_GET['userName'])&isset($_GET['uniLogo'])&isset($_GET['depttLogo'])&isset($_GET['batchName'])){
            $userName = $_GET['userName'];
            $uni_logo = $_GET['uniLogo'];
            $deptt_logo = $_GET['depttLogo'];
            $batchName = $_GET['batchName'];
        }

        // echo "====".$userName;
        // echo "====".$uni_logo;
        // echo "====".$deptt_logo;
        // echo "====".$batchName;
        
        
        $conn = new mysqli("localhost", "root", "", "eduobe");
        // require_once("config/db.php");
        $createStdTable = "CREATE TABLE IF NOT EXISTS eduobe.Students ( Reg_No VARCHAR(255) PRIMARY KEY, enrollNo VARCHAR(255), name VARCHAR(255), university VARCHAR(255), department VARCHAR(255), program VARCHAR(255), batch VARCHAR(255), CNIC VARCHAR(255), semester VARCHAR(255), gender VARCHAR(255), fatherName VARCHAR(255), Email VARCHAR(255), studyMode VARCHAR(255), MaritalStatus VARCHAR(255), Religion VARCHAR(255), DOB DATE, number VARCHAR(25), permanentAddress VARCHAR(255), postalAddress VARCHAR(255), currentCity VARCHAR(255), District VARCHAR(255), province VARCHAR(255), country VARCHAR(255), HSSCType VARCHAR(255), HSSCMarksPer DECIMAL(5,2), AddApplicationNum VARCHAR(255), AdmisionDate DATE, admisionCategory VARCHAR(255), admissionType VARCHAR(255), entryTestMarksPer VARCHAR(255), Quota VARCHAR(255), extraInfo VARCHAR(255), password VARCHAR(300), pic_path VARCHAR(255))";
        $createStdTableStmt = $conn->prepare($createStdTable);

        if (!$createStdTableStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$createStdTableStmt->execute()) {
            die("Execute failed: " . $createStdTableStmt->error);
        }

        $createStdTableStmt->close();

        // ======================================  get data
        $getStdData = "SELECT Reg_No, enrollNo, name, university, department, program, batch, CNIC, semester, gender, fatherName, Email, studyMode, MaritalStatus, Religion, DOB, number, permanentAddress, postalAddress, currentCity, District, province, country, HSSCType, HSSCMarksPer, AddApplicationNum, AdmisionDate, admisionCategory, admissionType, Quota, extraInfo, pic_path FROM eduobe.Students WHERE batch='$batchName'";
        $resulStd = $conn->query($getStdData);

        // Check if there are any rows returned
        if ($resulStd->num_rows > 0) {
            // Fetch the data as an associative array
            $dataStd = array();
            while ($row = $resulStd->fetch_assoc()) {
                $dataStd[] = $row;
            }
        }else{
            $dataStd=NULL;
        }
        

        // Convert the PEO PHP array to a JSON string
        $jsonStdData = json_encode($dataStd);
        echo "<script>var jsonStdData = $jsonStdData;</script>";

        // =======================send user name
        $userNameJsonData = json_encode($userName);
        echo "<script>var userNameJsonData = $userNameJsonData;</script>";
        // =======================send unilogo
        $uniLogoJsonData = json_encode($uni_logo);
        echo "<script>var uniLogoJsonData = $uniLogoJsonData;</script>";
        // =======================send deptt logo
        $depttLogoJsonData = json_encode($deptt_logo);
        echo "<script>var depttLogoJsonData = $depttLogoJsonData;</script>";
         // =======================send batch Name
        $batchNameJsonData = json_encode($batchName);
        echo "<script>var batchNameJsonData = $batchNameJsonData;</script>";



        // Close the connection
        $conn->close();
    ?>

    <div class="sidebar open">
        <div class="logo-details">
            <a href="#">
                <img src="../img/Logo 2.png" alt="">
                <span class="logo_name">edu obe</span>
            </a>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <img src="../icons/user.png" alt="">
                        <span class="link_name">Coordinator</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="./coordinator-Program-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Program Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-PEO-PLO-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">PEO & PLO <br> Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-Course-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Course Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-BOS-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">BOS Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-Batch-Management.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Batch Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-Student-Managment-overall-batch.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Student Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-Classroom-Management.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Classroom's <br>Management</a>
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
                                <a href="CoordinatorProfile.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">
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
            <h3 class="ms-3 my-4">Student Management</h3>
            <div class="bread-crumbs d-flex">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mx-3">
                            <a href="coordinator-Program-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>"><img src="../icons/home.svg" alt=""></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Student Management</a></li>
                        <li class="breadcrumb-item "><a href="#"><?php echo $batchName ?></a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <h3 class="section-heading ">Student Management</h3>
                    

                    <div class="BOS-section row">
                        <div class="section-head">
                            <h4 class="title">Students List</h4>
                            <button class="csvBtn">Import CSV</button>
                        </div>
                        <div class="row BOS-table">
                            <table id="Student-dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">RegNo</th>
                                        <th scope="col">Enroll No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">CNIC</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="addStudentList">
                                </tbody>
                            </table>
                            <div class="order-last add-user">
                                <div id="addStudentBtn" class="ad-user col-lg-12" data-bs-target="#addStudentModal" data-bs-toggle="modal">
                                    <img id="addStuBtn" src="../icons/plus-circle.svg" alt="">
                                </div>
                            </div>

                            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addBOSModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-content-container">
                                                <form class="me-1" id="addUpdateStudentForm", method="POST">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="regNo" class="form-label">Reg No</label>
                                                                <input name="Reg_No" type="text" class="form-control form-animation"
                                                                    id="regNo">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="enrollNo" class="form-label">Enroll No</label>
                                                                <input name="enrollNo" type="text" class="form-control form-animation"
                                                                    id="enrollNo">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input name="name" type="text" class="form-control form-animation"
                                                                    id="name">
                                                            </div>
                                                        </div>
                                                        <!-- ===================================================== -->
                                                    <?php
                                                    $conn = new mysqli("localhost", "root", "", "eduobe");
                                                
                                                    // ======================================  get data
                                                    $getunidata = "SELECT name FROM eduobe.university_info";
                                                    $resultuni = $conn->query($getunidata);

                                                    $getdepttdata = "SELECT name FROM eduobe.department_info";
                                                    $resultdeptt = $conn->query($getdepttdata);
                                                
                                                    $getprogdata = "SELECT program_name FROM eduobe.program";
                                                    $resultprog = $conn->query($getprogdata);

                                                    $getbatchdata = "SELECT name FROM eduobe.batch";
                                                    $resultbatch = $conn->query($getbatchdata);
                                                    
                                                    
                                                    // ================================= uni data
                                                    if ($resultuni->num_rows > 0) {
                                                        // Fetch the data as an associative array
                                                        $dataUni = array();
                                                        while ($row = $resultuni->fetch_assoc()) {
                                                            $dataUni[] = $row;
                                                        }
                                                    }else{
                                                        $dataUni=NULL;
                                                    }
                                                    // ================================= deptt data
                                                    if ($resultdeptt->num_rows > 0) {
                                                        // Fetch the data as an associative array
                                                        $dataDeptt = array();
                                                        while ($row = $resultdeptt->fetch_assoc()) {
                                                            $dataDeptt[] = $row;
                                                        }
                                                    }else{
                                                        $dataDeptt=NULL;
                                                    }
                                                    // ================================= program data
                                                    if ($resultprog->num_rows > 0) {
                                                        // Fetch the data as an associative array
                                                        $dataProg = array();
                                                        while ($row = $resultprog->fetch_assoc()) {
                                                            $dataProg[] = $row;
                                                        }
                                                    }else{
                                                        $dataProg=NULL;
                                                    }
                                                    // ================================= Batch data
                                                    if ($resultbatch->num_rows > 0) {
                                                        // Fetch the data as an associative array
                                                        $dataBatch = array();
                                                        while ($row = $resultbatch->fetch_assoc()) {
                                                            $dataBatch[] = $row;
                                                        }
                                                    }else{
                                                        $dataBatch=NULL;
                                                    }
                                                    
                                                    
                                                    // Close the connection
                                                    $conn->close();

                                                    ?>
                                                    <!-- ===================================================== -->
                                                        <div class="col-sm-4">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label" for="university" >University</label>
                                                                <select name="university" class="form-select form-animation" id="university">
                                                                    <option value="" selected>- Select -</option>
                                                                    <?php
                                                                    if (!empty($dataUni)) {
                                                                        foreach ($dataUni as $row) {
                                                                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label" for="department" >Department</label>
                                                                <select name="department" class="form-select form-animation" id="department">
                                                                    <option value="" selected>- Select -</option>
                                                                    <?php
                                                                    if (!empty($dataDeptt)) {
                                                                        foreach ($dataDeptt as $row) {
                                                                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label" for="university" >Program</label>
                                                                <select name="program" class="form-select form-animation" id="program">
                                                                    <option value="" selected>- Select -</option>
                                                                    <?php
                                                                    if (!empty($dataProg)) {
                                                                        foreach ($dataProg as $row) {
                                                                            echo '<option value="' . $row['program_name'] . '">' . $row['program_name'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label" for="batch" >Batch</label>
                                                                <select name="batch" class="form-select form-animation" id="batch">
                                                                    <option value="" selected>- Select -</option>
                                                                    <?php
                                                                    if (!empty($dataBatch)) {
                                                                        foreach ($dataBatch as $row) {
                                                                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="cnic"
                                                                    class="form-label">CNIC</label>
                                                                <input name="CNIC" type="text" class="form-control form-animation" maxlength = '13'
                                                                    id="cnic">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="semester"
                                                                    class="form-label">Semester</label>
                                                                <input name="semester" type="text" class="form-control form-animation"
                                                                    id="semester">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="gender" class="form-label">Gender</label>
                                                                <select name="gender" class="form-select form-animation" id="gender">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="f-name"
                                                                    class="form-label">Father Name</label>
                                                                <input name="fatherName" type="text" class="form-control form-animation"
                                                                    id="f-name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="email"
                                                                    class="form-label">Email</label>
                                                                <input name="email" type="text" class="form-control form-animation"
                                                                    id="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="study-mode" class="form-label">Study Mode</label>
                                                                <select name="studyMode" class="form-select form-animation" id="study-mode">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="marital-status" class="form-label">Marital Status</label>
                                                                <select name="MaritalStatus" class="form-select form-animation" id="marital-status">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="religion" class="form-label">Religion</label>
                                                                <select name="Religion" class="form-select form-animation" id="religion">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Muslim">Muslim</option>
                                                                    <option value="Non-Muslim">Non Muslim</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="date-of-birth"
                                                                    class="form-label">Date of Birth</label>
                                                                <input name="DOB" type="date" class="form-control form-animation"
                                                                    id="date-of-birth">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="mobile"
                                                                    class="form-label">Mobile</label>
                                                                <input name="number" type="text" class="form-control form-animation"
                                                                    id="mobile">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="permanent-address"
                                                                    class="form-label">Permanent Address</label>
                                                                <input name="permanentAddress" type="text" class="form-control form-animation"
                                                                    id="permanent-address">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="postal-address"
                                                                    class="form-label">Postal Address</label>
                                                                <input name="postalAddress" type="text" class="form-control form-animation"
                                                                    id="postal-address">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="current-city"
                                                                    class="form-label">Current City</label>
                                                                <input name="currentCity" type="text" class="form-control form-animation"
                                                                    id="current-city">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="district"
                                                                    class="form-label">District</label>
                                                                <input name="District" type="text" class="form-control form-animation"
                                                                    id="district">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="province"
                                                                    class="form-label">Province</label>
                                                                <input name="province" type="text" class="form-control form-animation"
                                                                    id="province">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="country"
                                                                    class="form-label">Country</label>
                                                                <input name="country" type="text" class="form-control form-animation"
                                                                    id="country">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="picture" class="form-label">Pic</label>
                                                                <input name="picture" type="file" class="form-control form-animation" id="picture">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row mb-2 ">
                                                        <div class="col-sm-12">
                                                            <div class="mb-3 pb-4 d-flex justify-content-center" >
                                                                <h3>Admission Details.</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="hssc-type" class="form-label">HSSC Type</label>
                                                                <select name="HSSCType" class="form-select form-animation" id="hssc-type">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Science">Science</option>
                                                                    <option value="Arts">Arts</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="hssc-marks-percent" class="form-label">HSSC Marks %</label>
                                                                <input name="HSSCMarksPer" type="text" class="form-control form-animation"
                                                                    id="hssc-marks-percent">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="admission-no" class="form-label">Admission Appliction No.</label>
                                                                <input name="AddApplicationNum" type="text" class="form-control form-animation"
                                                                    id="admission-no">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label" for="admission-date" >Admission Date</label>
                                                                <input name="AdmisionDate" type="date" class="form-control form-animation"
                                                                    id="admission-date">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="admission-category" class="form-label">Admission Category</label>
                                                                <select name="admisionCategory" class="form-select form-animation" id="admission-category">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Science">Option 1</option>
                                                                    <option value="Arts">Option 2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="admission-category" class="form-label">Admission Type</label>
                                                                <select name="admissionType" class="form-select form-animation" id="admission-category">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Science">Option 1</option>
                                                                    <option value="Arts">Option 2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="entry-test-marks"
                                                                    class="form-label">Entry Test Marks</label>
                                                                <input name="entryTestMarksPer" type="text" class="form-control form-animation"
                                                                    id="entry-test-marks">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="quota"
                                                                    class="form-label">Quota</label>
                                                                <input name="Quota" type="text" class="form-control form-animation"
                                                                    id="quota">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="extra-info"
                                                                    class="form-label">Extra Information</label>
                                                                <input  name="extraInfo" type="text" class="form-control form-animation"
                                                                    id="extra-info">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary cancel-button"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" id="StudentModalAddUpdateBtn">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Confirmatin Modal -->
                            <div class="modal fade" id="deleteStudentConfirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure? It can't be undo.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="confirmDeleteStudentBtn" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>


    <script src="../js/index.js"></script>

    <!-- <script src="js/scrips.js"></script> -->

    <script src="coordinator-Student-Managment-batch-students-list.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</body>

</html>