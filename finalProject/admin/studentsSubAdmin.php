<?php

session_start(); 

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

function displayAllStudents() {
    global $conn;
    $sql="SELECT * FROM students";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $records;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Students Page </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script>
            function confirmDelete() {
            return confirm("Are you sure you want to delete this student?");
            }
        </script>
    </head>
    <body>
        <header>
            <h1> Admin Students Page </h1>
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
        
        <form action="addStudents.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addStudents" value="Add Student"/>
        </form>

        <br />

        <form action="/finalProject/logout.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
        </form>
        
        <br />
        
        <?php 
        $records=displayAllStudents();

        echo "<table class='table table-hover'>";
        echo "<thread>
        <tr>
            <th scope='col'>Student ID</th>
            <th scope='col'>First Name</th>
            <th scope='col'>Last Name</th>
            <th scope='col'>Instructor ID</th>
            <th scope='col'>Aircraft ID</th>
            <th scope='col'>Certification Type</th>
            <th scope='col'>Address</th>
            <th scope='col'>Phone Number</th>
            <th scope='col'>Password</th>
            <th scope='col'>Feedback</th>
            <th scope='col'>Update</th>
            <th scope='col'>Remove</th>
        </tr>
       </thread>";
       echo"<tbody>";
       foreach($records as $record) {
           echo "<tr>";
           echo "<td>" . $record['studentid'] . "</td>";
           echo "<td>" . $record['firstname'] . "</td>";
           echo "<td>" . $record['lastname'] . "</td>";
           echo "<td>" . $record['instructorid'] . "</td>";
           echo "<td>" . $record['aircraft_id'] . "</td>";
           echo "<td>" . $record['cert_type'] . "</td>";
           echo "<td>" . $record['address'] . "</td>";
           echo "<td>" . $record['phone_number'] . "</td>";
           echo "<td>" . $record['password'] . "</td>";
           echo "<td>" . $record['feedback'] . "</td>";
           echo "<td><a class='btn btn-primary' href='updateStudents.php?studentid=" . $record['studentid'] . "'>Update</a></td>";
           
           echo "<form action='deleteStudents.php' onsubmit='return confirmDelete()'>";
           echo"<input type='hidden' name='studentid' value= " . $record['studentid'] . " />";
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