<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <!-- Montserrat -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            ref="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
            rel="stylesheet">
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

        <!-- bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- Box-Icons -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/index.css">

        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>
    <?php
        if(isset($_GET['userName'])){
            $userName = $_GET['userName'];
        }
        // echo "==================------------------==================".$userName;
        $conn = new mysqli("localhost", "root", "", "eduobe");
        
        $create_uni = "CREATE TABLE IF NOT EXISTS EDUOBE.university_info ( id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) UNIQUE, short_name VARCHAR(50), type VARCHAR(50), city VARCHAR(50), address VARCHAR(100), issuing_authority VARCHAR(100), country VARCHAR(50), website VARCHAR(100), phone VARCHAR(20), file_path VARCHAR(100))";
        $conn->query($create_uni);
        
        $create_deptt = "CREATE Table IF NOT EXISTS EDUOBE.Department_Info ( id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) UNIQUE, short_name VARCHAR(50), vision VARCHAR(500), Mission VARCHAR(500), file_path VARCHAR(100) )";
        $conn->query($create_deptt);
          
        $get_uni = "SELECT name, short_name, type, city, address, issuing_authority, country, website, phone, file_path FROM EDUOBE.university_info";
        $get_deptt = "SELECT name, short_name, vision, mission, file_path FROM EDUOBE.department_info";
        
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
                    'name' => "University Name",
                    'short_name' => "Short Name",
                    'type' => "Public",
                    'city' => "City",
                    'address' => "Address",
                    'issuing_authority' => "issuing_authority",
                    'country' => "Country",
                    'website' => "Website",
                    'phone' => "Phone Number",
                    'file_path' => "file_path",
                )
            );
        }

        // echo $data_deptt;
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
                    'name' => "Department Name",
                    'short_name' => "Department short Name",
                    'vision' => "Vision",
                    'mission' => "Mission",
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
                            <span class="link_name">Admin</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">Uni & Deptt <br> Management</a>
                        </li>
                        <li>
                            <a href="depttAdminManageFaculty.php?uniLogo=<?php echo $uni_logo;?>&depttLogo=<?php echo $deptt_logo;?>&userName=<?php echo $userName;?>">Faculty Management</a>
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
                <h3 class="ms-3 my-4">Dashboard</h3>
                <div class="bread-crumbs d-flex">
                    <div aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item mx-3">
                                <a href="#"><img src="../icons/home.svg" alt=""></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                </div>

                <section class="uni-info container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section-heading">University Information</h2>
                        </div>

                        <div class="row university-info justify-content-center">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn edit-profile-btn" id="editUniInfoButton" data-bs-toggle="modal" data-bs-target="#editUniModalContainer">
                                    <span class="icon">
                                        <img src="../icons/edit.svg" alt="Edit Icon">
                                    </span>
                                    <span class="text">Edit</span>
                                </button>
                            </div>
    <!--------------------------------- University ionformation ---------------------------------------->
                            <?php
                                
                                // Check if data existseditUniInfoButton
                                if (!empty($data_uni)) {
                                    $uni_name = $data_uni[0]['name'];
                                    $uni_shortName = $data_uni[0]['short_name'];
                                    $uni_type = $data_uni[0]['type'];
                                    $uni_issuingAuthority = $data_uni[0]['issuing_authority'];
                                    // $uni_logo = $data_uni[0]['file_path'];
                                    
                                    if (!empty($data_uni)) {
                                        echo "<div class='col-lg-6 card profile-card me-4'>";
                                        echo "<img src='$uni_logo' alt='profile-image' class='profile-image' />";
                                        echo "<div class='card-content'>";
                                    
                                    } else {
                                        echo "<div class='col-lg-6 card profile-card me-4'>";
                                        echo "<img src='$uni_logo' alt='profile-image' class='profile-image' />";
                                        echo "<div class='card-content'>";
                                        
                                    }

                                    echo "<h2>$uni_name</h2>";
                                    echo "<div class='other-info d-flex flex-column'>";
                                    echo "<div class='user-type'>";
                                    echo "<span>Type: </span>";
                                    echo "<span>$uni_type</span>";
                                    echo "</div>";
                                    echo "<div class='issue-authority'>";
                                    echo "<span>Issue Authority: </span>";
                                    echo "<span>$uni_issuingAuthority</span>";
                                    echo "</div>";
                                    echo "</div>";
                                } else {
                                    // If no data is found, display default values
                                    echo "<h2>University Name<small></small></h2>";
                                    echo "<div class='other-info d-flex flex-column'>";
                                    echo "<div class='user-type'>";
                                    echo "<span>Type:</span>";
                                    echo "<span></span>";
                                    echo "</div>";
                                    echo "<div class='issue-authority'>";
                                    echo "<span>Issue Authority:</span>";
                                    echo "<span></span>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                    </div>

                            <div class="col-lg-4 contact-card d-flex justify-content-between ">
                                <div class="row prof-body">
                                    <div class="col-lg-12 ">
                                        <div class="info d-flex">
                                            <div class="col-lg-3">
                                                <img src="../icons/calling.svg" alt="" style="margin-bottom: 15px; margin-top: 20px;">
                                                <img src="../icons/website.svg" alt="" style="margin-bottom: 40px;">
                                                <img src="../icons/country.svg" alt="" style="margin-bottom: 15px;">
                                                <img src="../icons/city.svg" alt="" style="margin-bottom: 15px;">
                                                <img src="../icons/Address.svg" alt="" >
                                                
                                            </div>
                                            <div class="col-lg-9">
                                                <p style="margin-bottom: 22px; margin-top: 20px;">
                                                    <?php
                                                        // Check if data exists
                                                        if (!empty($data_uni)) {
                                                            $uni_phone = $data_uni[0]['phone'];
                                                            echo "$uni_phone";
                                                        } else {
                                                            echo "<p></p>";
                                                        }
                                                    ?>
                                                </p>
                                                <p style="margin-bottom: 48px;">
                                                    <?php
                                                        // Check if data exists
                                                        if (!empty($data_uni)) {
                                                            $uni_website = $data_uni[0]['website'];
                                                            echo "$uni_website";
                                                        } else {
                                                            echo "<p></p>";
                                                        }
                                                    ?>
                                                </p>
                                                <p style="margin-bottom: 20px;">
                                                    <?php
                                                        // Check if data exists
                                                        if (!empty($data_uni)) {
                                                            $uni_country = $data_uni[0]['country'];
                                                            echo "$uni_country";
                                                        } else {
                                                            echo "<span></span>";
                                                        }
                                                    ?>
                                                </p>
                                                <p style="margin-bottom: 20px;">
                                                    <?php
                                                        // Check if data exists
                                                        if (!empty($data_uni)) {
                                                            $uni_city = $data_uni[0]['city'];
                                                            echo "$uni_city";
                                                        } else {
                                                            echo "<span></span>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                    <?php
                                                        // Check if data exists
                                                        if (!empty($data_uni)) {
                                                            $uni_address = $data_uni[0]['address'];
                                                            echo "<span>$uni_address</span>";
                                                        } else {
                                                            echo "<span></span>";
                                                        }
                                                    ?>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Uni Info Modal -->
                            <div class="modal fade" id="editUniModalContainer" tabindex="-1" aria-labelledby="EditDepttInfoModal" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update University Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content-container">
                                            <form class="me-1" id="uniInfoAddEditform" method="POST" enctype='multipart/form-data'> 
                                                <script>
                                                    // Get the username value from PHP and set it as a JavaScript variable
                                                    var profileUsername = "<?php echo $userName; ?>";

                                                    // Get the form element using its ID
                                                    var form = document.getElementById('uniInfoAddEditform');

                                                    // Set the action attribute of the form dynamically
                                                    form.action = 'updateUniInfoQuery.php?userName=' + profileUsername;
                                                </script>    
                                            
                                            <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="uniName" class="form-label">Name</label>
                                                            <input type="text" name="University_Name" class="form-control form-animation" id="uniName" value = "<?php echo $uni_name?>" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="unitShortName" class="form-label">Short Name</label>
                                                            <input type="text" name="uniShortName" class="form-control form-animation" id="uniShortName" value = "<?php echo $uni_shortName ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3" >
                                                            <label for="uniIssuingAuthority" class="form-label">Issuing Authority</label>
                                                            <select class="form-select form-animation" id="uniIssuingAuthority" name = "uniIssuingAuthority">
                                                            <option value="" selected><?php echo $uni_issuingAuthority ?></option>
                                                            <option value="Public">Public</option>
                                                            <option value="Government">Government</option>
                                                            <option value="Semi Government">Semi Government</option>
                                                            <option value="Private">Private</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3" >
                                                            <label for="uniType" class="form-label">Type</label>
                                                            <select class="form-select form-animation" id="uniType" name = "uniType">
                                                            <option selected><?php echo $uni_type ?> </option>
                                                            <option value="Lecturer">Option 1</option>
                                                            <option value="Assistant Professor">Option 2</option>
                                                            <option value="Senior Assistant Professor">Option 3</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="uniPhone" class="form-label">Phone No</label>
                                                            <input type="text" name="uniPhone" class="form-control form-animation" id="uniPhone" value = "<?php echo $uni_phone ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="unitWebsite" class="form-label">Website URL</label>
                                                            <input type="url" name="uniWebsite" class="form-control form-animation" id="uniWebsite" value = "<?php echo $uni_website ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="uniCity" class="form-label">City</label>
                                                            <input type="text" name="uniCity" class="form-control form-animation" id="uniCity" value = "<?php echo $uni_city ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="uniCountry" class="form-label">Country</label>
                                                            <input type="text" name="uniCountry" class="form-control form-animation" id="uniCountry" value = "<?php echo $uni_country ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="uniAddress" class="form-label">Address</label>
                                                            <input type="text" name="uniAddress" class="form-control form-animation" id="uniAddress" value = "<?php echo $uni_address ?>">
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="uni_logo" class="form-label">Uni Logo</label>
                                                            <input type="file" name="uni_logo" class="form-control form-animation">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary cancel-button" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    
                                </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- deptt info -->
                        <div class="row deptt-info justify-content-center">
                            <div class="col-12">
                                <h2 class="section-heading">Department Information</h2>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="editDepttInfoButton" type="button" class="btn edit-profile-btn" data-bs-toggle="modal" data-bs-target="#editDepttModalContainer">
                                    <span class="icon">
                                        <img src="../icons/edit.svg" alt="Edit Icon">
                                    </span>
                                    <span class="text">Edit</span>
                                </button>
                            </div>
                            <?php
                               
                                // Check if data exists
                                if (!empty($data_deptt)) {
                                    $deptt_name = $data_deptt[0]['name'];
                                    $deptt_short_name= $data_deptt[0]['short_name'];
                                    $deptt_vision = $data_deptt[0]['vision'];
                                    $deptt_mission = $data_deptt[0]['mission'];
                                    $deptt_logo = $data_deptt[0]['file_path'];
                                    
                                    if (!empty($data_uni)) {
                                        echo "<div class='col-lg-9 card Uni-card deptt-container me-4'>";
                                        echo "<img src='$deptt_logo' alt='profile-image' class='profile-image' />";
                                        echo "<div class='card-content'>";
                                    
                                    } else {
                                        echo "<div class='col-lg-9 card Uni-card deptt-container me-4'>";
                                        echo "<img src='$deptt_logo' alt='profile-image' class='profile-image' />";
                                        echo "<div class='card-content '>";
                                        
                                    }
                                    
                                    
                                    echo "<h2>$deptt_name</h2>";
                                    echo "<div class='other-info d-flex flex-column'>";
                                    echo "<div class='user-type'>";
                                    echo "<span>Vision: </span>";
                                    echo "<span>$deptt_vision</span>";
                                    echo "<div>";
                                    echo "<span>Mission: </span>";
                                    echo "<span>$deptt_mission</span>";
                                    echo "</div>";
                                    echo "</div>";
                                } else {
                                    // If issue-authorityno data is found, display default values
                                    echo "<h2>University Name<small></small></h2>";
                                    echo "<div class='other-info d-flex flex-column'>";
                                    echo "<div class='user-type'>";
                                    echo "<span>Vision</span>";
                                    echo "<span></span>";
                                    echo "</div>";
                                    echo "<div class=''>";
                                    echo "<span>Mission</span>";
                                    echo "<span></span>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            ?>
                            </div>
                            </div> 

                           <!-- Deptt Info Modal -->
                           <div class="modal fade" id="editDepttModalContainer" tabindex="-1" aria-labelledby="EditDepttInfoModal" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Department Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-content-container">
                                            <form class="me-1" id="depttInfoAddEditform" method="POST" enctype='multipart/form-data'> 
                                                <script>
                                                    // Get the username value from PHP and set it as a JavaScript variable
                                                    var profileUsername = "<?php echo $userName; ?>";

                                                    // Get the form element using its ID
                                                    var form = document.getElementById('depttInfoAddEditform');

                                                    // Set the action attribute of the form dynamically
                                                    form.action = 'updateDepttInfoQuery.php?userName=' + profileUsername;
                                                </script>       
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="depttName" class="form-label">Name</label>
                                                            <input type="text" name = "depttName" class="form-control form-animation" id="depttName" value = "<?php echo $deptt_name ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="depttShortName" class="form-label">Short Name</label>
                                                            <input type="text" name = "depttShortName" class="form-control form-animation" id="depttShortName" value = "<?php echo $deptt_short_name ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="depttVision" class="form-label">Vision</label>
                                                            <input type="text" name = "depttVision" class="form-control form-animation" id="depttVision" value = "<?php echo $deptt_vision ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="uniMission" class="form-label">Mission</label>
                                                            <input type="text" name = "depttMission" class="form-control form-animation" id="uniMission" value = "<?php echo $deptt_mission ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mb-2">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="deptt_logo" class="form-label">Deptt Logo</label>
                                                            <input type="file" name = "deptt_logo" class="form-control form-animation" id="depttLogoUrl">
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary cancel-button" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" >Update</button>
                                                    </div>
                                                </div>
                                            </form>
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


        </div>
        </section>

        <script src="../js/index.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>
        
    </body>

    </html>
</body>

</html>



