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

<!-- Your HTML table code -->



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
        $createPEOTableQuery = "CREATE TABLE IF NOT EXISTS EDUOBE.PEO (PEO_code VARCHAR(50) PRIMARY KEY,name VARCHAR(100),description VARCHAR(500),ref_program_code VARCHAR(25),FOREIGN KEY (ref_program_code) REFERENCES eduobe.program(program_code))";
        $createPEOTableStmt = $conn->prepare($createPEOTableQuery);
        
        $createPLOTableQuery = "CREATE TABLE IF NOT EXISTS EDUOBE.PLOs(PLO_code VARCHAR(50),name VARCHAR(100),description VARCHAR(500),KPI VARCHAR(100),mapp_to_peos VARCHAR(50), PRIMARY KEY (PLO_code))";
        $createPLOTableStmt = $conn->prepare($createPLOTableQuery);
        
        
        if (!$createPEOTableStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$createPEOTableStmt->execute()) {
            die("Execute failed: " . $createPEOTableStmt->error);
        }


        if (!$createPLOTableStmt) {
            die("Prepare failed: " . $conn->error);
        }
        if (!$createPLOTableStmt->execute()) {
            die("Execute failed: " . $createPLOTableStmt->error);
        }


        $createPEOTableStmt->close();
        $createPLOTableStmt->close();
      

        // ======================================  get data
        $getPEO = "SELECT PEO_code, name, description, ref_program_code FROM eduobe.PEO";
        $resultPEO = $conn->query($getPEO);

        $getPLO = "SELECT PLO_code, name, description, KPI, mapp_to_peos FROM eduobe.PLOS";
        $resultPLO = $conn->query($getPLO);


        // Check if there are any rows returned
        if ($resultPEO->num_rows > 0) {
            // Fetch the data as an associative array
            $dataPEO = array();
            while ($row = $resultPEO->fetch_assoc()) {
                $dataPEO[] = $row;
            }
        }else{
            $dataPEO=NULL;
        }
        // Check if there are any rows returned
        if ($resultPLO->num_rows > 0) {
            // Fetch the data as an associative array
            $dataPLO = array();
            while ($row = $resultPLO->fetch_assoc()) {
                $dataPLO[] = $row;
            }
        }else{
            $dataPLO=NULL;
        }




        // Convert the PEO PHP array to a JSON string
        $jsonPEOData = json_encode($dataPEO);
        echo "<script>var jsonData = $jsonPEOData;</script>";
        // Convert the PLO PHP array to a JSON string
        $jsonPLOData = json_encode($dataPLO);
        echo "<script>var jsonData = $jsonPLOData;</script>";
        
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
        var jsonPEOData = <?php echo $jsonPEOData; ?>;
    </script>

    <script>
        var jsonPLOData = <?php echo $jsonPLOData; ?>;
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
                        <a href="#">PEO & PLO <br> Management</a>
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
            <h3 class="ms-3 my-4">PEO & PLO's Management</h3>
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
                    <h3 class="section-heading">PEO & PLO's Management</h3>

                    <div class="PEO-section row">
                        <div class="section-head">
                            <h3 class="title">PEO List</h3>
                            <button class="csvBtn">Import CSV</button>
                        </div>
                        <!-- just to display the selected PEOs from add PLO modal ........... for testing purpose -->
                        <!-- <p id="countElement"></p> -->
                        <div class="row peo-table">
                            <table id="PEO-dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Program Code</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="addPEOs">
                                </tbody>
                            </table>
                            <div class="order-last add-user">
                                <div class="ad-user col-lg-12" data-bs-target="#addPEOModal" data-bs-toggle="modal">
                                    <img id="addPEOBtn" src="../icons/plus-circle.svg" alt="">
                                </div>
                            </div>

                            <div class="modal fade" id="addPEOModal" tabindex="-1" aria-labelledby="addPEOModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPEOModalLabel">Add PEO</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-content-container">
                                                <form id="addUpdatePEOForm" class="me-1" method="POST">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="PEO-code" class="form-label">PEO Code</label>
                                                                <select name="peoCode" required class="form-select form-animation" id="programType">
                                                                    <option value="">- Select -</option>
                                                                    <option value="1">PEO-01</option>
                                                                    <option value="2">PEO-02</option>
                                                                    <option value="3">PEO-03</option>
                                                                    <option value="4">PEO-04</option>  
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="PEO-name" class="form-label">PEO Name</label>
                                                                <input type="text" class="form-control form-animation"
                                                                    name="peoName">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="PEO-program" class="form-label">Program Code</label>
                                                                <input type="text" class="form-control form-animation"
                                                                    name="peoProgram">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label"
                                                                    for="PEO-description">Description</label>
                                                                <textarea class="form-control" name="peoDescription"
                                                                    rows="1"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary cancel-button"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" id="PEO-modalAddUpdateBtn">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Confirmatin Modal -->
                            <div class="modal fade" id="deletePEOConfirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                                            <button type="button" id="confirmDeletePEOBtn" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="width: 75%; margin: 30px 0;">
                    <div class="PLO-section row">
                        <div class="section-head">
                            <h3 class="title">PLO List</h3>
                            <button class="csvBtn">Import CSV</button>
                        </div>
                        <div class="row plo-table">
                            <table id="PLO-dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">KPI</th>
                                        <th scope="col">PEOs ID</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="addPLOs">
                                </tbody>
                            </table>
                            <div class="order-last add-user">
                                <div class="ad-user col-lg-12" data-bs-target="#addPLOModal" data-bs-toggle="modal">
                                    <img id="addPLOBtn" src="../icons/plus-circle.svg" alt="">
                                </div>
                            </div>

                            <div class="modal fade" id="addPLOModal" tabindex="-1" aria-labelledby="addPLOModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPLOModalLabel">Add PLO</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-content-container">
                                                <form id="addUpdatePLOForm" method="POST" class="me-1">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="PLO-code" class="form-label">PLO Code</label>
                                                                <select name="PLOCode" required class="form-select form-animation" id="programType">
                                                                    <option value="">- Select -</option>
                                                                    <option value="PLO-01">PLO-01</option>
                                                                    <option value="PLO-02">PLO-02</option>
                                                                    <option value="PLO-03">PLO-03</option>
                                                                    <option value="PLO-04">PLO-04</option>
                                                                    <option value="PLO-05">PLO-05</option>
                                                                    <option value="PLO-06">PLO-06</option>
                                                                    <option value="PLO-07">PLO-07</option>
                                                                    <option value="PLO-08">PLO-08</option>
                                                                    <option value="PLO-09">PLO-09</option>
                                                                    <option value="PLO-10">PLO-10</option>
                                                                    <option value="PLO-11">PLO-11</option>
                                                                    <option value="PLO-12">PLO-12</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="PLO-name" class="form-label">PLO Name</label>
                                                                <input type="text" class="form-control form-animation"
                                                                    name="PLOName">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-outline mb-3">
                                                                <label class="form-label"
                                                                    for="PLO-description">Description</label>
                                                                <textarea class="form-control" name="PLODescription"
                                                                    rows="1"></textarea>
                                                            </div>
                                                        </div>
                                                         
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="PLO-kpi" class="form-label">KPI</label>
                                                                <input type="text" class="form-control form-animation"
                                                                    name="PLOKpi">
                                                            </div>
                                                        </div>
                                                                <!-- =============================== select PEO for select text fields======================================= -->
                                                        <?php
                                                            $conn = new mysqli("localhost", "root", "", "eduobe");
                                                            $get = "SELECT PEO_code FROM eduobe.PEO";
                                                            $result = $conn->query($get);

                                                            // Initialize an empty array to store the data
                                                            $data = array();

                                                            // Check if there are any rows returned
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $data[] = $row['PEO_code'];
                                                                }
                                                            } else {
                                                                $data = NULL;
                                                            }
                                                        ?>
                                                         <!-- ======================================================================================================= -->
                                        
                                                        <div class="col-sm-12 mt-4">
                                                            <?php
                                                                if (!empty($data)) {
                                                                    foreach ($data as $option) {
                                                                        echo '<div class="col-sm-4 mb-3">';
                                                                        echo    '<input type="checkbox" class="form-animation inpt-checkbox" name="PLOMapping['.$option.']" value="' . $option . '">';
                                                                        echo    '<label for="PLOMapping['.$option.']" class="form-label">'. $option .'</label>';
                                                                        echo '</div>';
                                                                    }
                                                                }
                                                            ?>
                                                        </div>    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary cancel-button"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit"  class="btn btn-primary" id="PLO-modalAddUpdateBtn">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Confirmatin Modal -->
                            <div class="modal fade" id="deletePLOConfirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                                            <button type="button" id="confirmDeletePLOBtn" class="btn btn-danger">Delete</button>
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

    <!-- <script src="../js/scrips.js"></script> -->

    <script src="coordinator-PEO-PLO-Managment.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</body>

</html>