<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edu OBE | SuperAdmin</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Box-Icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">


    <!-- Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<body class="preload">
    <!-- Edit Admin Handler Query  ------  sending data to scripts.js -->
<?php
    $conn = new mysqli("localhost", "root", "", "eduobe");
    // require_once("config/db.php");
    $get = "SELECT id, university_name, department_name, Email, user_name, registration_date, liciense_expiry FROM eduobe.adminregisteration";
    // $result = mysqli_query($conn, $query);
    $result = $conn->query($get);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Fetch the data as an associative array
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        // Assign default values if no data is found
        $data = array(
            array(
                'id' => "",
                'university_name' => "",
                'department_name' => "",
                'Email' => "",
                'user_name' => "",
                'registration_date' => "",
                'liciense_expiry' => ""
            )
        );
    }

    // Convert the PHP array to a JSON string
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
            <img src="img/Logo 2.png" alt="">
            <span class="logo_name">Edu OBE</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="SuperAdmin.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="SuperAdmin.php">Dashboard</a></li>
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
                <div class="top-link-items">
                    <ul>
                        <li>
                            <a href="#">About App </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-right">
                <div class="top-link-items">
                    <ul>
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
                                        <img src="icons/profile.svg" alt="">
                                        <span class="user-name-text">
                                            Muhammad Arsalan
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="resetPassword.php">
                                        <img src="icons/key.svg" alt="">
                                        <span>
                                            Reset Password
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="icons/logout.svg" alt="">
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
                            <a href="index.php"><img src="icons/home.svg" alt=""></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 admin-container">
                        <h3>Admin Management</h3>
                        <div class="ad-info">
                            <div class="t-entries">
                                <span>Total No of Entries</span>
                                <span class="total-departments"></span>
                            </div>

                        </div>
                        <div class="row">
                            <table class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">University Name</th>
                                        <th scope="col">Department Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Reg. Date</th>
                                        <th scope="col">Licience Expiry</th>
                                        <th scope="col">Action</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                                              
                                <tbody id="added-departments">
                                </tbody>
                            </table>
                            <div class="row add-user">
                                <div class="ad-user col-lg-12">
                                    <img id="addUserBtn" src="icons/plus-circle.svg" alt="">
                                </div>
                            </div>
                            
                            <!-- Add Admin Modal -->
                            <div class="modalsContainer" id="modalContainer">
                                <div class="dark-overlay"></div>
                                <div class="add-user-popUp" id="popUp">
                                    <form id="inputForm" name="popUp-form" method ="POST">
                                        <div class="row personal-info">
                                            <h3 class="popup-title" id='addDepttModalTitle'>Register Department</h3>
                                            <div class="close-icon" id="closeIcon">
                                                <img src="icons/close-circle-outline.svg" alt="">
                                            </div>
                                            <!-- <h4 class="col-lf-12 info-title">Personal Information</h4> -->
                                            <div class="col-lg-6 d-flex flex-column mt-4">
                                                <span>University Name</span>
                                                <input type="text" required name="University_Name" id="university-name-input">
                                            </div>
                                            <div class="col-lg-6 d-flex flex-column mt-4">
                                                <span>Department Name</span>
                                                <input type="text" required name="Department_Name" id="dept-name-input">
                                            </div>
                                            <div class="col-lg-6 d-flex flex-column mt-4">
                                                <span>Email</span>
                                                <input type="email" required name="Email" id="email-input">
                                            </div>
                                            <div class="col-lg-6 d-flex flex-column mt-4">
                                                <span>Username</span>
                                                <input type="text" required  name="UserName" id="username-input">
                                            </div>
                                            <div class="col-lg-6 d-flex mt-4">
                                                <span>Years of Licensing</span>
                                                <div class="select">
                                                    <select name="years_of_liciense">
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
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center buttons">
                                            <button class="addUserTo col-lg-6" id='addAdminModalConfirmButton'>Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this Department Record?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>      
                    </div>
                </div>

            </div>
        </div>



    </section>

    

    <script src="js/index.js"></script>

    <script src="js/scrips.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>