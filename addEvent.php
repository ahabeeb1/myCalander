<?php

include ('test.php');

//code to take user input as variables
$event = filter_input(INPUT_POST, 'event');
$date = filter_input(INPUT_POST, 'date');
$days = filter_input(INPUT_POST, 'days');
$color = filter_input(INPUT_POST, 'color');
$username1 = $_SESSION["username"];

//make sure connected to db
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

//code to add event, function in Calendar.php
$calendar->add_event($username1, $event, $date, $days, $color);

//js code to return to calendar
echo "<script>
             window.location = 'test.php';
     </script>";
?>