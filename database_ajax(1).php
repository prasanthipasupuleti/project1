	<?php

error_reporting( E_ALL & ~E_NOTICE );

$data_con = mysqli_connect("localhost", "sample", "sample", "areas");
if( mysqli_connect_error( ) ){
	echo mysqli_connect_error( );exit;
}

          ####State####

if($_POST['action'] == "load_State"){

	$State = [];
	$query = "select * from State order by State";
	$res = mysqli_query($data_con, $query);
	while( $row = mysqli_fetch_assoc( $res) ){
		$State[] = $row;
	}
	echo json_encode($State);
	exit;
}
if($_POST['action'] == "add_State"){
	$query = "insert into State set
	State = '" .mysqli_escape_string($data_con,$_POST['State'] ) . "' ";
	mysqli_query($data_con,$query);
	if(mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}

if( $_POST['action'] == "delete_State"){
	$query = "delete from State where id =" . $_POST['State_id'];
	$res = mysqli_query($data_con, $query);
	if( mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}
if( $_POST['action'] == "edit_State" ){
	$query = "update State set 
	State = '" . mysqli_escape_string($data_con, $_POST['State'] ) . "'
	where id = " . $_POST['State_id'];
	mysqli_query($data_con, $query);
	if( mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}

        #####City#####

if($_POST['action'] == "load_City"){

	$City = [];
	$query = "select * from City where state_id = " . $_POST['state_id'] . " order by city";
	$res = mysqli_query($data_con, $query);
	while( $row = mysqli_fetch_assoc( $res) ){
		$City[] = $row;
	}
	echo json_encode($City);
	exit;
}
if($_POST['action'] == "add_City"){
	$query = "insert into City set
    State_id = '" .mysqli_escape_string($data_con,$_POST['State_id']) . "',
 	City = '" .mysqli_escape_string($data_con,$_POST['City'] ) . "' ";
	mysqli_query($data_con,$query);
	if(mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}

if( $_POST['action'] == "delete_City"){
	$query = "delete from City where id =" . $_POST['City_id'];
	$res = mysqli_query($data_con, $query);
	if( mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}
if( $_POST['action'] == "edit_City" ){
	$query = "update City set 
	City = '" . mysqli_escape_string($data_con, $_POST['City'] ) . "'
	where id = " . $_POST['City_id'];
	mysqli_query($data_con, $query);
	if( mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}

    #####Area####

if($_POST['action'] == "load_Area"){

	$Area = [];
	$query = "select * from Area order by State,City,Area ";
	$res = mysqli_query($data_con, $query);
	while( $row = mysqli_fetch_assoc( $res) ){
		$Area[] = $row;
	}
	echo json_encode($Area);
	exit;
}
if($_POST['action'] == "add_Area"){
	$query = "insert into Area set
    State = '" .mysqli_escape_string($data_con,$_POST['State']) . "',
 	City = '" .mysqli_escape_string($data_con,$_POST['City'] ) . "',
 	Area = '" .mysqli_escape_string($data_con,$_POST['Area'] )."' ";
	mysqli_query($data_con,$query);
	if(mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}

if( $_POST['action'] == "delete_Area"){
	$query = "delete from Area where id =" . $_POST['Area_id'];
	$res = mysqli_query($data_con, $query);
	if( mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}
if( $_POST['action'] == "edit_Area" ){
	$query = "update Area set 
	State = '" . mysqli_escape_string($data_con, $_POST['State']). "',
	City = '" . mysqli_escape_string($data_con, $_POST['City'] ) . "',
	Area = '" . mysqli_escape_string($data_con,$_POST['Area']). "'
	where id = " . $_POST['Area_id'];
	mysqli_query($data_con, $query);
	if( mysqli_error($data_con) ){
		echo "fail";
		exit;
	}
	echo "success";
	exit;
}

?>
<html>
<head>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<div id="add_State_div" style="position: absolute;display: none;">
	<div class="modal" tabindex="-1" style="display: block;">
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Add State</h5>
	        <button type="button" class="btn-close" data_con-bs-dismiss="modal" aria-label="Close" onclick="hide_add_State_form()"></button>
	      </div>
	      <div class="modal-body">

	       	<table width="100%">
			<tbody>
			<tr>
				<td>State</td>
				<td><input  class="form-control" type="text" id="State"></td>
			</tr>
		</tbody></table>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data_con-bs-dismiss="modal" onclick="hide_add_State_form()">Close</button>
	        <input type="button" class="btn btn-primary btn-sm" value="ADD" onclick="add_State()">
	      </div>
	    </div>
	  </div>
	</div>
</div>


<div id="edit_State_div" style="position: absolute;display: none;">
	<div class="modal" tabindex="-1" style="display: block;">
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit State</h5>
	        <button type="button" class="btn-close" data_con-bs-dismiss="modal" aria-label="Close" onclick="hide_edit_State_form()"></button>
	      </div>
	      <div class="modal-body">

	       	<table width="100%">
			<tbody>
			<tr>
				<td>State</td>
				<td><input  class="form-control" type="text" id="edit_State"></td>
			</tr>
		</tbody></table>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data_con-bs-dismiss="modal" onclick="hide_edit_State_form()">Close</button>
	        <input type="button" class="btn btn-primary btn-sm" value="EDIT" onclick="edit_State()">
	      </div>
	    </div>
	  </div>
	</div>
</div>


<div id="add_City_div" style="position: absolute;display: none;">
	<div class="modal" tabindex="-1" style="display: block;">
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Add City</h5>
	        <button type="button" class="btn-close" data_con-bs-dismiss="modal" aria-label="Close" onclick="hide_add_City_form()"></button>
	      </div>
	      <div class="modal-body">

	       	<table width="100%">
			<tbody>
			<tr>
				<td>City</td>
				<td><input  class="form-control" type="text" id="City"></td>
			</tr>
		</tbody></table>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data_con-bs-dismiss="modal" onclick="hide_add_City_form()">Close</button>
	        <input type="button" class="btn btn-primary btn-sm" value="ADD" onclick="add_City()">
	      </div>
	    </div>
	  </div>
	</div>
</div>


<div id="edit_City_div" style="position: absolute;display: none;">
	<div class="modal" tabindex="-1" style="display: block;">
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit City</h5>
	        <button type="button" class="btn-close" data_con-bs-dismiss="modal" aria-label="Close" onclick="hide_edit_City_form()"></button>
	      </div>
	      <div class="modal-body">

	       	<table width="100%">
			<tbody>
			<tr>
				<td>City</td>
				<td><input  class="form-control" type="text" id="edit_City"></td>
			</tr>
		</tbody></table>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data_con-bs-dismiss="modal" onclick="hide_edit_City_form()">Close</button>
	        <input type="button" class="btn btn-primary btn-sm" value="EDIT" onclick="edit_City()">
	      </div>
	    </div>
	  </div>
	</div>
</div>


<div id="add_Area_div" style="position: absolute;display: none;">
	<div class="modal" tabindex="-1" style="display: block;">
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Add Area</h5>
	        <button type="button" class="btn-close" data_con-bs-dismiss="modal" aria-label="Close" onclick="hide_add_Area_form()"></button>
	      </div>
	      <div class="modal-body">

	       	<table width="100%">
			<tbody>
		
			<tr>
				<td>Area</td>
				<td><input  class="form-control" type="text" id="Area"></td>
			</tr>
		</tbody></table>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data_con-bs-dismiss="modal" onclick="hide_add_Area_form()">Close</button>
	        <input type="button" class="btn btn-primary btn-sm" value="ADD" onclick="add_Area()">
	      </div>
	    </div>
	  </div>
	</div>
</div>


<div id="edit_Area_div" style="position: absolute;display: none;">
	<div class="modal" tabindex="-1" style="display: block;">
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit Area</h5>
	        <button type="button" class="btn-close" data_con-bs-dismiss="modal" aria-label="Close" onclick="hide_edit_Area_form()"></button>
	      </div>
	      <div class="modal-body">

	       	<table width="100%">
			<tbody>
			<tr>
				<td>Area</td>
				<td><input  class="form-control" type="text" id="edit_Area"></td>
			</tr>
		</tbody></table>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data_con-bs-dismiss="modal" onclick="hide_edit_Area_form()">Close</button>
	        <input type="button" class="btn btn-primary btn-sm" value="EDIT" onclick="edit_Area()">
	      </div>
	    </div>
	  </div>
	</div>
</div>


<div class="d-flex">
	<table class="table table-bordered table-sm w-auto">
		<tr>
			<td>State</td>
		</tr>
		<tr>
			<td>
				<div><input type="button" class="btn btn-info btn-sm" value="+" onclick="show_add_State_form()" ></div>
				<table class="table table-bordered table-striped table-sm" >
					<tr>
						<td>State</td>
						<td>Edit/Delete</td>
					</tr>
					<tbody id="State_list_div" >
					</tbody>
				</table>
			</td>
		</tr>	
	</table>
	<table style="display: none;" id="City_block" class="table table-bordered table-sm w-auto">
		<tr>
			<td>City</td>
		</tr>
		<tr>		
			<td>
				<div><input type="button" class="btn btn-info btn-sm" value="+" onclick="show_add_City_form()" ></div>
				<table class="table table-bordered table-striped table-sm" >
					<tr>
						<td>City</td>
						<td>Edit/Delete</td>
					</tr>
					<tbody id="City_list_div" >
					</tbody>
				</table>
			</td>
		</tr>
	</table>
	<table style="display: none;" id="Area_block" class="table table-bordered table-sm w-auto">
		<tr>
			<td>Area</td>
		</tr>
		<tr>
			<td>
				<div><input type="button" class="btn btn-info btn-sm" value="+" onclick="show_add_Area_form()"></div>
				<table class="table table-bordered table-striped table-sm" >
					<tr>
						<td>Area</td>
						<td>Edit/Delete</td>
					</tr>
					<tbody id="Area_list_div" >
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</div>
<table>
	<tr>
		<td>
			<pre id="State_list_tree"></pre>
		</td>
		<td>
			<pre id="City_list_tree"></pre>
		</td>
		<td>
			<pre id="Area_list_tree"></pre>
		</td>
	</tr>
</table>

<script>
	function show_add_State_form(){
		document.getElementById("add_State_div").style.display = 'block';
	}
	function hide_add_State_form(){
		document.getElementById("add_State_div").style.display = 'none';
	}
	function add_State(){
		 State = document.getElementById("State").value;
	    vpostdata = "action=add_State&State="+encodeURIComponent(State);

		data_con = new XMLHttpRequest();
		data_con.open("POST","database_ajax(1).php",true);
		data_con.onload = function(){
			if(this.responseText = "success"){
				load_State();
				hide_add_State_form();
			}else{
				alert("There was an error at server");
			}
		}
		data_con.setRequestHeader("content-type","application/x-www-form-urlencoded");
		data_con.send(vpostdata);
	}

	var State_list = [];
	function load_State(){
		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			State_list = JSON.parse( this.responseText );
			console.log( State_list );
			generate_State_list();
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( "action=load_State" );
	}
	selected_State = 1;
	selected_State_id = 0;
	function select_State(vi){
		console.log( vi );
		selected_State = vi;
		selected_State_id = State_list[ vi ]['id'];
		document.getElementById("City_block").style.display = 'block';
		load_City();
	}
	function generate_State_list(){
		var str = "";
		for(var i=0;i<State_list.length;i++){
			str = str + `<tr>
				<td><a href='#' onclick="select_State(`+i+`);return false" >` + State_list[i]['State'] + `</td>
				<td>
				<input type="button" value="E" onclick="show_edit_State_form(`+i+`)" >
				<input type="button" value="X" onclick="delete_State(`+i+`)" >
				</td>
			</tr>`;
		}
		document.getElementById("State_list_div").innerHTML = str;
		document.getElementById("State_list_tree").innerHTML = JSON.stringify(State_list,null,4);
      }

	var editing_State_id = 0;
	function show_edit_State_form(sid){
		editing_state_id = sid;
		document.getElementById("edit_State_div").style.display = 'block';
	}
	function hide_edit_State_form(){
		document.getElementById("edit_State_div").style.display = 'none';
		document.getElementById("edit_State").value = State_list[ editing_State_id ]['State'];
	}
	function edit_State(){
		State_list[editing_State_id]['State'] = document.getElementById("edit_State").value;
		vpostdata = "action=edit_State";
		vpostdata += "&State_id=" +State_list[editing_State_id]['id'];
		vpostdata += "&State=" +State_list[editing_State_id]['State'];

		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			if( this.responseText == "success" ){
				hide_edit_State_form();
				generate_State_list();
			}else{
				alert("There was an error");		
			}
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( vpostdata );
	}
	deleting_State_id = 0;
	function delete_State(vi){
		deleting_State_id = vi;
		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			if( this.responseText == "success" ){
				State_list.splice( deleting_State_id,1 );
				generate_State_list();
			}else{
				alert("There was an error");		
			}
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( "action=delete_State&State_id=" + State_list[vi]['id'] );	
	}

	/* #####  City ##### */

	function show_add_City_form(){
		document.getElementById("add_City_div").style.display = 'block';
	}
	function hide_add_City_form(){
		document.getElementById("add_City_div").style.display = 'none';
	}
	function add_City(){
		City = document.getElementById("City").value;
		vpostdata = "action=add_City&State_id="+selected_State_id+ "&City="+ encodeURIComponent(City);

		data_con = new XMLHttpRequest();
		data_con.open("POST","database_ajax(1).php",true);
		data_con.onload = function(){
			if(this.responseText = "success"){
				load_City();
				hide_add_City_form();
			}else{
				alert("There was an error at server");
			}
		}
		data_con.setRequestHeader("content-type","application/x-www-form-urlencoded");
		data_con.send(vpostdata);
	}

	var City_list = [];
	function load_City(){
		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			City_list = JSON.parse( this.responseText );
			console.log( City_list );
			document.getElementById("City_list_tree").innerHTML = JSON.stringify(City_list,null,4);
			generate_City_list();
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( "action=load_City&State_id=" + selected_State_id );
	}
	selected_City = 1;
	function select_City(ci){
		selected_City = ci;
		document.getElementById("Area_block").style.display = 'block';
		document.getElementById("Area_list_tree").innerHTML = JSON.stringify(Area_list,null,4);
		generate_Area_list();
	}
	function generate_City_list(){
		var str = "";
		for(var i=0;i<City_list.length;i++){
			str = str + `<tr>
				<td><a href='#' onclick="select_City(`+i+`)">` + 	City_list[i]['City'] + `</td>
					<td>
				<input type="button" value="E" onclick="show_edit_City_form(`+i+`)" >
				<input type="button" value="X" onclick="delete_City(`+i+`)" >
				</td>
			</tr>`;
		}
		document.getElementById("City_list_div").innerHTML = str;
	
	    var str = "";
		for(var i=0;i<City_list.length;i++){
			str = str + `<option value="` + City_list[i]['City'] + `" >` + City_list[i]['City'] + `</option>`;	
		}
		
		document.getElementById("Area_City").innerHTML = str;
		document.getElementById("edit_Area_City").innerHTML = str;
     }
	var editing_City_id = 0;
	function show_edit_City_form(cid){
		editing_City_id = cid;
		document.getElementById("edit_City_div").style.display = 'block';
		document.getElementById("edit_City").value = City_list['City'][ editing_City_id ]['City'];
	}
	function hide_edit_City_form(){
		document.getElementById("edit_City_div").style.display = 'none';
	}
	function edit_City(){
		City_list[editing_City_id]['City'] = document.getElementById("edit_City").value;
		vpostdata = "action=edit_City";
		vpostdata += "&City_id=" +City_list[editing_City_id]['id'];
		vpostdata += "&City=" +City_list[editing_City_id]['City'];

		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			if( this.responseText == "success" ){
				hide_edit_City_form();
				generate_City_list();
			}else{
				alert("There was an error");		
			}
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( vpostdata );
	}
	deleting_City_id = 0;
	function delete_City(ci){
		deleting_City_id = ci;
		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			if( this.responseText == "success" ){
				City_list.splice( deleting_City_id,1 );
				generate_City_list();
			}else{
				alert("There was an error");		
			}
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( "action=delete_City&City_id=" + City_list[ci]['id'] );	
	}

/* ##### Area #####*/
	function show_add_Area_form(){
		document.getElementById("add_Area_div").style.display = 'block';
	}
	function hide_add_Area_form(){
		document.getElementById("add_Area_div").style.display = 'none';
	}
	function add_Area(){
		State = document.getElementById("Area_State").value;
		City = document.getElementById("Area_City").value;
		Area = document.getElementById("Area").value;
		vpostdata = "action=add_Area&State="+encodeURIComponent(State)+ "&City="+ encodeURIComponent(City)+ "&Area="+ encodeURIComponent(Area);

		data_con = new XMLHttpRequest();
		data_con.open("POST","database_ajax(1).php",true);
		data_con.onload = function(){
			if(this.responseText = "success"){
				load_State();
				load_City();
				load_Area();
				hide_add_Area_form();
			}else{
				alert("There was an error at server");
			}
		}
		data_con.setRequestHeader("content-type","application/x-www-form-urlencoded");
		data_con.send(vpostdata);
	}

	var Area_list = [];
	function load_Area(){
		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			Area_list = JSON.parse( this.responseText );
			console.log( Area_list );
			generate_Area_list();
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( "action=load_Area" );
	}
	function generate_Area_list(){
		var str = "";
		for(var i=0;i<Area_list.length;i++){
			str = str + `<tr>
				<td>` + Area_list[i]['State'] + `</td>
				<td>` + Area_list[i]['City'] + `</td>
				<td>` + Area_list[i]['Area'] + `</td>
				<td>
				<input type="button" value="E" onclick="show_edit_Area_form(`+i+`)" >
				<input type="button" value="X" onclick="delete_Area(`+i+`)" >
				</td>
			</tr>`;
		}
		document.getElementById("Area_list_div").innerHTML = str;
	}
	var editing_Area_id = 0;
	function show_edit_Area_form(aid){
		editing_Area_id = aid;
		document.getElementById("edit_Area_div").style.display = 'block';
		document.getElementById("edit_Area_State").value = Area_list[ editing_Area_id ]['State'];
		document.getElementById("edit_Area_City").value = Area_list[ editing_Area_id ]['City'];
		document.getElementById("edit_Area").value = Area_list[ editing_Area_id ]['Area'];			
			}
	function hide_edit_Area_form(){
		document.getElementById("edit_Area_div").style.display = 'none';
	}
	function edit_Area(){
		Area_list[editing_Area_id]['State'] = document.getElementById("edit_Area_State").value;
		Area_list[editing_Area_id]['City'] = document.getElementById("edit_Area_City").value;
		Area_list[editing_Area_id]['Area'] = document.getElementById("edit_Area").value;
		vpostdata = "action=edit_Area";
		vpostdata += "&Area_id=" +Area_list[editing_Area_id]['id'];
		vpostdata += "&State=" +Area_list[editing_Area_id]['State'];
		vpostdata += "&City=" +Area_list[editing_Area_id]['City'];
		vpostdata += "&Area=" +Area_list[editing_Area_id]['Area'];

		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			if( this.responseText == "success" ){
				hide_edit_Area_form();
				generate_Area_list();
			}else{
				alert("There was an error");		
			}
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( vpostdata );
	}
	deleting_Area_id = 0;
	function delete_Area(ai){
		deleting_Area_id = ai;
		data_con = new XMLHttpRequest();
		data_con.open( "POST", "database_ajax(1).php", true );
		data_con.onload = function(){
			if( this.responseText == "success" ){
				Area_list.splice( deleting_Area_id,1 );
				generate_Area_list();
			}else{
				alert("There was an error");		
			}
		}
		data_con.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		data_con.send( "action=delete_Area&Area_id=" + Area_list[ai]['id'] );	
	}
load_State();
load_City();
load_Area();
</script>
</body>
</html>