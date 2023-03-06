<?php
error_reporting(E_ALL &~ E_NOTICE);
?>
<?php
$con = mysqli_connect("localhost","root", "", "blood_bank" );
if( mysqli_connect_error() ){
	echo "DB Error: ". mysqli_connect_error();
	exit;
}
	############# donor_details #################

if( $_GET['action'] == "load_donor_details" ){
	$donor_details = [];
	$blood_group = $_GET['blood_group'];
	$res = mysqli_query( $con, "select * from donor_details WHERE blood_group='".$blood_group."' ORDER BY name");
	while( $row = mysqli_fetch_assoc($res) ){
		$donor_details[] = $row;
	}
	echo json_encode($donor_details);
	exit;
}
	

?>
<html>
<head>
	<script src="vue.min.js" ></script>
	<script src="axios.min.js" ></script>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div style="font-family: revert;font-size: 40px;background-color: #33ccff;color: white;
		text-align: center;">Donor Details
	</div>
	<div id="app">
		<table class="table table-bordered table-sm bg-info-subtle">
	   <tr>
	     <td>
			<div>
				<a href="webpage.php" class="btn btn-secondary">Back</a>
			</div>
				<table class="table table-bordered table-danger table-group-divider table-striped-columns table-hover border-danger table-sm w-auto" style="margin-left: 360px;">
				<thead>
				  <tr>
				    <th>ID</th>
				    <th>Name</th>
					<th>Blood Group</th>
					<th>Gender</th>
					<th>Phone No</th>
					<th>Address</th>
				  </tr>
				</thead>
				<tbody>
					<tr v-for="donor in donor_details">
						<td>{{ donor['id'] }}</td>
						<td>{{ donor['name'] }}</td>
						<td>{{ donor['blood_group'] }}</td>
						<td>{{ donor['gender'] }}</td>
						<td>{{ donor['phone_no'] }}</td>
						<td>{{ donor['address'] }}</td>
					</tr>
				</tbody>
			</table>
		 </td>
		</tr>
	</table>
</div>
<script>

/*  variabels or functions becomes reactive */

var app = new Vue({
	el: "#app",
	data: {
		new_donor_details:{
			"id":"", 
			"name":"", 
			"blood_group":"",
			"gender":"",
			"phone_no":"",
			"address":""
		},
		edit: false,
		donor_details: [],
		selected_blood_group: "<?=$_GET['blood_group'] ?>",
	},
	mounted: function(){
		this.load_donor_details();
	},
	methods: {
		show_add_donor_details_form:function(){
			document.getElementById("donor_details_div").style.display = "block";
		},
		hide_add_donor_details_form:function(){
			document.getElementById("donor_details_div").style.display = "none";
		},
		load_donor_details: function(){
		    console.log('Loading donor details...');
		    con = new XMLHttpRequest();
		    con.open("GET", "?action=load_donor_details&blood_group=" + encodeURIComponent( this.selected_blood_group) , true);
		    con.onload = function(){
		        var d = JSON.parse(this.responseText);
		        for( var i=0;i<d.length;i++ ){
		        	d[i]['edit'] = false;
		        }
		        app.donor_details = d;
		    }
		    con.send();
		},
	}
});	
selected_blood_group = 1;
	selected_blood_group_id = 0;
	function select_blood_group(i){
		console.log( i );
		selected_blood_group = i;
		selected_blood_group_id = donor_list[ i ]['id'];
		document.getElementById("donor_details_block").style.display = 'block';
		load_donor_details();
	}

</script>
</body>
</html>


