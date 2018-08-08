<?php

session_start();

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

if (isset($_GET['studentid'])) {
    $students = getStudentInfo();
}

function getStudentInfo() {
    global $conn;
    $sql = "SELECT * 
            FROM students 
            WHERE studentid =" . $_GET['studentid'];
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $record;
}

if (isset($_GET['updateStudents'])) {
    $sql = "UPDATE students
        SET firstname = :firstname,
            lastname = :lastname,
            instructorid = :instructorid,
            aircraft_id = :aircraft_id,
            cert_type = :cert_type,
            address = :address,
            phone_number = :phone_number,
            password = :password,
            feedback = :feedback
        WHERE studentid = :studentid";
    $np = array();
    $np[':firstname'] = $_GET['firstname'];
    $np[':lastname'] = $_GET['lastname'];
    $np[':instructorid'] = $_GET['instructorid'];
    $np[':aircraft_id'] = $_GET['aircraft_id'];
    $np[':cert_type'] = $_GET['cert_type'];
    $np[':address'] = $_GET['address'];
    $np[':phone_number'] = $_GET['phone_number'];
    $np[':password'] = $_GET['password'];
    $np[':feedback'] = $_GET['feedback'];
    $np[':studentid'] = $_GET['studentid'];
    
    $statement = $conn->prepare($sql);
    $statement ->execute($np);
    echo "<h3>Student has been updated!</h3>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Update Student</title>
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
        
         <form> <!--Prefilled form values-->
            <input type="hidden" name="studentid" value= "<?=$students['studentid']?>"/>
            <br />
            <strong>First Name</strong> <input type="text" class="form-control" value = "<?=$students['firstname']?>" name="firstname"><br>
            <strong>Last Name</strong> <input type="text" class="form-control" value = "<?=$students['lastname']?>" name="lastname"><br>
            <strong>Instructor ID</strong> <input type="text" class="form-control" value = "<?=$students['instructorid']?>" name="instructorid"><br>
            <strong>Aircraft ID</strong> <input type="text" class="form-control" value = "<?=$students['aircraft_id']?>" name="aircraft_id"><br>
            <strong>Certification in progress</strong> <input type="text" class="form-control" value = "<?=$students['cert_type']?>" name="cert_type"><br>
            <strong>Address</strong> <input type="text" class="form-control" value = "<?=$students['address']?>" name="address"><br>
            <strong>Phone Number</strong> <input type="text" class="form-control" value = "<?=$students['phone_number']?>" name="phone_number"><br>
            <strong>Password</strong> <input type="text" class="form-control" value = "<?=$students['password']?>" name="password"><br>
            <strong>Feedback</strong> <input type="text" class="form-control" value = "<?=$students['feedback']?>" name="feedback"><br>
            <input type="submit" class='btn btn-primary' name="updateStudents" value="Update Student">
        </form>
    </body>
</html>