<?php
	require_once("db_connect.php");
	
	function getMovieList(){
		$con = mysqli_connect(db_host,db_user,db_password,db_name);	
		$movie_list = array();	
		$sql = 'SELECT * FROM movie_db ORDER BY rank';
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$movie = new stdClass();
			$movie->movieId = $row['movieId'];
			//$movie->imageUrl = $row['imageUrl'];
			$movie->title = $row['title'];
			$movie->rank = $row['rank'];

			$movie->imdbRating = $row['imdbRating'];
			//$movie->plot  = $row['plot'];
			//$movie->cast = $row['cast'];
			//$movie->director = $row['director'];
			$movie->year = $row['year'];
			array_push($movie_list,$movie);
		}
		return $movie_list;
	}
	
?>