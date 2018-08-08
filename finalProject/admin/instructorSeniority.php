<?php

session_start(); 

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

function displayInstructorSeniority() {
    global $conn;
    $sql="SELECT instructorid, firstname, lastname, years_of_employment 
          FROM instructors 
          ORDER BY years_of_employment 
          DESC";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $records;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Seniority List </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h1> Seniority List </h1>
        </header>
        
        <h3> Welcome <?=$_SESSION['adminName']?>!</h3><br />
        
        <nav>
            <hr width="50%" />
            <a href="instructorsSubAdmin.php">Instructors</a>
        </nav>
        
        <br /><br />

        <br />

        <form action="/finalProject/logout.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
        </form>
        
        <br />
        
        <?php 
        $records=displayInstructorSeniority();

        echo "<table class='table table-hover'>";
        echo "<thread>
        <tr>
            <th scope='col'>Instructor ID</th>
            <th scope='col'>First Name</th>
            <th scope='col'>Last Name</th>
            <th scope='col'>Years of Employment</th>
        </tr>
       </thread>";
       echo"<tbody>";
       foreach($records as $record) {
           echo "<tr>";
           echo "<td>" . $record['instructorid'] . "</td>";
           echo "<td>" . $record['firstname'] . "</td>";
           echo "<td>" . $record['lastname'] . "</td>";
           echo "<td>" . $record['years_of_employment'] . "</td>";
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