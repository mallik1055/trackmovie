<?php
	session_start();
	header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods:*"); 
	require_once("db_connect.php");
	$con = mysqli_connect(db_host,db_user,db_password,db_name);	
	$response = new stdClass();

	$username = mysqli_real_escape_string ($con,$_REQUEST['username']);
	$password = mysqli_real_escape_string ($con,$_REQUEST['password']);
	$type     = mysqli_real_escape_string ($con,$_REQUEST['type']);

	if($type == 'login'){
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) == 0) {
  			$response->status = 'fail';
  			$response->message = 'The username does not exist';
		}
		else {
  			$row = mysqli_fetch_assoc($result);
	    	if($password == $row['password']){
	    		$userId = $row['userId'];
	    		$_SESSION['userId'] = $userId; 
	    		$response->status = 'pass';
	    		$response->message = 'Logging you in!';
	    	}
	    	else{
	    		$response->status = 'fail';
	    		$response->message = 'Username and password do not match!';

	    	}
  		}
  	}
	else if($type == 'signup'){

		$firstName = mysqli_real_escape_string ($con,$_REQUEST['firstName']);
		$lastName =  mysqli_real_escape_string ($con,$_REQUEST['lastName']);
		$sql = "SELECT * FROM users WHERE username LIKE '$username'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result) == 0){ // The username DNE

			$sql = "INSERT INTO users (firstName,lastName,username,password) VALUES ('$firstName','$lastName','$username','$password') ";
			$result = mysqli_query($con, $sql);
			if ($result) {
		        $response->status = 'pass';
		    	$response->message = 'Signing you up !';


		    } 
		    $sql = "SELECT * FROM users WHERE username = '$username'";
		    $result = mysqli_query($con, $sql);
		    $row =  mysqli_fetch_assoc($result);
		    $_SESSION['userId'] = $row['userId'];
		    //$response->userId = $userId;
		    

		}
		else { // USerName exists 
			$response->status = 'fail';
			$response->message = 'The username already exists !';
		}
		
	}
	echo json_encode($response);
	mysqli_close($con);
?>