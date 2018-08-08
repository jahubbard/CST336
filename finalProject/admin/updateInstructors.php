<?php

session_start();

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

if (isset($_GET['instructorid'])) {
    $instructors = getInstructorInfo();
}

function getInstructorInfo() {
    global $conn;
    $sql = "SELECT * 
            FROM instructors 
            WHERE instructorid =" . $_GET['instructorid'];
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $record;
}

if (isset($_GET['updateInstructors'])) {
    $sql = "UPDATE instructors
        SET firstname = :firstname,
            lastname = :lastname,
            cert_type = :cert_type,
            address = :address,
            phone_number = :phone_number,
            locker_number = :locker_number,
            years_of_employment = :years_of_employment
        WHERE instructorid = :instructorid";
    $np = array();
    $np[':firstname'] = $_GET['firstname'];
    $np[':lastname'] = $_GET['lastname'];
    $np[':cert_type'] = $_GET['cert_type'];
    $np[':address'] = $_GET['address'];
    $np[':phone_number'] = $_GET['phone_number'];
    $np[':locker_number'] = $_GET['locker_number'];
    $np[':years_of_employment'] = $_GET['years_of_employment'];
    $np[':instructorid'] = $_GET['instructorid'];
    
    $statement = $conn->prepare($sql);
    $statement ->execute($np);
    echo "<h3>Instructor has been updated!</h3>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Instructor Student</title>
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
        
         <form> <!--Prefilled form values-->
            <input type="hidden" name="instructorid" value= "<?=$instructors['instructorid']?>"/>
            <br />
            <strong>First Name</strong> <input type="text" class="form-control" value = "<?=$instructors['firstname']?>" name="firstname"><br>
            <strong>Last Name</strong> <input type="text" class="form-control" value = "<?=$instructors['lastname']?>" name="lastname"><br>
            <strong>Certification Taught</strong> <input type="text" class="form-control" value = "<?=$instructors['cert_type']?>" name="cert_type"><br>
            <strong>Address</strong> <input type="text" class="form-control" value = "<?=$instructors['address']?>" name="address"><br>
            <strong>Phone Number</strong> <input type="text" class="form-control" value = "<?=$instructors['phone_number']?>" name="phone_number"><br>
            <strong>Locker Number</strong> <input type="text" class="form-control" value = "<?=$instructors['locker_number']?>" name="locker_number"><br>
            <strong>Years of Employment</strong> <input type="text" class="form-control" value = "<?=$instructors['years_of_employment']?>" name="years_of_employment"><br>
            <input type="submit" class='btn btn-primary' name="updateInstructors" value="Update Instructor">
        </form>
    </body>
</html>