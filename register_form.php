<?php

  error_reporting(E_ALL &~E_NOTICE);

$con = mysqli_connect("localhost", "root", "", "blood_bank");
if( mysqli_connect_error() ){
  echo mysqli_connect_error();
  exit;
}

if( $_GET['action'] == "load_register" ){
  $register = [];
  $res = mysqli_query( $con, "select * from registration order by donor_name");
  //echo "<div>".$res."</div>";
    while( $row = mysqli_fetch_assoc($res) ){
      $register[] = $row;
    }
  echo json_encode($register);
  exit;
}

if( $_GET['action'] == "add_register" ){
  $res = mysqli_query($con, "insert into registration set
    email = '".mysqli_escape_string($con,$_GET['email'])."',
    password = '".mysqli_escape_string($con,$_GET['password'])."',
    donor_name = '".mysqli_escape_string($con,$_GET['donor_name'])."',
    gender = '".mysqli_escape_string($con,$_GET['gender'])."',
    address = '".mysqli_escape_string($con,$_GET['address'])."',
    phone_no = '".mysqli_escape_string($con,$_GET['phone_no'])."',
    blood_group = '".mysqli_escape_string($con,$_GET['blood_group'])."',
    question1 = '".mysqli_escape_string($con,$_GET['question1'])."',
    answer1 = '".mysqli_escape_string($con,$_GET['answer1'])."',
    question2 = '".mysqli_escape_string($con,$_GET['question2'])."',
    answer2 = '".mysqli_escape_string($con,$_GET['answer2'])."' ");
  if(mysqli_error($con)){
    echo json_encode([
      "status"=> "error",
      "error"=> "Db error: " . mysqli_error($con)
    ]);
    exit;
  }
    $new_id = mysqli_insert_id($con);
    echo json_encode([
      "status"=>"success",
      "new_register_id"=>$new_id
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
 <div id ="app">
   <section class="vh-100 gradient-custom">
  <div class="modal-content h-200" style="background-color: lightseagreen;">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
          <div class="card-body p-4 p-md-5 bg-info-subtle">
            <div class="modal-footer">
                <a href="homepage.php" class="btn btn-secondary">Back</a>
              </div>
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
            
            <form>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control bg-danger-subtle" type="email" v-model="new_reg['email']" />
                  </div>
               </div>

                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control bg-danger-subtle" type="password" v-model="new_reg['password']" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">
                 <div class="form-outline datepicker w-100">
                    <label for="donor_name" class="form-label">Donor Name</label>
                    <input class="form-control bg-danger-subtle" type="text" v-model="new_reg['donor_name']" />
                  </div>
                </div>

              <div class="col-md-6 mb-4">
                <h6 class="mb-2 pb-1">Gender: </h6>
                <div class="form-check form-check-inline">
                  <label class="pe-3" for="female">Female</label>
                  <input class="form-check-input bg-danger-subtle" type="radio" id="female" name="select" value="Female" v-model="new_reg['gender']">
                  </div>

                  <div class="form-check form-check-inline">
                    <label class="pe-3" for="male">Male</label>
                  <input class="form-check-input bg-danger-subtle" type="radio" id="male" name="select" value="male" v-model="new_reg['gender']">
                  </div>

                  <div class="form-check form-check-inline">
                    <label class="pe-3" for="others">Others</label>
                  <input class="form-check-input bg-danger-subtle" type="radio" id="others" name="select" value="others" v-model="new_reg['gender']">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                  <div class="form-outline">
                    <label class="form-label" for="address">Address</label>
                    <input class="form-control bg-danger-subtle" type="text"  v-model="new_reg['address']">
                  </div>
                </div>

                <div class="col-md-6 mb-4 pb-2">
                  <div class="form-outline">
                    <label class="form-label" for="phone_no">Phone Number</label>
                    <input class="form-control bg-danger-subtle" type="text"  v-model="new_reg['phone_no']">
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="col-12">
                  <label class="form-label select-label">Blood Group</label>
                  <select class="select form-control-lg bg-danger-subtle" v-model="new_reg['blood_group']">
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

              <div class="row">
                <div class="col-12 col-md-6 mb-4 pb-2">
                    <div class="form-label select-label">Security Question 1 :</div>
                    <select class="select form-control-lg bg-danger-subtle" v-model="new_reg['question1']"> 
                      <option hidden>Select Question</option>
                      <option>What is your favourite food ?</option>
                      <option>What is your favourite place ?</option>
                      <option>What is Your nick name ?</option>
                    </select>
                    <div class="form-outline">
                    <label class="form-label"></label>
                    <input type="text" class="form-control form-control-lg bg-danger-subtle" style="width: 19rem;" v-model="new_reg['answer1']">
                    </div>
                    <div class="form-label select-label">Security Question 2 :</div>
                    <select class="select form-control-lg bg-danger-subtle" v-model="new_reg['question2']"> 
                      <option hidden>Select Question</option>
                      <option>What is your favourite food ?</option>
                      <option>What is your favourite place ?</option>
                      <option>What is Your nick name ?</option>
                    </select>
                    <div class="form-outline">
                    <label class="form-label"></label>
                    <input type="text" class="form-control form-control-lg bg-danger-subtle" style="width: 19rem;" v-model="new_reg['answer2']">
                    </div>
              <div class="mt-4 pt-2">
                <input class="btn btn-success btn-lg" type="submit" value="Submit" v-on:click="add_register">
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <script>
    var app = new Vue({
      el: "#app",
      data:{
        new_reg:{
          "email":"",
          "password":"",
          "donor_name":"",
          "gender":"",
          "address":"",
          "phone_no":"",
          "blood_group":"",
          "question1":"",
          "answer1":"",
          "question2":"",
          "answer2":""
        },
        edit:false,
        register:[],
      },
      mounted:function(){
        this.load_register();
      },
      methods:{
        show_register_form_1:function(){
          document.getElementById("register_form_div_1").style.display = "block";
          document.getElementById("register_form_div_2").style.display = "none";
        },
        show_register_form_2:function(){
          document.getElementById("register_form_div_2").style.display = "block";
          document.getElementById("register_form_div_1").style.display = "none";
        },
        hide_register_form:function(){
          document.getElementById("register_form_div_2").style.display = "none";
          document.getElementById("register_form_div_1").style.display = "none";
        },
        load_register: function(){
        con = new XMLHttpRequest();
        con.open("GET", "?action=load_register",true);
        con.onload = function(){
          var re = JSON.parse(this.responseText);
          for(var i=0;i<re.length;i++){
            re[i]['edit'] = false;
          }
          app.register = re;
        }
          con.send();
        },
        add_register: function(){
          if (this.new_reg['email'] == '') {
            alert("Please Enter the Email !");
          }else if (this.new_reg['password'] == '') {
            alert("Please Enter the Password !");
          }else if(this.new_reg['donor_name'] == '') {
            alert("Please Enter the Donor Name!");
          }else if (this.new_reg['gender'] == '') {
            alert("Please Enter the Gender !");
          }else if (this.new_reg['address'] == '') {
            alert("Please Enter the Address !");
          }else if (this.new_reg['phone_no'] == '') {
            alert("Please Enter the Phone No !");
          }else if (this.new_reg['blood_group'] == '') {
            alert("Please Enter the Blood Group !");
          }else if (this.new_reg['question1'] == '') {
            alert("Please Select the Question1 !");
          }else if (this.new_reg['answer1'] == '') {
            alert("Please Enter the Answer1 !");
          }else if (this.new_reg['question2'] == '') {
            alert("Please Enter the Question2 !");
          }else if (this.new_reg['answer2'] == '') {
            alert("Please Enter the Answer2 !");
          }else{
            con = new XMLHttpRequest();
            url = "?action=add_register&email="+encodeURIComponent(this.new_reg['email'])+"&password="+encodeURIComponent(this.new_reg['password'])+"&donor_name="+encodeURIComponent(this.new_reg['donor_name'])+"&gender="+encodeURIComponent(this.new_reg['gender'])
                +"&address="+encodeURIComponent(this.new_reg['address'])+"&phone_no="+encodeURIComponent(this.new_reg['phone_no'])+"&blood_group="+encodeURIComponent(this.new_reg['blood_group'])+"&question1="+encodeURIComponent(this.new_reg['question1'])
                +"&answer1="+encodeURIComponent(this.new_reg['answer1'])+"&question2="+encodeURIComponent(this.new_reg['question2'])+"&answer2="+encodeURIComponent(this.new_reg['answer2']);
            con.open("GET",url,true);
            con.onload = function(){
              var rg = JSON.parse( this.responseText );
             if(rg['status'] == 'success'){
                
                app.register.push({
                  "id":rg["new_register_id"],
                  "email": app.new_reg['email']+"",
                  "password": app.new_reg['password']+"",
                  "donor_name": app.new_reg['donor_name']+"",
                  "gender": app.new_reg['gender']+"",
                  "address": app.new_reg['address']+"",
                  "phone_no": app.new_reg['phone_no']+"",
                  "blood_group": app.new_reg['blood_group']+"",
                  "question1": app.new_reg['question1']+"",
                  "answer1": app.new_reg['answer1']+"",
                  "question2": app.new_reg['question2']+"",
                  "answer2": app.new_reg['answer2']+"",
                  "edit": false,
                });
                app.new_reg = {
                  "email":"",
                  "password":"",
                  "donor_name":"",
                  "gender":"",
                  "address":"",
                  "phone_no":"",
                  "blood_group":"",
                  "question1":"",
                  "answer1":"",
                  "question2":"",
                  "answer2":""
                };
                alert("Registered Successfully!");
                app.hide_register_form();
                window.location.href = "login_form.php";
            }else{
              alert("There was an error at server: " + rg['error']);
            } 
          }
            con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            con.send();
          }
        },
      }
    });
  </script>
</body>
</html>