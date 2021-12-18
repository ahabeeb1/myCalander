<?php

//starter code for this file taken from https://codeshack.io/event-calendar-php/
session_start();


//check if logged in, if not, take user to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    //function taking variables around an event and adding it to the database
    public function add_event($username1, $txt, $date, $days = 1, $color = '') {
        
        //connect to db
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
        
        //add event data into db
        $query = 'INSERT INTO events (username, text, date, days, color)
        VALUES (:username1, :txt, :date, :days, :color)';
        $statement = $db->prepare($query);
        $statement->bindValue(':username1', $username1);
        $statement->bindValue(':txt', $txt);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':days', $days);
        $statement->bindValue(':color', $color);
        $statement->execute();
        $statement->closeCursor();
    }
    
    //function responsible for taking event data from the database and adding using it to populate an events array
    public function populate_events() {
        //connect to db
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
        
        //fill events array using db data
        //for each row in events table, populate the array row by row
        //array then used to fill calendar
        $username1 = $_SESSION["username"];
        $result = $db->query("Select * FROM  events WHERE username = '{$username1}'");
        while ($rows = $result->fetch()) {
            $txt = $rows['text'];
            $date = $rows['date'];
            $days = $rows['days'];
            $color = $rows['color'];
            $color = $color ? ' ' . $color : $color;
            $this->events[] = [$txt, $date, $days, $color];
        }
        
    }

    //function responsible for taking data from events array, using it to populate the calendar, and then formating of calendar data
    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
?>