<?php

include ('test.php');

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


//code to take user input as variables
$event = filter_input(INPUT_POST, 'event');
$date = filter_input(INPUT_POST, 'date');

//deletion code
if($event != false && $date != false) {
    $query = 'DELETE FROM events WHERE text = :event AND date = :date';
    $statement = $db->prepare($query);
    $statement->bindValue(':event', $event);
    $statement->bindValue(':date', $date);
    $success = $statement->execute();
    $statement->closeCursor();
}

//js code to return to home page
echo "<script>
             window.location = 'test.php';
     </script>";
?>