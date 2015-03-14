<?php
	//session_start();
	header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods:*"); 
	require_once("db_connect.php");
	$con = mysqli_connect(db_host,db_user,db_password,db_name);	
	
	
	//$userId = $_SESSION['userId'];
	if($_REQUEST){
		$userId = $_REQUEST['userId'];
		$response = new stdclass();
		$method = $_REQUEST['method'];
		$movieId = $_REQUEST['movieId'];

		if($method == 'rate'){
			$rating = $_REQUEST['rating'];
			$sql = "INSERT INTO user_lines (userId,rating,movieId) VALUES ('$userId','$rating','$movieId') ON DUPLICATE KEY UPDATE rating = '$rating' ";
			if (mysqli_query($con, $sql)) {
	  			$response->status = 'pass';
	  			$response->message = 'Your rating has been added';
	  			echo json_encode($response);
	  			return;
			}
			else{
				$response->status = 'fail';
	  			$response->message = 'Your rating could not be updated.Please try later';
	  			echo $response; 
	  			return;

			}

		}

		else if($method == 'seen'){
			$sql = "INSERT INTO user_lines (userId,rating,movieId) VALUES ('$userId',0,'$movieId')";
			if (mysqli_query($con, $sql)) {
	  			$response->status = 'pass';
	  			$response->message = 'Your view has been counted';
	  			echo json_encode($response);
	  			return;
			}
			else{
				$response->status = 'fail';
	  			$response->message = 'Your view could not be updated.Please try later';
	  			echo $response;
	  			return;

			}
		}


		else if($method == 'recommend'){ 
			$recommendeeName = $_POST['recommendeeName'];
			$sql = 'SELECT * FROM users WHERE  username LIKE $recommendeeName';
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) == 0) {
	  			$response->status = 'fail';
	  			$response->message = 'The username does not exist';
	  			echo $response;
	  			return;
			}
			else{
				$row = mysqli_fetch_assoc($result);
				$recommenderId = $userId;
				$recommendeeId  = $row['userId'];
				$movieId = $_REQUEST['movieId'];
				$response->status = 'pass';
	  			$response->message = 'Recommendation has been sent to '+$recommendeeName;
	  			echo $response;
	  			return;

			}			
			$sql = 'INSERT INTO  recommendations (recommenderId,recommendeeId,movieId) VALUES ($recommenderId,$recommendeeId,$movieId)';			
		}
	}
	


?>