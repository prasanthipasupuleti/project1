<?php

error_reporting(E_ALL & ~E_NOTICE );

session_start();

$con = mysqli_connect("localhost", "root", "", "blood_bank" );
if( mysqli_connect_error() ){
	echo mysqli_connect_error() ;
	exit;
}

?>