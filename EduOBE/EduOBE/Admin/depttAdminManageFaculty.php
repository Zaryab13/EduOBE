<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduOBE | Admin</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Box-Icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/index.css">

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="preload">
    <?php
        
        if(isset($_GET['userName'])&isset($_GET['uniLogo'])&isset($_GET['depttLogo'])){
            $userName = $_GET['userName'];
            $uni_logo = $_GET['uniLogo'];
            $deptt_logo = $_GET['depttLogo'];
        }

        $conn = new mysqli("localhost", "root", "", "eduobe");
        
        $create_table = "CREATE TABLE IF NOT EXISTS EDUOBE.Faculty ( first_name VARCHAR(50), middle_name VARCHAR(50), last_name VARCHAR(50), Employee_id VARCHAR(25) PRIMARY KEY, gender ENUM('Male', 'Female', 'Other'), Designation VARCHAR(50), highest_degree VARCHAR(50), appointment_type VARCHAR(50), role VARCHAR(50), DOB DATE, Email VARCHAR(100), phone VARCHAR(20), experience INT, cnic VARCHAR(15), joining_date DATE, leaving_date DATE, address VARCHAR(200), username VARCHAR(25) , password VARCHAR(300), pic_path VARCHAR(150) )";
        $conn->query($create_table);
        
        $get_faculty = "SELECT first_name, middle_name, last_name, Employee_id, gender, Designation, highest_degree, appointment_type, role, DOB, Email, phone, experience, cnic, joining_date, leaving_date, address, username, password, pic_path FROM EDUOBE.faculty";
        $result_faculty = $conn->query($get_faculty);
        
        // echo "-------------------------------------------" . strlen($result_uni);
        // echo "-------------------------------------------" . strlen($result_uni);


        // Check if there are any rows returned
        if ($result_faculty-> num_rows > 0) {
            // Fetch the data as an associative array
            $data_faculty = array();
            while ($row = $result_faculty->fetch_assoc()) {
                $data_faculty[] = $row;
            }
        } 
        else {
            // Assign default values if no data is found
            $data_faculty = array(
                array(
                    'first_name' => "No DATA",
                    'middle_name' => "",
                    'last_name' => "",
                    'role' => "",
                )
            );
        }

        // Convert the PHP array to a JSON string
        $jsonData = json_encode($data_faculty);

        // =======================send user name
        $userNameJsonData = json_encode($userName);
        echo "<script>var userNameJsonData = $userNameJsonData;</script>";
        // =======================send unilogo
        $uniLogoJsonData = json_encode($uni_logo);
        echo "<script>var uniLogoJsonData = $uniLogoJsonData;</script>";
        // =======================send deptt logo
        $depttLogoJsonData = json_encode($deptt_logo);
        echo "<script>var depttLogoJsonData = $depttLogoJsonData;</script>";

        
        $conn->close();
    ?>

    <script>
        var jsonDataFaculty = <?php echo $jsonData; ?>;
    </script>




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
                        <span class="link_name">Admin</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="depttAdminManageUniDepttInfo.php?userName=<?php echo $userName;?>">Uni & Deptt <br> Management</a>
                    </li>
                    <li>
                        <a href="#">Faculty Management</a>
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
                               Admin
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
            <h3 class="ms-3 my-4">Faculty Management</h3>
            <div class="bread-crumbs d-flex">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mx-3">
                            <a href="depttAdminManageUniDepttInfo.php?userName=<?php echo $userName;?>"><img src="../icons/home.svg" alt=""></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">

                
            <div class="row faculty-cards">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 order-last">
                    <div id="addNewFacultyBtn" class="add-user-card d-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#addUpdateFaculty">
                        <img src="../icons/plus.svg" alt="">
                    </div>
                </div>
            </div>

            <!-- ------------------------------------------------------------------------------------------------ -->
            <!------------ View Faculty Info Faculty Modal ------------>
            <!-- ------------------------------------------------------------------------------------------------ -->
                
            <div class="modal fade" id="ViewFacultyInfoModal" tabindex="-1"
                    aria-labelledby="ViewFacultyInfoModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ViewFacultyInfoModalLabel">Faculty Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-content-container">
                                    <div class="row faculty-info-modal">
                                        <div class="col-12 mb-4 d-flex justify-content-center align-items-center">
                                            <div class="mb-4 img-container">
                                                <img id='faclty_image' src="https://images.unsplash.com/photo-1599566150163-29194dcaad36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Employee Id:</h5>
                                            <p id='faclty_empId'>791</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Name:</h5>
                                            <p id='faclty_name' >Arsalan Khan</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Gender:</h5>
                                            <p id='faclty_gender'>Male</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Designation:</h5>
                                            <p id='faclty_designation'>Professor</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Highest Degree:</h5>
                                            <p id='faclty_highestDegree'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Faculty Appointment-Type:</h5>
                                            <p id='faclty_appointmentType'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">isPHD:</h5>
                                            <p id='faclty_isPhD'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Role:</h5>
                                            <p id='faclty_role'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">DOB:</h5>
                                            <p id='faclty_DOB'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Email:</h5>
                                            <p id='faclty_email'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Phone:</h5>
                                            <p id='faclty_phone'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Address:</h5>
                                            <p id='faclty_address'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Experience:</h5>
                                            <p id='faclty_exp'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">CNIC:</h5>
                                            <p id='faclty_cnic'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Joining Date:</h5>
                                            <p id='faclty_joiningDate'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Leaving Date:</h5>
                                            <p id='faclty_leavingDate'>PHD</p>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <h5 class="me-3">Username:</h5>
                                            <p id='faclty_username'>PHD</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary cancel-button"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------------------------ -->
            <!------------ Add Faculty Modal ------------>
            <!-- ------------------------------------------------------------------------------------------------ -->
            <div class="modal fade" id="addUpdateFaculty" tabindex="-1" aria-labelledby="addUpdateFacultyLabel"
                aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUpdateFacultyLabel">Add New Faculty</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-content-container">
                                <form class="me-1" id="addUpdateModelForm" method="POST" enctype='multipart/form-data'>
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" name="first_name" class="form-control form-animation"
                                                    id="firstName">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="middleName" class="form-label">Middle Name</label>
                                                <input type="text" name="middle_name" class="form-control form-animation"
                                                    id="middleName">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" name="last_name" class="form-control form-animation"
                                                    id="lastName">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="employee_id" class="form-label">Employee ID</label>
                                                <input type="text" name="employee_id" class="form-control form-animation"
                                                    id="employee_id">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select name="gender" class="form-select form-animation" id="gender">
                                                    <option value="" >Select an option</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="designation" class="form-label">Designation</label>
                                                <select name="designation" class="form-select form-animation" id="designation">
                                                    <option value="" selected>Select an option</option>
                                                    <option value="Lecturer">Lecturer</option>
                                                    <option value="Assistant Professor">Assistant Professor</option>
                                                    <option value="Senior Assistant Professor">Senior Assistant
                                                        Professor</option>
                                                    <option value="Associate Professor">Associate Professor</option>
                                                    <option value="Senior Associate Professor">Senior Associate
                                                        Professor</option>
                                                    <option value="Professor">Professor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="highest_degree" class="form-label">Highest Degree</label>
                                                <select name="highest_degree" class="form-select form-animation" id="highest_degree">
                                                    <option value="" selected>Select an option</option>
                                                    <option value="Bachelor">Bachelor</option>
                                                    <option value="Master">Master</option>
                                                    <option value="Doctorate">Doctorate</option>
                                                    <option value="Post Doc">Post Doc</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="appointment_type" class="form-label">Appointment Type</label>
                                                <select name="appointment_type" class="form-select form-animation" id="appointment_type">
                                                    <option value="" selected>Select an option</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Contract">Contract</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role</label>
                                                <select name="role" class="form-select form-animation" id="role">
                                                    <option value="" selected>Select an option</option>
                                                    <option value="HOD">HOD</option>
                                                    <option value="Coordinator">Coordinator</option>
                                                    <option value="Teaching Staff">Teaching Staff</option>
                                                    <option value="clerical staff">Clerical Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="dob" class="form-label">Date of Birth</label>
                                                <input type="date" name="dob" class="form-control form-animation" id="dob">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control form-animation"
                                                    id="email">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="tel" name="phone" class="form-control form-animation" id="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="experience" class="form-label">Experience</label>
                                                <select name="experience" class="form-select form-animation" id="experience">
                                                    <option value="" selected>Select an option (In Years)</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="cnic" class="form-label">CNIC</label>
                                                <input type="text" name="cnic" class="form-control form-animation"
                                                    maxlength="13" placeholder="13-digit only" id="cnic">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="joining_date" class="form-label">Joining Date</label>
                                                <input type="date" name="joining_date" class="form-control form-animation"
                                                    id="joining_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="leaving_date" class="form-label">Leaving Date</label>
                                                <input type="date" name="leaving_date" class="form-control form-animation"
                                                    id="leaving_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control form-animation"
                                                    id="address">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="picture" class="form-label">Pic</label>
                                                <input type="file" name="picture" class="form-control form-animation"
                                                    id="picture">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary cancel-button"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="addUpdateFacultyFromSaveBtn">Add</button>
                                        <!-- <div id="progressIndicator" class="text-center d-none">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="text-primary">Updating...</div>
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Delete Confirmatin Modal -->
            
            <div class="modal fade" id="deleteFacultyConfirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete the record?</p>
                                <p>It can't be undo after deletion.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="confirmDeleteFacultyBtn" class="btn btn-danger">Confirm</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <!-- Delete Confirmation Modal -->
            <div class="dltFacultyModalContainer">
                <div class="dark-overlay"></div>
                <!-- Confirm delete PopUp -->
                <div class="dltFacultyModal" id="dltFacultyModal">
                    <div class="content d-flex flex-column align-items-center justify-content-center">
                        <h3>Remove User</h3>
                        <p>Are You Sure You Want to Delete this User?</p>
                        <form action="deleteFaculty.php">
                        <div class="deletePopupButtons">
                            <button class="cancel" id="dltFacultyCancelBtn">Cancel</button>
                            <input type="submit" class="delete" id="dltFacultyDltBtn">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </section>


    <script src="../js/index.js"></script>
    <script src="depttAdminManageFaculty.js"></script>
    <script src="../js/scrips.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</body>
</html>