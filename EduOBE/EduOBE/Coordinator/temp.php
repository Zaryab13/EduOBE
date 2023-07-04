<body class="preload">
    <?php
        
        $conn = new mysqli("localhost", "root", "", "eduobe");
        // require_once("config/db.php");
        $createBOSTableQuery = "CREATE TABLE IF NOT EXISTS EDUOBE.BOSDetail(
            semester VARCHAR(50),
            term VARCHAR(25),
            course_code VARCHAR(50),
            course_type VARCHAR(25),
            credits INT(25),
            BOS_code VARCHAR(25),
            PRIMARY KEY (course_code,BOS_code)
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
        $getdata = "SELECT BOSDetail.semester,courses.name, BOSDetail.course_type,BOSDetail.credits,BOSDetail.term
                    FROM BOSDetail
                    INNER JOIN courses
                    ON BOSDetail.course_code = courses.code;";
        $resultdata = $conn->query($getdata);

        // Check if there are any rows returned
        if ($resultdata->num_rows > 0) {
            // Fetch the data as an associative array
            $data = array();
            while ($row = $resultdata->fetch_assoc()) {
                $data[] = $row;
            }
        }else{
            $data=NULL;
        }
        // Convert the BOS PHP array to a JSON string
        $jsonData = json_encode($data);
        echo "<script>var jsonData = $jsonData;</script>";
    

        // Close the connection
        $conn->close();
    ?>
    <script>
        var jsonData = <?php echo $jsonData; ?>;
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
                <a href="">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Coordinator</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="">Coordinator</a></li>
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
                    <img src="../img/uom logo.png" alt="">
                    <img src="../img/uom se logo.png" alt="">
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
                                <li class="notification"><a href="#"><img src="../icons/profile.svg" alt="">
                                        Muhammad
                                        Arsalan</a>
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
                                Muhammad Arsalan
                            </a>
                            <button type="button" class="dropBtn">
                                <i class="bx bxs-chevron-down arrow"></i>
                            </button>
                            <ul class="prof-sub-menu" id="profileSubMenu">
                                <li>
                                    <a href="#">
                                        <img src="../icons/profile.svg" alt="">
                                        <span class="user-name-text">
                                            Muhammad Arsalan
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="adminProfile.html">
                                        <img src="../icons/add-user.svg" alt="">
                                        <span>
                                            Profile
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="../icons/key.svg" alt="">
                                        <span>
                                            Reset Password
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
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
            <h3 class="ms-3 my-4">BOS Management</h3>
            <div class="bread-crumbs d-flex">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mx-3">
                            <a href="coordinator.html"><img src="../icons/home.svg" alt=""></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">BOS Management</a></li>
                        <li class="breadcrumb-item selected-BOS"><a href="#"></a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <h3 class="section-heading">Board of Study Details</h3>

                    <div class="BOS-section row">
                        <div class="section-head">
                            <h5 class="title">Courses List for BOS <b><span class="selected-BOS"></span></b></h5>
                            <button class="csvBtn">Import CSV</button>
                        </div>
                        <div class="row Course-table">
                            <table id="Course-dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Course Type</th>
                                        <th scope="col">Credits</th>
                                        <th scope="col">Term</th>
                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                            </table>
                            <div class="order-last add-user">
                                <div class="ad-user col-lg-12" data-bs-target="#addCourseModal" data-bs-toggle="modal">
                                    <img id="addCourseBtn" src="../icons/plus-circle.svg" alt="">
                                </div>
                            </div>
                            

                            <!-- Add BOS Modal -->
                            <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCourseModalLabel">Add BOS</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-content-container">
                                                <form class="me-1" id="BOSDetailsForm" method="POST">
                                                    <div class="row mb-2">
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="semester" class="form-label">Semester</label>
                                                                <select name="semester" class="form-select form-animation" id="semester">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="term" class="form-label">Term</label>
                                                                <select name="term" class="form-select form-animation" id="term">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Fall">Fall</option>
                                                                    <option value="Spring">Spring</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- ===================================================== -->
                                                    <?php
                                                        $conn = new mysqli("localhost", "root", "", "eduobe");
                                                        // require_once("config/db.php");
                                                        $createTableQuery ="CREATE TABLE IF NOT EXISTS eduobe.courses (code VARCHAR(25) PRIMARY KEY,name VARCHAR(50),delivery_formate VARCHAR(500),course_level VARCHAR(50))";
                                                        $createtableStmt = $conn->prepare($createTableQuery);
                                                        $createtableStmt->close();
                                                    
                                                    
                                                        // ======================================  get data
                                                        $getdata = "SELECT code FROM eduobe.courses";
                                                        $resultcourse = $conn->query($getdata);
                                                    
                                                        // Check if there are any rows returned
                                                        if ($resultcourse->num_rows > 0) {
                                                            // Fetch the data as an associative array
                                                            $datacourse = array();
                                                            while ($row = $resultcourse->fetch_assoc()) {
                                                                $datacourse[] = $row;
                                                            }
                                                        }else{
                                                            $datacourse=NULL;
                                                        }
                                                        // Close the connection
                                                        $conn->close();
                                                    ?>
                                                    <!-- ===================================================== -->

                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="course" class="form-label">Course</label>
                                                                <select name="coursecode" class="form-select form-animation" id="course">
                                                                    <option value="" selected>- Select -</option>
                                                                    <?php
                                                                    if (!empty($datacourse)) {
                                                                        foreach ($datacourse as $row) {
                                                                            echo '<option value="' . $row['code'] . '">' . $row['code'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="course-type" class="form-label">Course Type</label>
                                                                <select name="courseType" class="form-select form-animation" id="course-type">
                                                                    <option value="" selected>Select an option</option>
                                                                    <option value="Elective">Elective</option>
                                                                    <option value="Compulsory">Compulsory</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="credits" class="form-label">Credits</label>
                                                                <input name="credits" type="text" class="form-control form-animation"
                                                                    id="credits">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary cancel-button"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" id="Course-modalAddUpdateBtn">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Confirmatin Modal -->
                            <div class="modal fade" id="deleteCourseConfirmationModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                                            <button type="button" id="confirmDeleteCourseBtn" class="btn btn-danger">Delete</button>
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


    <script src="coordinator-BOS-Managment-bos-details.js"></script>
    <!-- <script src="bos-table1.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>


</body>