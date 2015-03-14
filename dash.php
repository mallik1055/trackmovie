<!DOCTYPE html>
<!--this is the dashboard page-->
<html>
<head>
	<title>(<?php echo count($user->seenMovieList); ?>)TrackMovies - One stop for movie buffs</title>
    <link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css'>
    <link rel='stylesheet' href='./css/dash.css'>
    <link rel='shortcut icon' href='./images/logo.png'>
    <script>
    	function logout(){
    		window.location = 'logout.php';
    	}
    </script>
</head>

<body style="font-family: 'Lato', Calibri, Arial, sans-serif;">
	<div class="wrapper">
		<div class='header'>
			<div class='symbol'>
				<img src='./images/logofull.png' width='338' height='90'></img>
			</div>
			
			<div class='udetails'>
				<button type="submit" onclick="logout()" style="background-image: url(&quot;images/logoutbutton.png&quot;); margin-top:35px; margin-right:10px; height: 29px; width: 80px;border: 2px; border-radius: 5px"></button>
			</div>
			<section class='welc'>
				<p>Welcome <?php echo $user->firstName; ?></p>
			</section>
		</div>
		<div class='cleartop'>

		</div>
		<div class='container'>
			<section class='mlist'>

				
				<table id='myTable' class="flat-table flat-table-2" style="text-align:center">
					<thead>	
						<tr>
							<th>Rank</th>
							<th>Year</th>
							<th>Name</th>
							<th>Your Rating</th>
							<th>User Rating</th>
							<th>IMDB Rating</th>
							<th>Recommend</th>
							<th>Seen</th>
						</tr>
					</thead>
					<tbody style="background: none repeat scroll 0% 0% rgb(255, 188, 99)";>
						<tr>
							<?php
								foreach($movieList as $movieTitle){ ?>
									<tr>
									<td><?php echo $movieTitle->rank; ?></td>
									<td><?php echo $movieTitle->year; ?></td>
									<td><?php echo $movieTitle->title; ?></td>
									<td>--</td>
									<td>--</td>
									<td><?php echo $movieTitle->imdbRating; ?></td>
									<td>--</td>
									<td>--</td>
									</tr>
								<?php
								} 
							?>
							
						
					</tbody>
				</table>
			</section>
			<section class='extra'>
				<h1>Recommendations</h1>
				<hr size='8px' color='#FFBC63'></hr>
				<table class="flat-table flat-table-3" width='100%' id="reco">
					<tbody>
						<?php
							foreach( $user->recommended as $recommender){
								?>
								<tr>
									<td><?php echo $recommender->username; ?></td>
								</tr>						
								
							<?php
							}
						?>
					
					</tbody>
				</table>
				<br>
				<h1>Top Movie Watchers</h1>
				<hr size='8px' color='#FFBC63'></hr>
				<table class="flat-table flat-table-3" width='100%' style="text-align:center">
					<thead>	
						<tr>
							<th>Username</th>
							<th>Movies Watched</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>joifsi</td>
							<td>250</td>
						</tr>
						<tr>
							<td>madman</td>
							<td>250</td>
						</tr>
						<tr>
							<td>kidboo</td>
							<td>250</td>
						</tr>
					</tbody>
				</table>
			</section>
		</div>
	</div>
</body>

</html>