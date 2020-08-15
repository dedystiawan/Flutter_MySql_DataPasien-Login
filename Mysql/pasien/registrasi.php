<?php

$HostName = "localhost";
 
$DatabaseName = "uas";
 
$HostUser = "root";

$HostPass = ""; 
 
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$json = file_get_contents('php://input');
 
$obj = json_decode($json,true);
 
$name = $obj['name'];
 
$email = $obj['email'];

$password = $obj['password'];
 
$CheckSQL = "SELECT * FROM login WHERE email='$email'";
 
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
 
 
if(isset($check)){
 
	 $emailExist = 'Email Telah Terdaftar, Masukkan Email Lain...';
	 
	$existEmailJSON = json_encode($emailExist);
	 
	 echo $existEmailJSON ; 
 
  }
 else{

	 $Sql_Query = "insert into login (name,email,password) values ('$name','$email','$password')";
	 
	 
	 if(mysqli_query($con,$Sql_Query)){
	 
		$MSG = 'User Registered Successfully' ;
		 
		$json = json_encode($MSG);
		 
		 echo $json ; 
	 
	 }
	 else{
	 
		echo 'Try Again';
	 
	 }
 }
 mysqli_close($con);
?>