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
        if(isset($_GET['batch_id'])&isset($_GET['course_name'])&isset($_GET['course_id'])&isset($_GET['num_of_std'])&isset($_GET['semester'])&isset($_GET['userName'])&isset($_GET['uniLogo'])&isset($_GET['depttLogo'])){
            $userName = $_GET['userName'];
            $uni_logo = $_GET['uniLogo'];
            $deptt_logo = $_GET['depttLogo'];
            $course_name = $_GET['course_name'];
            $course_id = $_GET['course_id'];
            $num_of_std = $_GET['num_of_std'];
            $semester = $_GET['semester'];
        }

        $conn = new mysqli("localhost", "root", "", "eduobe");
        // require_once("config/db.php");
        $createBOSTableQuery = "CREATE TABLE IF NOT EXISTS eduobe.classroom (
            classroom_id INT AUTO_INCREMENT PRIMARY KEY, 
            batch_id VARCHAR(50),
            semester VARCHAR(25),
            course_id VARCHAR(25),
            term VARCHAR(25),
            teacher_name VARCHAR(45),
            status BOOLEAN,
            FOREIGN KEY (batch_id) REFERENCES eduobe.batch(batch_id),
            FOREIGN KEY (course_id) REFERENCES eduobe.courses(code) 
        )";
        $createBOSTableStmt = $conn->prepare($createBOSTableQuery);

        if (!$createBOSTableStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$createBOSTableStmt->execute()) {
            die("Execute failed: " . $createBOSTableStmt->error);
        }
        
        $createBOSTableStmt->close();
    

        // ======================================  get data
        $getdata = "SELECT classroom_id,batch_id, semester, course_id, term, teacher_name, status FROM eduobe.classroom";
        $resultclass = $conn->query($getdata);

        // Check if there are any rows returned
        if ($resultclass->num_rows > 0) {
            // Fetch the data as an associative array
            $dataClass = array();
            while ($row = $resultclass->fetch_assoc()) {
                $dataClass[] = $row;
            }
        }else{
            $dataClass=NULL;
        }
        // Convert the BOS PHP array to a JSON string
        $jsonData = json_encode($dataClass);
        echo "<script>var jsonData = $jsonData;</script>";

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
            <a href="index.html">
                <img src="../img/Logo 2.png" alt="">
                <span class="logo_name">edu obe</span>
            </a>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                    <a href="teacher-classrooms.html">
                        <img src="../icons/user.png" alt="">
                        <span class="link_name">Classroom</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="#">CLO Management</a>
                    </li>
                    <li>
                        <a href="teacher-Classroom-MarksEntry.html">Marks Entry</a>
                    </li>
                    <li>
                        <a href="teacher-Classroom-Mapping-CLO-With-Qs.html">Mapping CLO with <br>Questions</a>
                    </li>
                    <li>
                        <a href="teacher-Classroom-CQI.html">CQI</a>
                    </li>
                    <li>
                        <a href="#">Re-Assignment</a>
                    </li>
                    <li>
                        <a href="teacher-Classrooms.php">Classrooms</a>
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
            <h3 class="ms-3 my-4">Classroom</h3>
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

            <div class="container-fluid">
                <div class="row justify-content-center pb-4">
                    <h3 class="section-heading">CLO Management</h3>

                    <div class="CLO-section row">
                        <div class="section-head">
                            <h4 class="title">CLO List</h4>
                            <button class="csvBtn">Import CSV</button>
                        </div>
                        <div class="row CLO-table">
                            <table id="CLO-dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">KPI</th>
                                        <th scope="col">Mapping PLO's</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="addCLOs">
                                </tbody>
                            </table>
                            <div class="order-last add-user">
                                <div class="ad-user col-lg-12" data-bs-target="#addUpdateCLOModal" data-bs-toggle="modal">
                                    <img id="addCLOBtn" src="../icons/plus-circle.svg" alt="">
                                </div>
                            </div>

                            <div class="modal fade" id="addUpdateCLOModal" tabindex="-1" aria-labelledby="addCLOModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <form class="me-1" id="addUpdateCLOForm" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addCLOModalLabel">Add CLO</h5>
                                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button> -->
                                            </div>
                                            
                                            <div class="modal-body">
                                                <div class="form-content-container">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="code" class="form-label">Code</label>
                                                                <input name="code" type="text" class="form-control form-animation"
                                                                    id="code">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input name="name" type="text" class="form-control form-animation"
                                                                    id="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="kpi" class="form-label">KPI</label>
                                                                <input name="KPI" type="text" class="form-control form-animation" id="kpi">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="domain" class="form-label">Domain</label>
                                                                <select name="domain" class="form-select form-animation" id="domain">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Cognitive Domain">Cognitive Domain</option>
                                                                    <option value="Affective Domain">Affective Domain</option>
                                                                    <option value="Psychomotor Domain">Psychomotor Domain</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="btLevel" class="form-label">Bloom's Texonomy Level</label>
                                                                <select name="bloomTexonomyLevel" class="form-select form-animation" id="btLevel">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label" for="description">Description</label>
                                                                <textarea name="description" class="form-control" id="description"
                                                                    rows="1"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary cancel-button"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="CLOModalAddUpdateBtn">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Confirmatin Modal -->
                            <div class="modal fade" id="deleteCLOConfirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" >Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure? It can't be undo.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="confirmDeleteCLOBtn" class="btn btn-danger">Delete</button>
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

    <script src="./teacher-Classroom-CLO-Managment.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</body>

</html>