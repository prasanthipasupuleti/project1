<?php

require("config.php");

if( $_GET['action'] == "logout" ){
  unset( $_SESSION['login'] );
  header("Location: login_form.php?event=logout");
  exit;
}

if( $_POST['action'] == "sign_in"){
  $username = $_POST['username'];
  $password = $_POST['password'];
     $query = "select * from registration where 
      email = '".mysqli_escape_string($con,$username)."' 
      and password = '".mysqli_escape_string($con,$password)."' ";
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
    $_SESSION['username'] = $username;
    echo json_encode([
      "status"=>"success",
    ]); 
    exit;
  }else{
    echo json_encode([
      "status"=>"error",
      "error"=>"username or password wrong"
    ]); 
    exit;
  }
  exit;
}


?>
<html>
<head>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="vue.min.js" ></script>
  <script src="axios.min.js" ></script>
</head>
<body>
  <div id="app">
    <div id="add_login_div" class="h-100 bg-danger bg-gradient bg-opacity-50" >
      <div class="modal" tabindex="-1" style="display:block;">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">LOGIN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" v-on:click="hide_login_form"></button>
              </div>
                <div class="modal-body">
                <form>  
                <div class="d-flex flex-column justify-content-center">
                  <p class="p-2">username: </p>
                  <input class="p-2 m-2" type="text" placeholder="e-mail" v-model="username">
                  <p class="p-2">Password: </p>
                  <input class="p-2 m-2" type="password" placeholder="......." v-model="password">
                </div>
                <div class="text-center">
                  <input type="button" class="btn btn-info mt-2" v-on:click="sign_in" value="Login" >
                </div>
                <div v-if="err" class="text-danger" >{{ err }}</div>
                <div v-if="msg" class="text-success" >{{ msg }}</div>
                <div class="text-center">
                  <a href="register_form.php">New User</a>
                  <a href="forgot.php">Forgot password</a>
                </div>
              </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var app = new Vue({
      el: "#app",
      data:{
        "username":"",
        "password":"",
        "err": "",
        "msg": "",
      },
      methods:{
        hide_login_form:function(){
          document.getElementById("add_login_div").style.display = "none";
        },
        sign_in:function(){
          this.err = "";
          this.msg = "";
          if(this.username == ''){
            this.err = "username required";
          }else if(this.password == ''){
            this.err = "Password required";
          }else{
            this.msg = "Connecting...";
            con = new XMLHttpRequest();
            vpostdata = "action=sign_in&username="+encodeURIComponent(this.username)+"&password="+encodeURIComponent(this.password);
            con.open("POST","login_form.php",true);
            con.onload = function(){
              app.msg = "";
              try{
                if( this.status == 200 ){
                  var log = JSON.parse( this.responseText );
                  if( 'status' in log ){
                    if(log['status'] == 'success'){
                      window.location.href = "webpage.php?event=LoginSuccess";
                    }else{
                      app.err = "There was an error at server: " + log['error'];
                    }
                  }else{
                    app.err = "Incorrect response";
                  }
                }else{
                  app.err = "Http Status: " + this.status;
                }
              }catch(e){
                app.err = "Error: " + e;
              }
            }
            con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            con.send(vpostdata);
          }
        },
      }
    });
  </script>
</body>
</html>