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
        if(isset($_GET['userName'])&isset($_GET['uniLogo'])&isset($_GET['depttLogo'])){
            $userName = $_GET['userName'];
            $uni_logo = $_GET['uniLogo'];
            $deptt_logo = $_GET['depttLogo'];
        }

        $conn = new mysqli("localhost", "root", "", "eduobe");
        // require_once("config/db.php");
        $createBOSTableQuery = "CREATE TABLE IF NOT EXISTS eduobe.BOS (code VARCHAR(50) PRIMARY KEY,name VARCHAR(50),career VARCHAR(500),scheme VARCHAR(50),program VARCHAR(50),isOBE BOOLEAN)";
        $createBOSTableStmt = $conn->prepare($createBOSTableQuery);

        if (!$createBOSTableStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$createBOSTableStmt->execute()) {
            die("Execute failed: " . $createBOSTableStmt->error);
        }
        
        $createBOSTableStmt->close();
    

        // ======================================  get data
        $getBOS = "SELECT code, name, career, scheme, program, isOBE FROM eduobe.BOS";
        $resultBOS = $conn->query($getBOS);

        // Check if there are any rows returned
        if ($resultBOS->num_rows > 0) {
            // Fetch the data as an associative array
            $dataBOS = array();
            while ($row = $resultBOS->fetch_assoc()) {
                $dataBOS[] = $row;
            }
        }else{
            $dataBOS=NULL;
        }
        // Convert the BOS PHP array to a JSON string
        $jsonBOSData = json_encode($dataBOS);
        echo "<script>var jsonData = $jsonBOSData;</script>";
        

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
    <script>
        var jsonBOSData = <?php echo $jsonBOSData; ?>;
    </script>
    <div class="sidebar open">
        <div class="logo-details">
            <a href="">
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
                        <a href="./coordinator-Program-Managment.php?userName=<?php echo $userName;?>">Program Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-PEO-PLO-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">PEO & PLO <br> Management</a>
                    </li>
                    <li>
                        <a href="./coordinator-Course-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Course Management</a>
                    </li>
                    <li>
                        <a href="#">BOS Management</a>
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
            <h3 class="ms-3 my-4">Coordinator</h3>
            <div class="bread-crumbs d-flex">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mx-3">
                        <a href="coordinator-Program-Managment.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>"><img src="../icons/home.svg" alt=""></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Coordinator</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <h3 class="section-heading">Board Of Study Management</h3>

                    <div class="BOS-section row">
                        <div class="section-head">
                            <h4 class="title">BOS List</h4>
                            <button class="csvBtn">Import CSV</button>
                        </div>
                        <div class="row BOS-table">
                            <table id="BOS-dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Career</th>
                                        <th scope="col">Scheme Type</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">OBE Enabled</th>
                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>
                                <tbody id='addBOS'>
                                </tbody>
                            </table>
                            <div class="order-last add-user">
                                <div class="ad-user col-lg-12" data-bs-target="#addBOSModal" data-bs-toggle="modal">
                                    <img id="addBOSBtn" src="../icons/plus-circle.svg" alt="">
                                </div>
                            </div>
                            

                            <!-- Add BOS Modal -->
                            <div class="modal fade" id="addBOSModal" tabindex="-1" aria-labelledby="addBOSModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addBOSModalLabel">Add BOS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-content-container">
                                                <form id="addUpdateBOSForm" class="me-1" method="POST">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="code" class="form-label">Code</label>
                                                                <input type="text" name="code" class="form-control form-animation"
                                                                    id="code">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" name="name" class="form-control form-animation"
                                                                    id="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label" for="career">Career</label>
                                                                <input type="text" name="career" class="form-control form-animation"
                                                                    id="career">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="schemeType" class="form-label">Scheme
                                                                    Type</label>
                                                                <input type="text" name="scheme" class="form-control form-animation"
                                                                    id="schemeType">
                                                            </div>
                                                        </div>

                                                    <!-- ===================================================== -->
                                                    <?php
                                                    $conn = new mysqli("localhost", "root", "", "eduobe");
                                                    // require_once("config/db.php");
                                                    $createTableQuery = $createTableQuery = "CREATE TABLE IF NOT EXISTS EDUOBE.program (program_code VARCHAR(25) NOT NULL PRIMARY KEY,program_name VARCHAR(100),type VARCHAR(50),number_of_semester varchar(15),program_level VARCHAR(50),assessment_method VARCHAR(100),passing_marks_per VARCHAR(25),learning_type VARCHAR(100))";
                                                    $createtableStmt = $conn->prepare($createTableQuery);
                                                    $createtableStmt->close();
                                                  
                                                
                                                    // ======================================  get data
                                                    $getdata = "SELECT program_code FROM eduobe.program";
                                                    $resultprog = $conn->query($getdata);
                                                
                                                    // Check if there are any rows returned
                                                    if ($resultprog->num_rows > 0) {
                                                        // Fetch the data as an associative array
                                                        $dataprog = array();
                                                        while ($row = $resultprog->fetch_assoc()) {
                                                            $dataprog[] = $row;
                                                        }
                                                    }else{
                                                        $dataprog=NULL;
                                                    }
                                                    // Close the connection
                                                    $conn->close();
                                                    ?>
                                                    <!-- ===================================================== -->

                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="program" class="form-label">Program Code</label>
                                                                <select name="program" required class="form-select form-animation" id="programLearningType">
                                                                <option value="" selected>- select -</option>
                                                                    <?php
                                                                    if (!empty($dataprog)) {
                                                                        foreach ($dataprog as $row) {
                                                                            echo '<option value="' . $row['program_code'] . '">' . $row['program_code'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary cancel-button"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" id="BOS-modalAddUpdateBtn">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Confirmatin Modal -->
                            <div class="modal fade" id="deleteBOSConfirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                                            <button type="button" id="confirmDeleteBOSBtn" class="btn btn-danger">Delete</button>
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


    <script src="coordinator-BOS-Managment.js"></script>
    <!-- <script src="bos-table1.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</body>

</html>