<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- changes done here on 20/5/2023 11:40am -->
    <title>Edu OBE | Admin Profile</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Box-Icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/index.css">

    <style>
        .form-content-container {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
        }

    </style>
    
</head>

<body>

<?php
        if(isset($_GET['userName'])&isset($_GET['uniLogo'])&isset($_GET['depttLogo'])){
            $userName = $_GET['userName'];
            $uni_logo = $_GET['uniLogo'];
            $deptt_logo = $_GET['depttLogo'];
        }
        // echo "==================------------------==================".$userName;
        $conn = new mysqli("localhost", "root", "", "eduobe");
    
        $getFacultydata = "SELECT first_name, middle_name, last_name, Employee_id, gender, Designation, highest_degree, appointment_type, role, DOB, Email, phone, experience, cnic, joining_date, leaving_date, address, username, pic_path FROM EDUOBE.faculty WHERE username = '$userName'";
        $resultFacultyData = $conn->query($getFacultydata);
        
        // Check if there are any rows returned
        if ($resultFacultyData-> num_rows > 0) {
            // Fetch the data as an associative array
            $dataFaculty = array();
            while ($row = $resultFacultyData->fetch_assoc()) {
                $dataFaculty[] = $row;
            }
        } else {
            // Assign default values if no data is found
            $dataFaculty = array(
                array(
                    'Email' => "University Name",
                    'phone' => "Short Name",
                    'address' => "Public",
                    'pic_path' => "City",
                )
            );
        }

        if (!empty($dataFaculty)) {
            $Picture = $dataFaculty[0]['pic_path'];
        } else {
            $Picture = "../icons/profile.svg";
        }

        $jsonfacultyData = json_encode($dataFaculty);
        echo "<script>var jsonfacultyData = $jsonfacultyData;</script>";

        // =======================send user name
        $userNameJsonData = json_encode($userName);
        echo "<script>var userNameJsonData = $userNameJsonData;</script>";
        // =======================send unilogo
        $uniLogoJsonData = json_encode($uni_logo);
        echo "<script>var uniLogoJsonData = $uniLogoJsonData;</script>";
        // =======================send deptt logo
        $depttLogoJsonData = json_encode($deptt_logo);
        echo "<script>var depttLogoJsonData = $depttLogoJsonData;</script>";
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
                <a href="teacher-Classrooms.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <img src="../icons/teacher.svg" alt="">
                        <span class="link_name">Teacher</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="teacher-Classrooms.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Classroom</a></li>
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
                                    <a href="depttAdminProfile.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">
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
            <h3 class="ms-3 my-4">Profile</h3>
            <div class="bread-crumbs d-flex">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mx-3">
                            <a href="#"><img src="../icons/home.svg" alt=""></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                    </ol>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button id="updatefacultyBtn" type="button" class="btn edit-profile-btn" data-bs-toggle="modal" data-bs-target="#updateModal">
                    <span class="icon">
                        <img src="../icons/edit.svg" alt="Edit Icon">
                    </span>
                    <span class="text">Edit</span>
                </button>
            </div>

            <div class="row">
                <div class="col-lg-7 prof-card prof-info">
                    <div class="row">
                        <div class="row  col-lg-12">
                            <div class="underline"></div>
                            <div class="col-lg-3 m-4 faculty-pic">
                                <img src="<?php echo $Picture; ?>" alt="">
                            </div>
                            <div class="col-lg-7 d-flex flex-column align-items-left justify-content-center username-session">
                                <span class="username"><?php echo $dataFaculty[0]['first_name']." ".$dataFaculty[0]['middle_name']." ".$dataFaculty[0]['last_name'] ?></span>
                                <span class="session"><?php echo $dataFaculty[0]['role'] ?></span>
                            </div>
                        </div>
                        <div class="row prof-body">
                            <div class="col-lg-8 ">
                                <div class="info d-flex">
                                    <div class="col-lg-5">
                                        <p>Employee ID:</p>
                                        <p>Designation:</p>
                                        <p>CNIC:</p>
                                        <p>Gender:</p>
                                        <p>DOB:</p>
                                        <p>Highest Degree:</p>
                                        <p>Experince:</p>
                                        <p>Appointment Type:</p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p><?php echo $dataFaculty[0]['Employee_id'] ?></p>
                                        <p><?php echo $dataFaculty[0]['Designation'] ?></p>
                                        <p><?php echo $dataFaculty[0]['cnic'] ?></p>
                                        <p><?php echo $dataFaculty[0]['gender'] ?></p>
                                        <p><?php echo $dataFaculty[0]['DOB'] ?></p>
                                        <p><?php echo $dataFaculty[0]['highest_degree'] ?></p>
                                        <p><?php echo $dataFaculty[0]['experience'] ?></p>
                                        <p><?php echo $dataFaculty[0]['appointment_type'] ?></p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 otherinfo prof-card">
                    <div class="col-g-12 otherinfo-head d-flex align-items-center justify-content-center mt-3">
                        <img src="../icons/contact-book.svg" alt="">
                        <h3>Contact Information</h3>
                    </div>
                    <div class="d-flex justify-content-center">
                        <hr class="hr-custom-width">
                    </div>
                    <div class="row prof-body ">
                        <div class="col-lg-12">
                            <div class="info d-flex">
                                <div class="col-lg-3">
                                    <p>Email:</p>
                                    <p>Phone #:</p>
                                    <p>P.Address:</p>
                                    
                                </div>
                                <div class="col-lg-9 contact-details">
                                    <p class="otherinfo-email"><?php echo $dataFaculty[0]['Email'] ?></p>
                                    <p><?php echo $dataFaculty[0]['phone'] ?></p>
                                    <p><?php echo $dataFaculty[0]['address'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <hr class="hr-custom-width">
                    </div>
                    <div class="row prof-body ">
                        <div class="col-lg-12">
                            <div class="info d-flex">
                                <div class="col-lg-4">
                                    <p>Joining Date:</p>
                                    <p>Leaving Date:</p>
                                    
                                </div>
                                <div class="col-lg-">
                                    <p><?php echo $dataFaculty[0]['joining_date'] ?></p>
                                    <p><?php echo $dataFaculty[0]['leaving_date'] ?></p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
    <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update Faculty Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-content-container">
                    <form id="updatefacultyForm" method="POST" class="me-1" enctype='multipart/form-data'>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control form-animation" id="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input name="phone" type="tel" class="form-control form-animation" id="phone">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input name="address" type="text" class="form-control form-animation" id="address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Pic</label>
                                    <input name="picture" type="file" class="form-control form-animation" id="picture">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-button" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        </div>
    </div>
    <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
    <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let data = jsonfacultyData;
            var username = userNameJsonData;
            var uni_logo = uniLogoJsonData;
            var deptt_logo = depttLogoJsonData;

            // const facultyData = {};

            // data.forEach((object, index) => {
            //     facultyData.push(object);      
            // });
            console.log("faculty data: ", data);
            
            // console.log('data: ');
            // console.log(data);
            const updatefacultyBtn = document.getElementById('updatefacultyBtn');
            const updatefacultyForm = document.getElementById('updatefacultyForm');
            
            updatefacultyBtn.addEventListener('click', () => {
                
                updatefacultyForm.action = `updateFacultyProfileQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

                $('#updatefacultyForm input[name="email"]').val(`${data[0].Email}`);
                $('#updatefacultyForm input[name="phone"]').val(`${data[0].phone}`);
                $('#updatefacultyForm input[name="address"]').val(`${data[0].address}`);
            });
            
        });
    </script>
</body>

</html>