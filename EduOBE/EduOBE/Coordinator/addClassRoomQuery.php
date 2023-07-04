<?php
    $batchId = $_POST['batchId'];
    $semester = $_POST['semester'];
    $courseId = $_POST['courseId'];
    $term = $_POST['term'];
    $teacherName = $_POST['teacherName'];
    $isActive = 1;


    $username = $_GET["userName"];
    $uni_logo = $_GET["uniLogo"];
    $deptt_logo = $_GET["depttLogo"];

     // Database connection
     $conn = new mysqli("localhost", "root", "", "eduobe");
     if ($conn->connect_error) {
         die("Failed to connect: " . $conn->connect_error);
     } else {
         // Create table query
         $createTableQuery ="CREATE TABLE IF NOT EXISTS eduobe.classroom (
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
 
         // Prepare and execute create table query
         $createTableStmt = $conn->prepare($createTableQuery);
         if (!$createTableStmt) {
             die("Prepare failed: " . $conn->error);
         }
 
         if (!$createTableStmt->execute()) {
             die("Execute failed: " . $createTableStmt->error);
         }
         $createTableStmt->close();
 
         // Insert data query
         $insertDataQuery = "INSERT INTO EDUOBE.classroom (batch_id, semester ,course_id, term, teacher_name, status)
             VALUES (?,?,?,?,?,?)";
 
         // Prepare and execute insert data query
         $insertDataStmt = $conn->prepare($insertDataQuery);
         $insertDataStmt->bind_param("sssssi",$batchId, $semester, $courseId, $term, $teacherName, $isActive);
         if (!$insertDataStmt) {
             die("Prepare failed: " . $conn->error);
         }
         if (!$insertDataStmt->execute()) {
             die("Execute failed: " . $insertDataStmt->error);
         }else{
             // -------------------->  Success
             // echo "Success";
             header("Location: coordinator-Classroom-Management.php?userName=".$username."&uniLogo=".$uni_logo."&depttLogo=".$deptt_logo);
         }
         // Perform your desired operations with each selected option
         
 
         $insertDataStmt->close();
         $conn->close();
     }
    


?>