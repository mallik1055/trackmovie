<?php
	header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods:POST"); 
	require_once("db_connect.php");


	class movie{
		function _construct($id){
			$this->movieId = $id;
			$this->rating = 0;
		}
	}


	class recommender{
		function _construct($id){
			$this->userId = $id;
			$this->movieId = '';
			$this->views =0 ;
		}
	}

	class user{
		function __construct($id){
			$this->userId =$id;
			$this->username = "";
			$this->firstName = '';
			$this->lastName = '';
			$this->seenMovieList = array(); // -> rating , movieId
			$this->recommended = array(); // ->userId,username,movieId
		}
		public function getUserInfo(){ 
				
			$sql = " SELECT * FROM users WHERE userId LIKE '$this->userId'";			
			$con=mysqli_connect(db_host,db_user,db_password,db_name);
			$result=mysqli_query($con,$sql);
			if (mysqli_connect_errno()) {
	  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 		}
	 		$row = mysqli_fetch_assoc($result);
			$this->userId = $row['userId'];
			$this->username = $row['username'];
			$this->firstName = $row['firstName'];
			$this->lastName = $row['lastName'];			
		}

		public function getUserMovieList(){
			$con=mysqli_connect(db_host,db_user,db_password,db_name);
			$sql = "SELECT * FROM user_lines WHERE userId LIKE '$this->userId'";			
			$result=mysqli_query($con,$sql);
			if (mysqli_connect_errno()) {
	  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 		}
	 		while($row = mysqli_fetch_assoc($result)){
	 			$movie = new movie($row['movieId']);
	 			$movie->rating = $row['rating'];
	 			$movie->movieId = $row['movieId'];
	 			array_push($this->seenMovieList,$movie);				
			}

		}

		public function getUserRecommendations(){
			$con=mysqli_connect(db_host,db_user,db_password,db_name);
			$sql = " SELECT * FROM recommendations INNER JOIN  users WHERE recommendeeId = '$this->userId' ";			
			$result=mysqli_query($con,$sql);
			if (mysqli_connect_errno()) {
	  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 		}
	 		while($row = mysqli_fetch_assoc($result)){
	 			$recommender->userId = $row['recommenderId'];
	 			$recommender->username = $row['username'];
	 			$recommender->movieId = $row['movieId'];	
	 			array_push($this->recommended,$recommender);			
			}

		}
	}
?>