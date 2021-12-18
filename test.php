<?php
//index code

include 'Calendar.php';
$calendar = new Calendar('2021-12-01');
//take db values and populate calendar based on user
$calendar->populate_events();
?>
<!DOCTYPE html>
<html>
	<head>
        <!-- input validation code in javascript -->
        <script>
            //take add form data and validate
            function validateAdd(){
                
                //validate event input
                let eventInput = document.forms["inputAdd"]["event"].value;
                
                if (eventInput == "" || eventInput.length > 255) {
                    alert("Please enter an event between 1 and 255 characters.");
                    return false;
                }
                
                //validate days input
                let dayInput = document.forms["inputAdd"]["days"].value;
                
                if (isNaN(dayInput) || dayInput < 1 || dayInput > 30) {
                    alert("Please enter an amount of days between 1 and 30.");
                    return false;
                }
            }
            
            //take delete form data and validate
            function validateDelete(){
                let eventInput = document.forms["inputDelete"]["event"].value;
                
                if (eventInput == "" || eventinput.length > 255) {
                    alert("Please enter an event between 1 and 255 characters.")
                    return false;
                }
            }
            
            //take edit form data and validate
            function validateEdit() {
                
                //validate event input
                let eventInput = document.forms["inputEdit"]["event"].value;
                
                if (eventInput == "" || eventInput.length > 255) {
                    alert("Please enter an event between 1 and 255 characters.");
                    return false;
                }
                
                //validate days input
                let dayInput = document.forms["inputEdit"]["days"].value;
                
                if (isNaN(dayInput) || dayInput < 1 || dayInput > 30) {
                    alert("Please enter an amount of days between 1 and 30.");
                    return false;
                }
                
                //validate newEvent input
                let newEventInput = document.forms["inputEdit"]["newEvent"].value;
                
                if (newEventInput == "" || newEventInput.length > 255) {
                    alert("Please enter a new event between 1 and 255 characters.");
                    return false;
                }
                
                //validate newDays input
                let newDayInput = document.forms["inputedit"]["newDays"].value;
                
                if (isNaN(newDayInput) || newDayInput < 1 || newDayInput > 30) {
                    alert("Please enter a new amount of days between 1 and 30.");
                    return false;
                }
            }
        </script>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="calendarStyle.css" rel="stylesheet" type="text/css">
		<link href="calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <nav class="navtop">
	    	<div>
                <a href="home.html" >Home</a>
                <a href="test.php" >Calendar</a>
                <a href="settings.php" >Settings</a>
                <a href="logout.php" >Log Out</a>
	    	</div>
	    </nav>
		<div class="content home" style = "float: left;">
			
            
            <?=$calendar?>
            
		</div>
        
        <div class="inputs" style="float: right;">
        <!-- code to take user inputs for new events and call addEvent.php file -->
            <h2>Add Event</h2>
            <form name="inputAdd" action="addEvent.php" onsubmit="return validateAdd()" method="post" id="addEvent">
                <label>Event:</label>
                <input type="text" name="event"><br>
                
                <label>Start Date:</label>
                <input type="date" name="date"><br>
                
                <label>How Many Days:</label>
                <input type="text" name="days"><br>
                
                <label>Choose a Color:</label>
                <select id="colors" name="color"> 
                    <option value="green">Green</option>
                    <option value="red">Red</option>
                    <option value="yellow">Yellow</option>
                </select> <br><br>
                
                <label></label>
                <input type="submit" value="Add Event"><br><br>
            
            </form>
            
            <!-- code to take user inputs to delete events and call deleteEvent.php file -->
            <h2>Delete Event</h2>
            <form name = "inputDelete" action="deleteEvent.php" onsubmit="return validateDelete()" method="post" id="deleteEvent">
                <label>Event:</label>
                <input type="text" name="event"><br>
                
                <label>Start Date:</label>
                <input type="date" name="date"><br><br>
                
                <label></label>
                <input type="submit" value="Delete Event"><br><br>
            
            
            </form>
            
            <!-- code to take user inputs for editing events and call editEvent.php file -->
            <h2>Edit Event</h2>
            <form name = "inputEdit" action="editEvent.php" onsubmit="return validateEdit()" method="post" id="editEvent">
                <label>Event to Edit:</label>
                <input type="text" name="event"><br>
                
                <label>Start Date of Event to Edit:</label>
                <input type="date" name="date"><br><br>
                
                <label>New Event Name:</label>
                <input type="text" name="newEvent"><br>
                
                <label>New Start Date:</label>
                <input type="date" name="newDate"><br>
                
                <label>New Number of Days:</label>
                <input type="text" name="newDays"><br>
                
                <label>New Color:</label>
                <select id="colors" name="newColor"> 
                    <option value="green">Green</option>
                    <option value="red">Red</option>
                    <option value="yellow">Yellow</option>
                </select> <br><br>
            
                <label></label>
                <input type="submit" value="Edit Event"><br>
                
            </form>
        </div>
	</body>
</html>