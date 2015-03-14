<?php
	session_start();
	if(!isset($_SESSION['userId'])){ // The user is not logged in 
		include 'login.php';
	}
	else{	

		// User is logged in
		// Write code for what is to be done after user logs in
		//echo 'You are logged in!';

		$userId = $_SESSION['userId'];
		include 'model.php';
		include 'getMovieList.php';
		include 'updateUserInfo.php';
		$movieList = getMovieList();
		$user = new user($userId);
		$user->getUserInfo();
		$user->getUserMovieList();
		$user->getUserRecommendations();
		include 'dash.php';
		
		

		//echo json_encode($user);





	}
?>
