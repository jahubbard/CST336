<?php
session_start();

include 'dbConnection.php';
$conn = getDatabaseConnection("channel_islands");

$feedback = $_POST['feedback'];

$sql = "UPDATE `students` 
        SET `feedback` = :feedback
        WHERE `students`.`lastname` = :lastname";
        
$data = array(
    ":lastname" => $_SESSION['lastname'],
    ":feedback" => $feedback
);

$stmt = $conn->prepare($sql);
$stmt->execute($data);


//Adding new feedback to database

?>