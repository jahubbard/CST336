<?php

session_start();

include 'dbConnection.php'; //Have to have access to the db file code

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['adminName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

$sql = "DELETE FROM aircraft WHERE aircraft_id = " . $_GET['aircraft_id'];
$statement = $conn->prepare($sql);
$statement->execute();

header("Location: aircraftSubAdmin.php");


?>