<?php

session_start();

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

if (isset($_GET['submitStudents'])) {
    $studentid = $_GET['studentid'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $instructorid = $_GET['instructorid'];
    $aircraft_id = $_GET['aircraft_id'];
    $cert_type = $_GET['cert_type'];
    $address = $_GET['address'];
    $phone_number = $_GET['phone_number'];
    $password = $_GET['password'];
    
    $sql = "INSERT INTO students
            ( studentid, firstname, lastname, instructorid, aircraft_id, cert_type, address, phone_number, password)
             VALUES ( :studentid, :firstname, :lastname, :instructorid, :aircraft_id, :cert_type, :address, :phone_number, :password)";
             
    $namedParameters = array();
    $namedParameters[':studentid'] = $studentid;
    $namedParameters[':firstname'] = $firstname;
    $namedParameters[':lastname'] = $lastname;
    $namedParameters[':instructorid'] = $instructorid;
    $namedParameters[':aircraft_id'] = $aircraft_id;
    $namedParameters[':cert_type'] = $cert_type;
    $namedParameters[':address'] = $address;
    $namedParameters[':phone_number'] = $phone_number;
    $namedParameters[':password'] = $password;
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
    
    echo "<h3>Student has been added!</h3>";
}

?>
   
<!DOCTYPE html>
<html>
    <head>
        <title> Add Students</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <br /><br />
        
        <nav>
            <hr width="50%" />
            <a href="studentsSubAdmin.php">Students</a>
        </nav>
         
        <br /><br />
        
        <form>
           <br />
            <strong>Student ID</strong> <input type="text" class="form-control"name="studentid"><br>
            <strong>Student First Name</strong> <input type="text" class="form-control"name="firstname"><br>
            <strong>Student Last Name</strong> <input type="text" class="form-control"name="lastname"><br>
            <strong>Student's Instructor ID</strong> <input type="text" class="form-control"name="instructorid"><br>
            <strong>Student's Aircraft</strong> <input type="text" class="form-control"name="aircraft_id"><br>
            <strong>Student's Certification in progress</strong> <input type="text" class="form-control"name="cert_type"><br>
            <strong>Address</strong> <input type="text" class="form-control"name="address"><br>
            <strong>Phone Number</strong> <input type="text" class="form-control"name="phone_number"><br>
            <strong>Password</strong> <input type="text" class="form-control"name="password"><br>
            <input type="submit" name="submitStudents" class='btn btn-primary' value="Add Student">
        </form>
    </body>
</html>