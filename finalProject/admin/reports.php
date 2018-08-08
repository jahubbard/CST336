<?php

session_start(); 

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Reports </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h1> Admin Reports </h1>
        </header>
        
        <br />
        
        <h3> Welcome <?=$_SESSION['adminName']?>!</h3>
        
        <br /><br />
        
        <nav>
            <hr width="50%" />
            <a href="aircraftSubAdmin.php">Aircraft</a>
            <a href="instructorsSubAdmin.php">Instructors</a>
            <a href="mainAdmin.php"><strong>Main</strong></a>
            <a href="studentsSubAdmin.php">Students</a>
            <a href="certificatesSubAdmin.php">Certificates</a>
        </nav>
         
        <br /><br />
        
        <div align="center">
            <form action="incomeFromCertificates.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" name="incomeFromCertificates" value="Income from Certifcates In Progress"/>
            </form>
        </div>
        
        <br />
        
        <div align="center">
            <form action="aircraftUsage.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" name="aircraftUsage" value="Aircraft Usage"/>
            </form>
        </div>
        
        <br />
        
        <div align="center">
            <form action="instructorsStudentAssignment.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" name="instructorsStudentAssignment" value="Instructors' Student Assignment"/>
            </form>
        </div>
        
        <br />
   
        <form action="/finalProject/logout.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
        </form>
        
        <br />
        
        <footer>
            <hr>
            CST 336. 2018&copy;  Zephyr Consultants <br />
        </footer>
        
    </body>
</html>
