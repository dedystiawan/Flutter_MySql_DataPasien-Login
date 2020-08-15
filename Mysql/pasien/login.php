<?php

 $HostName = "localhost";
 
 
 $DatabaseName = "uas";
 
 $HostUser = "root";
 
 $HostPass = ""; 
 
 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 	
 $json = file_get_contents('php://input');
 
 $obj = json_decode($json,true);
 
 $email = $obj['email'];
 
 $password = $obj['password'];
 
 $loginQuery = "select * from login where email = '$email' and password = '$password' ";
 
 
 $check = mysqli_fetch_array(mysqli_query($con,$loginQuery));
 
	if(isset($check)){

		
		 $onLoginSuccess = 'Masukkan Email dan Password';
		 
		 $SuccessMSG = json_encode($onLoginSuccess);
		 
		 echo $SuccessMSG ; 
	 
	 }
	 
	 else{
	 
		$InvalidMSG = 'Login Gagal ! ' ;
		 
		$InvalidMSGJSon = json_encode($InvalidMSG);
		 
		 echo $InvalidMSGJSon ;
	 
	 }
 
 mysqli_close($con);
?>