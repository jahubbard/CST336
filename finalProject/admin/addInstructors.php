<?php

session_start();

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

if (isset($_GET['submitInstructors'])) {
    $instructorid = $_GET['instructorid'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $cert_type = $_GET['cert_type'];
    $address = $_GET['address'];
    $phone_number = $_GET['phone_number'];
    $locker_number= $_GET['locker_number'];
    $years_of_employment = $_GET['years_of_employment'];
    
    $sql = "INSERT INTO instructors
            ( instructorid, firstname, lastname, cert_type, address, phone_number, locker_number, years_of_employment )
             VALUES ( :instructorid, :firstname, :lastname, :cert_type, :address, :phone_number, :locker_number, :years_of_employment)";
             
    $namedParameters = array();
    $namedParameters[':instructorid'] = $instructorid;
    $namedParameters[':firstname'] = $firstname;
    $namedParameters[':lastname'] = $lastname;
    $namedParameters[':cert_type'] = $cert_type;
    $namedParameters[':address'] = $address;
    $namedParameters[':phone_number'] = $phone_number;
    $namedParameters[':locker_number'] = $locker_number;
    $namedParameters[':years_of_employment'] = $years_of_employment;
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
    
    echo "<h3>Instructor has been added!</h3>";
}

?>
   
<!DOCTYPE html>
<html>
    <head>
        <title> Add Instructors</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <br /><br />
        
        <nav>
            <hr width="50%" />
            <a href="instructorsSubAdmin.php">Instructors</a>
        </nav>
         
        <br /><br />
        
        <form>
           <br />
            <strong>Instructor ID</strong> <input type="text" class="form-control"name="instructorid"><br>
            <strong>Instructor First Name</strong> <input type="text" class="form-control"name="firstname"><br>
            <strong>Instructor Last Name</strong> <input type="text" class="form-control"name="lastname"><br>
            <strong>Certification Taught</strong> <input type="text" class="form-control"name="cert_type"><br>
            <strong>Address</strong> <input type="text" class="form-control"name="address"><br>
            <strong>Phone Number</strong> <input type="text" class="form-control"name="phone_number"><br>
            <strong>Locker Number</strong> <input type="text" class="form-control"name="locker_number"><br>
            <strong>Years of Employment</strong> <input type="text" class="form-control"name="years_of_employment"><br>
            <input type="submit" name="submitInstructors" class='btn btn-primary' value="Add Instructor">
        </form>
    </body>
</html>