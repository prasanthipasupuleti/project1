<?php

require("config.php");

if( $_GET['action'] == "logout" ){
  unset( $_SESSION['login'] );
  exit;
}

if( $_GET['action'] == "search"){
  $blood_group = $_GET['blood_group'];
     $query = "select * from registration where 
      blood_group = '".mysqli_escape_string($con,$blood_group)."' "; 
    //echo "<div>".$query."</div>";
  $res = mysqli_query($con, $query);
    if( mysqli_error($con) ){
      echo json_encode([
        "status"=>"error",
        "error"=>mysqli_error($con)
      ]); 
      exit;
    }
  if( mysqli_num_rows($res) > 0 ){
    $_SESSION['login'] = "yes";
    $_SESSION['blood_group'] = $blood_group;
    echo json_encode([
      "status"=>"success",
    ]); 
    exit;
  }else{
    echo json_encode([
      "status"=>"error",
      "error"=>"blood_group wrong"
    ]); 
    exit;
  }
  exit;
}


?>

<html>
<head>
  <div ></div>
  <title>Search Donor</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="jquery/jquery-3.6.3.min.js"></script>
  <script src="jquery/jquery-ui-1.13.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="jquery/jquery-ui-1.13.2/jquery-ui.min.css"/>
  <link rel="stylesheet" href="jquery/jquery-ui-1.13.2/jquery-ui.theme.min.css"/>

  <script src="vue.min.js" ></script>
  <script src="axios.min.js" ></script>
</head>
<body>
<div id="app">
    <div id="add_search_div" class="h-100 bg-danger bg-gradient bg-opacity-50" >
      <div class="modal" tabindex="-1" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content bg-gradient">
              <div class="modal-header bg-info">
                <h5 class="modal-title">Search Donor</h5>
                   <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close" v-on:click="hide_search_form"></button> 
                   </div>  
          <form method="GET" action="donor.php">
           <div class="d-flex flex-column justify-content-center bg-info-subtle">
             <div class="col-md-6 mb-4">
                <div class="col-12">
                  <label class="form-label select-label"> Blood Group</label>
                  <select class="select form-control-lg" name="blood_group">
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                  </select>
                </div>
                </div>
              </div>
              <div class="text-center bg-info-subtle">
            <input type="hidden" id="action" name="action" value="Search_Donor" >
            <input name="btn" type="submit" value="SEARCH" class="btn btn-success">
          </div>
          <div class="bg-info-subtle">
        <a href="webpage.php" class="btn btn-secondary">Back</a>
      </div>
          </form>
      </div>
    </div>
   </div>
  </div>
</div>

</body>
</html>