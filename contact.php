<!DOCTYPE html>
<html>
<head>
  <style>
* {
  box-sizing: border-box;
}

.column {
  float: left;
  padding: 2px;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}
.button {
  background-color: #AF7AC5;
  border: none;
  color: white;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 2px;
  cursor: pointer;
}
In 
</style>
</head>
  <style>
    img {
      border: 2px solid #555;
    }
  </style>
<body>
  <div style="background-color: seagreen;">
    <a href="webpage.php" class="button">Back</a>
   <div style="background-color: seagreen; text-align: center;height: 55px;font-size: 40px;padding-top: 1px;color: whitesmoke;">Contact Us
    </div> 
    <div style="background-color: skyblue;">
       <img src="https://img.freepik.com/free-vector/blood-donation-concept-illustration_114360-5708.jpg?size=626&ext=jpg&ga=GA1.2.1918955254.1677581365&semt=ais" style="margin-left: 360px;margin-top: 3px; width:500px; height: 260px;">
     </div>
  <div class="row" style="background-color: lightpink;">
    <div class="column" style="padding-left: 50px">
    <img src="bb_images/b2.png" style="height: 110px; width: 100px;margin-top: 12px;padding-top: 1px">
       <h2>Address:<h3>San Francisco, CA 94126, USA</h3></h2>
  </div>
  <div class="column" style="padding-left: 270px">
    <img src="bb_images/b1.jpg" style="height: 110px; width: 100px;margin-top: 12px;padding-top: 1px">
       <h2>Phone:<h3>(00) 88 222 444</h3></h2>
  </div>
  <div class="column" style="padding-left: 280px">
    <img src="bb_images/b3.png" style="height: 110px; width: 100px;margin-top: 12px;padding-top: 1px">
       <h2>Email:<h3>bloodbank@gmail.com</h3></h2> 
  </div>
</div>


</body>
</html>