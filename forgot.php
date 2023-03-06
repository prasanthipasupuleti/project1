  <?php
error_reporting(E_ALL &~E_NOTICE);

require('config.php');

//print_r($_SESSION);
//exit;
if($_POST['action'] == "user_data"){
  $email = $_POST['email'];
  $query = "select * from registration where  
      email = '".mysqli_escape_string($con,$email)."' "; 

    $res = mysqli_query($con, $query);
    if( mysqli_error($con) ){
        echo "<div>" . $query . "</div>";
        echo json_encode([
          "status"=>"error",
          "error"=>mysqli_error($con)
      ]); 
      exit;
    }
  if( mysqli_num_rows($res) > 0 ){
    $row = mysqli_fetch_assoc($res);
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    echo json_encode([
      "status"=>"success",
      "q1"=>$row['question1'],
      "q2"=>$row['question2'],
      "id"=>$row['id'],
    ]); 
    exit;
  }else{
    echo json_encode([
      "status"=>"error",
      "error"=>"Email is wrong"
    ]); 
    exit;
  }
  exit;
}

############## questions and answers #################
if( $_POST['action'] == "check_answers" ){
  $answer1 = $_POST['answer1'];
  $answer2 = $_POST['answer2'];
  //$user_id = $_POST['user_id'];
  $query = "select * from registration where 
  email = '" .mysqli_escape_string($con, $_SESSION['email'])."'
  and answer1 = '".mysqli_escape_string($con,$answer1)."'
  and answer2 = '".mysqli_escape_string($con,$answer2)."'";

    $res = mysqli_query($con, $query);
    if( mysqli_error($con) ){
        echo "<div>" . $query . "</div>";
        echo json_encode([
           "status"=>"error",
           "error"=>mysqli_error($con)
      ]); 
      exit;
    }
  if( mysqli_num_rows($res) > 0 ){
    $row = mysqli_fetch_assoc($res);
    $_SESSION['email'] = $email;
    echo json_encode([
      "status"=>"success",
    ]); 
    exit;
  }else{
    echo json_encode([
      "status"=>"error",
      "error"=>"Answers is wrong"
    ]); 
    exit;
  }
  exit;
}

############## update pwd #################
if( $_GET['action'] == "update_pwd" ){
  $q = "update registration set
    password = '".mysqli_escape_string($con,$_GET['password'])."'
    where id = ".$_GET['profile_id'] ;
  $res = mysqli_query( $con, $q);
  
    if(mysqli_error($con)){
      
      echo json_encode([
        "status"=> "error",
        "error"=> "Db error: " . mysqli_error($con)
      ]);
      exit;
  }

  echo json_encode([
    "status"=> "success",
  ]);
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
<div id="app" class="row justify-content-center align-items-center h-100 bg-danger-subtle">
  <div id="show_user_div" style="position: absolute;">
      <div class="modal" tabindex="-1" style="display: block;">
        <div class="modal-dialog" style="width: 350px; background-color: paleturquoise;">
            <div class="modal-content">
                <div class="modal-header h1 text-white bg-primary">
                  <h5 class="modal-title">Forgot Password</h5>
                  <button type="button" style="margin-right: 5px;font-size: 25px;" class="btn-close bg-danger" aria-label="Close" v-on:click="hide_username_form" ></button>
                </div>
                <div class="modal-body bg-info-subtle">
                  <form>  
                    <label for="text">E-mail</label>
                    <input type="text" class="form-control my-3" v-model="email">
                </form>
                <div class="d-flex justify-content-center">
                  <input type="button" value="submit" v-on:click="submit_username" class="btn btn-secondary"></div>
                </div>
                <div class="modal-footer bg-info-subtle">
                  <a href="login_form.php" class="btn btn-success">Login</a>
                </div>
            </div>
          </div>
      </div>
    </div>


      <div id="show_question_div" style="display: none;">
      <div class="modal" tabindex="-1" style="display: block;">
        <div class="modal-dialog" style="width: 350px; background-color: paleturquoise;">
            <div class="modal-content">
                <div class="modal-header h1 text-white bg-primary">
                  <h5 class="modal-title">Reset Password</h5>
                   <button type="button" style="margin-right: 5px;font-size: 25px;" class="btn-close bg-danger" aria-label="Close" v-on:click="hide_question_form" ></button>
                </div>
                <div class="modal-body bg-info-subtle">
                  <form>  
                    <label for="mb-3">Security Question 1 :</label>
                    <input type="text" class="form-control my-3" v-model="questions['question1']">
                    <input type="text" class="form-control my-3" v-model="answers['answer1']">

                    <label for="mb-3">Security Question 2 :</label>
                    <input type="text" class="form-control my-3" v-model="questions['question2']">
                    <input type="text" class="form-control my-3" v-model="answers['answer2']">
                </form>
                <div class="modal-footer bg-info-subtle">
                  <button type="button" v-on:click="show_reset_password" class="btn btn-success">Reset Password</button>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
        <!-- Reset Password -->

    <div id="reset_password_div" style="display: none; position: absolute;">
      <div class="modal" tabindex="-1" style="display: block;">
          <div class="modal-dialog"  style= "width: 20rem; box-shadow: 0px 5px 15px rgba(0,0,0,0.25);">
            <div class="modal-content">
                <div class="modal-header h1 text-white bg-primary">
                  <h5 class="modal-title">Confirm Password : </h5>
                  <button type="button" style="margin-right: 5px;font-size: 25px;" class="btn-close bg-danger" aria-label="Close" v-on:click="close_reset_password" ></button>
                </div>
                <div class="modal-body bg-info-subtle">
                  <form>
                    <label for="password">New Password : </label>
                    <input type="password" class="form-control my-3" v-model="password">
                </form>
                <div><input type="button" value="Update" class="btn btn-secondary" v-on:click="update_password"></div>
              </div>
                <div class="modal-footer bg-info-subtle">
                  <a href="login_form.php" class="btn btn-success">Login</a>
                </div>
            </div>
          </div>
      </div>
    </div>    
  </div>

  <script>
    var app = new Vue({
      el:"#app",
      data:{
        "email":"",
        "err": "",
        "msg": "",
        questions : {
          "question1":"",
          "question2":"",
        },
        edit : false,
        answers:{
          "answer1":"",
          "answer2":"",
        },
        'user_id': "",
        "password":"",
      },
      mounted:function(){
        //this.load_question();
      },
     methods:{
        hide_username_form:function(){
          document.getElementById("show_user_div").style.display = 'block';
          window.location.href = "login_form.php?";
          document.getElementById("show_question_div").style.display = 'none';
        },
        hide_question_form : function(){  
          document.getElementById("show_question_div").style.display = 'none';
        },
        close_reset_password : function(){
          document.getElementById("reset_password_div").style.display = 'none';
        },
        
        submit_username:function(){
          this.err = "";
          this.msg = "";
          if(this.email == ''){
            alert("Email required!");
          }else{
            this.msg = "Connecting....";
            con = new XMLHttpRequest();
            vpostdata = "action=user_data&email="+encodeURIComponent(this.email);
            con.open("POST","?",true);
            con.onload = function(){
              app.msg = "";
              try{
                if( this.status == 200 ){
                  var response = JSON.parse(this.responseText);
                  if( "status" in response ){
                    if( response['status'] == "success" ){
                      document.getElementById("show_question_div").style.display = 'block';
                      app.$set( app.questions, 'question1', response['q1']);
                      app.$set( app.questions, 'question2', response['q2']);
                      app.user_id = response['id'];
                    }else{
                      app.err = "There was an error at server: " + response['error'];
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
        show_reset_password:function(){
          this.err = "";
          this.msg = "";
          if(this.answers['answer1'] == ''){
            alert("Answer1 required!");
          }else if(this.answers['answer2'] == ''){
            alert("Answer2 required!");
          }else{
            this.msg = "Connecting....";
           con = new XMLHttpRequest();
            vpostdata = "action=check_answers&answer1="+encodeURIComponent(this.answers['answer1'])+"&answer2="+encodeURIComponent(this.answers['answer2']);
            con.open("POST","?",true);
            con.onload = function(){
              app.msg = "";
              try{
                if( this.status == 200 ){
                  var response = JSON.parse(this.responseText);
                  if( "status" in response ){
                    if( response['status'] == "success" ){
                      document.getElementById("show_user_div").style.display = 'none';
                      document.getElementById("show_question_div").style.display = 'none';
                      document.getElementById("reset_password_div").style.display = 'block';
                    }else{
                      app.err = "There was an error at server: " + response['error'];
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
        update_password:function(){
          if(this.password == ''){
            alert("Please Enter the name!");
          }else{
            con = new XMLHttpRequest();
            url = "?action=update_pwd&profile_id="+this.user_id+"&password=" + encodeURIComponent(this.password);
            con.open("GET", url,true );
            con.onload = function(){
              try{
                var response = JSON.parse(this.responseText);
                if( typeof(response) == "object" ){
                  if( "status" in response ){
                    if( response['status'] == "success" ){
                      app.password;
                      alert("update successfully!");
                      window.location.href = "login_form.php?";
                    }else{
                      alert("There was at server: " + response['error']);
                    }
                  }else{
                    alert("Incorrect response ");
                  }
                }else{
                  alert("Incorrect response");
                }
              }catch(e){
                alert("Error in pwd: "+ e);
              }
            }
            con.send();
          }
        },

      }
    });
  </script>
</body>
</html>