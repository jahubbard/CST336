<?php

session_start(); 

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

function displayAllInstructors() {
    global $conn;
    $sql="SELECT * FROM instructors";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $records;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Instructors Page </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script>
            function confirmDelete() {
            return confirm("Are you sure you want to delete this instructor?");
            }
        </script>
    </head>
    <body>
        <header>
            <h1> Admin Instructors Page </h1>
        </header>
        
        <h3> Welcome <?=$_SESSION['adminName']?>!</h3><br />
        
        <nav>
            <hr width="50%" />
            <a href="aircraftSubAdmin.php">Aircraft</a>
            <a href="instructorsSubAdmin.php">Instructors</a>
            <a href="mainAdmin.php"><strong>Main</strong></a>
            <a href="studentsSubAdmin.php">Students</a>
            <a href="certificatesSubAdmin.php">Certificates</a>
        </nav>
        
        <br /><br />
        
        <form action="addInstructors.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addInstructors" value="Add Instructor"/>
        </form>

        <br />
        
        
        <form action="instructorSeniority.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" name="instructorSeniority" value="Instructor Seniority List"/>
        </form>
        
        
        <br />

        <form action="/finalProject/logout.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
        </form>
        
        <br />
        
        <?php 
        $records=displayAllInstructors();

        echo "<table class='table table-hover'>";
        echo "<thread>
        <tr>
            <th scope='col'>Instructor ID</th>
            <th scope='col'>First Name</th>
            <th scope='col'>Last Name</th>
            <th scope='col'>Certification Taught</th>
            <th scope='col'>Address</th>
            <th scope='col'>Phone Number</th>
            <th scope='col'>Locker Number</th>
            <th scope='col'>Years of Employment</th>
            <th scope='col'>Update</th>
            <th scope='col'>Remove</th>
        </tr>
       </thread>";
       echo"<tbody>";
       foreach($records as $record) {
           echo "<tr>";
           echo "<td>" . $record['instructorid'] . "</td>";
           echo "<td>" . $record['firstname'] . "</td>";
           echo "<td>" . $record['lastname'] . "</td>";
           echo "<td>" . $record['cert_type'] . "</td>";
           echo "<td>" . $record['address'] . "</td>";
           echo "<td>" . $record['phone_number'] . "</td>";
           echo "<td>" . $record['locker_number'] . "</td>";
           echo "<td>" . $record['years_of_employment'] . "</td>";
           echo "<td><a class='btn btn-primary' href='updateInstructors.php?instructorid=" . $record['instructorid'] . "'>Update</a></td>";
           
           echo "<form action='deleteInstructors.php' onsubmit='return confirmDelete()'>";
           echo"<input type='hidden' name='instructorid' value= " . $record['instructorid'] . " />";
           echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
       }
       echo "</tbody>";
       echo "</table>";
       ?>
       
       <footer>
            <hr>
            CST 336. 2018&copy;  Zephyr Consultants <br />
        </footer>
    </body>
</html>