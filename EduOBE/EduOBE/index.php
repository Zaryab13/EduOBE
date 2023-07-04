<?php
$username = $_POST["username"];
$password = $_POST["Password"];

// Database connection
try {
    $conn = new mysqli("localhost", "root", "", "eduobe");
    if ($conn->connect_error) {
        die("Failed to connect: " . $conn->connect_error);
    }

    $createTableQuery = "CREATE TABLE IF NOT EXISTS eduobe.AdminRegisteration ( id INT AUTO_INCREMENT PRIMARY KEY, university_name VARCHAR(255), department_name VARCHAR(255), Email VARCHAR(255), registration_date DATE, liciense_expiry DATE, user_name VARCHAR(50) UNIQUE, password VARCHAR(300))";
    $conn->query($createTableQuery);
    $create_table = "CREATE TABLE IF NOT EXISTS EDUOBE.Faculty ( first_name VARCHAR(50), middle_name VARCHAR(50), last_name VARCHAR(50), Employee_id VARCHAR(25) PRIMARY KEY, gender ENUM('Male', 'Female', 'Other'), Designation VARCHAR(50), highest_degree VARCHAR(50), appointment_type VARCHAR(50), role VARCHAR(50), DOB DATE, Email VARCHAR(100), phone VARCHAR(20), experience INT, cnic VARCHAR(15), joining_date DATE, leaving_date DATE, address VARCHAR(200), username VARCHAR(50) , password VARCHAR(300), pic_path VARCHAR(150) )";
    $conn->query($create_table);

    // if (!$createTableStmt) {
    //     die("Prepare failed: " . $conn->error);
    // }

    // if (!$createTableStmt->execute()) {
    //     die("Execute failed: " . $createTableStmt->error);
    // }


    $queries = [
        "SELECT * FROM eduobe.superadmin WHERE username = ? AND Password = SHA2(?, 256)",
        "SELECT * FROM eduobe.adminregisteration WHERE user_name = ? AND password = SHA2(?, 256)",
        "SELECT role FROM eduobe.faculty WHERE username = ? AND password = SHA2(?, 256)"
    ];

    foreach ($queries as $query) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            if ($query === $queries[0]) {
                header("Location: SuperAdmin.php");
                exit();
            } elseif ($query === $queries[1]) {
                header("Location: Admin/depttAdminManageUniDepttInfo.php?userName=".$username);
                exit();
            } elseif ($query === $queries[2]) {
                $row = $result->fetch_assoc();
                $role = $row['role'];
                
                if ($role === 'Coordinator') {
                    header("Location: Coordinator/coordinator-Program-Managment.php?userName=".$username);
                    exit();
                } elseif ($role === 'HOD') {
                    header("Location: HOD/depttAdminManageUniDepttInfo.php?userName=".$username);
                    exit();
                } elseif ($role === 'Teaching Staff') {
                    header("Location: Teacher/teacher-Classrooms.php?userName=".$username);
                    exit();
                } elseif ($role === 'Clerical Staff') {
                    header("Location: Admin/deptto.php");
                    exit();
                }
            }
        }
    }

    header("Location: login.html?error=1");
    exit();

    
    $conn->close();
    } catch (PDPException $err) {
        echo $err;
    }
?>