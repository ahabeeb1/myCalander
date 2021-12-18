
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<title>settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="calendarStyle.css">

<head>
<style>
body, html {
 height:100%;
}

h2 {
  height: 100%;
  background-image: url('calendar.jpg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  margin:0;
  color: white;
  font-family: Arial, sans-serif;
    font-size: 20px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  
}
p {
  font-size: 30px;
}

</style>
</head>


<body>
  
<div class="newNav navtop">
    <div>
      <!-- Float links to the right. -->
    
      <div class="nav-right" style="float: right;">
        <a href="home.html" >Home</a>
        <a href="test.php" >Calendar</a>
        <a href="settings.html" >Settings</a>
        <a href="logout.php" >Log Out</a>
      
      </div>
    </div>
  </div>

<h2 class="h2"><br><br>&emsp;Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b><br><br>
<p style="color: black;">
   <a href="reset-password.php" class="btn btn-warning" style= "text-decoration:none;"><b>&emsp;Reset Your Password</b></a>
</p>

</h2>

</body>


<!-- Footer -->
<footer class="myCalendarFont" style="background-color: #3b4656;padding: 5px;">
  <p style="text-align:center;color: white;">&copy <b>my</b>Calendar </p>
</footer>


</html>