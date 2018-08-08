<?php

session_start();

include 'dbConnection.php';

$conn = getDatabaseConnection("channel_islands");

$lastname = $_POST['lastname'];
$password = sha1($_POST['password']);

// echo $password;

// following sql prevents sql injection by avoiding using single quotes
$sql = "SELECT * 
        FROM students
        WHERE lastname = :lastname
        AND   password = :password";
        
$np = array();
$np[":lastname"] = $lastname;
$np[":password"] = $password;

$stmt = $conn->prepare($sql);
$stmt->execute($np);
$record = $stmt->fetch(PDO::FETCH_ASSOC); // expecting one single record

if (empty($record)) {
    $_SESSION['incorrect'] = true;
    header("Location:index.php");
} else if ($record['lastname'] == 'Admin') {
    $_SESSION['incorrect'] = false;
    $_SESSION['adminName'] = $record['firstname'] . " " . $record['lastname'];
    header("Location:admin/mainAdmin.php"); 
} else {
    //echo $record['firstName'] . " " . $record['lastName'];
    $_SESSION['incorrect'] = false;
    $_SESSION['studentName'] = $record['firstname'] . " " . $record['lastname'];
    header("Location:/finalProject/customer/mainpage.php");
}

?>