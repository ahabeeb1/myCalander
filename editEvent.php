<?php

include ('test.php');

//take user input as variables
$event = filter_input(INPUT_POST, 'event');
$date = filter_input(INPUT_POST, 'date');

$newEvent = filter_input(INPUT_POST, 'newEvent');
$newDate = filter_input(INPUT_POST, 'newDate');
$newDays = filter_input(INPUT_POST, 'newDays');
$newColor = filter_input(INPUT_POST, 'newColor');
$username1 = $_SESSION["username"];

//make sure connected to database
try {
    $dsn = 'mysql:host=localhost;dbname=demo';
    $username = 'root';
    $password = '';
    $db = new PDO($dsn,$username,$password);
    //echo "<p> You are connected to the database!</p>";
} catch(PDOException $e) {
    $error_message = $e -> getMessage();
    echo "<p> An error occured while connecting to the database: $error_message </p>";
}

//query to delete from db
if($event != false && $date != false) {
    $query = 'DELETE FROM events WHERE text = :event AND date = :date';
    $statement = $db->prepare($query);
    $statement->bindValue(':event', $event);
    $statement->bindValue(':date', $date);
    $success = $statement->execute();
    $statement->closeCursor();
}

//code to add to db, function in Calendar.php
$calendar->add_event($username1, $newEvent, $newDate, $newDays, $newColor);

//js code to return to calendar
echo "<script>
             window.location = 'test.php';
     </script>";
?>