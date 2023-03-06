<?php

require('config.php');

if( $_SESSION['login'] != "yes" ){
	header("Location: login_form.php?SessionExpired");
	exit;
}

?>
<html>
<head>
 	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/f1f497abb8.js" crossorigin="anonymous"></script>
  <style>
    img {
      border: 15px solid #555;
    }
    .container {
  position: absolute;
  margin: 20px;
  width: auto;
}

/* The navbar */
.topnav {
  overflow: hidden;
  background-color: lightseagreen;
}

/* Navbar links */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: skyblue;
  color: black;
}
  </style>
</head>
  <body>

  <div class="bg-img">
    <div class="container">
      <div class="topnav">
      <a href="homepage.php"><i class="fa fa-fw fa-home"></i> Home</a> 
      <a href="search_donor.php"><i class="fa fa-fw fa-search"></i> Search</a> 
      <a href="contact.php"><i class="fa fa-fw fa-phone"></i> Contact</a> 
      <a href="login_form.php?action=logout"><i class="fa fa-fw fa-user"></i> Logout</a> <a href="#"><i class="fa fa-fw fa-bars"></i> Menu</a>
       
      
    </div>
  </div>
</div>
        <div class="bg-img">
       <img src="https://media.mehrnews.com/d/2019/06/14/4/3153148.jpg" style="height: 595px; width: 1225px;">
     </div>

</body>
</html>