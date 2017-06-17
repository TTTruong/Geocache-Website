<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['valid'] == True){
	//user exists
	/*	include_once "php/dbconnect.php"; //connect to the database
	   $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
	   $stmt->bindValue(":id",$_SESSION['user']);
	   $stmt->execute();

	   while($row=$stmt->fetch()){
	   //echo "hello"." ".$row['email']."</br>";
	   $user = $row['email'];		
	   }*/
	$user = $_SESSION['user'];
	$loggedIn = True;
}else{
	//user does not exist
	//	$user = '';
	$loggedIn = False;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/><!--Scales for mobile devices -->
		<title>About - AMTT - Geocaching</title>
		<link rel="stylesheet" href="jquery-local/jquery-ui-1.11.4.custom/jquery-ui.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/mobile.css" type="text/css" media="screen and (max-width: 760px)"/>
		<link rel="stylesheet" href="css/coin-slider-styles.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/hover-min.css" type="text/css"/>
		<link rel="stylesheet" href="css/main.css" type="text/css"/>
		<link rel="stylesheet" href="css/about.css" type="text/css"/>
		<link rel="icon" href="img-res/logo.png" alt="icon"/>
		<script type="text/javascript" src="jquery-local/jquery-1.11.3.min.js"></script>
		<script src="jquery-local/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
		<script src="jquery-local/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
		<script src="jquery-local/coin-slider.min.js"></script>
		<script src="js/core.js"></script>
	</head>
	<body>
		<!--HEADER -->
		<header id="header">
			<div id="logo">
				<a href="index.php">
					<img src="img-res/logo.png" alt="AMTT Logo"/> AMTT
				</a>
			</div>
			<form id="loginForm" method="POST" action="php/aboutchecklogin.php">
				<div>
					<input type="text" name="email" placeholder="Username" autocomplete="off"></input></br>
					<input type="password" name="password" placeholder="Password" autocomplete="off"></input></br>	
				</div>
				<button id="login">Log in</button>
			</form>
			<?php
			if (!isset($_SESSION['user'])){
				//user has not logged in, could be attempted or non-attempted
				echo '<div id="loginButton">';
				//echo '<a href="#">Log in</a>';
				echo '<a href="#"';
				
				if (isset($_SESSION['valid']) && $_SESSION['valid']==False){
					//user attempted to to log in but failed
					echo 'style="color:#cc0000">Error: TRY AGAIN</a>';
					echo '</div>';
					session_unset(); 
				}else {
					//first time user
					echo '>Log in</a>';
					echo '</div>';
					
					echo '<div id="signupButton">';
					echo '<a href="index.php">Sign up</a>';
					echo '</div>';				
				}
			}else if($_SESSION['valid']==True){				
				//logout button
				echo '<div id="logoutButton">';
				echo '<a href="php/aboutlogout.php">';
				echo '<img src="img-res/log-out.svg"/ data-toggle="tooltip" title="Logout">';
				echo '</a></div>';
				
				//addButton
				echo '<div id="addButton">';
				echo '<a href="addGeo.php">';
				echo '<img src="img-res/my-geo.svg" data-toggle="tooltip" title="Geocaches"/>';
				echo '</a></div>';				
			}
			?>
		</header>
		<!--MAIN BODY -->
		<div id="mainBody">
			<article id="title">
				<content>
					<header>
						What is geocaching?
					</header>
				</content>
			</article>
			<article id="banner">
				<content>
					<img src="img-res/aboutbanner.jpg" id="bannerimg"/> 
				</content>
			</article>
			<article id="info">
				<content>
					<div id="description">
						<header>
							Description
						</header>
						<content>
							<p>
								Geocaching is a treasure hunt that happens in real-life.
								The searcher is given a location in the form of coordinates
								(latitude and longitude). At that location there will be a
								geocache (container). The geocache is hidden, and the searchers
								must find the geocache. 
							</p>
						</content>
					</div>
					<div id="rules">
						<header>
							Rules
						</header>
						<content>
							<ul>
								<li>
									Try not to spoil the hidden location for other searchers
								</li>
								<li>
									When you find a geocache, if you decide to take the item,
									replace it with an item
								</li>
								<li>
									Place the geocache back in the spot after you have found it
								</li>
								<li>
									Keep a log on the geocaches you have found
								</li>
								<li>
									Most importantly: HAVE FUN! &#9786;
								</li>
							</ul>
						</content>
					</div>
					<div id="resources">
						<header>
							Resources
						</header>
						<content>
							<p>
								The resources needed to geocache would be a GPS or a way
								to reach the coordinates given. The rest is up to the
								imagination.
							</p>
						</content>
					</div>
					<div id="locations">
						<header>
							Locations
						</header>
						<content>
							<p>
								The location of geocaches can be anywhere and everywhere.
								There are locations all over the world. Since anyone can
								create their own geocache, and allow others to search for
								their geocaches, there will a vast number of locations.
								The locations could be anywhere from in the city, or ontop
								of a mountain after a long hike. The locations are left to
								the imaginations of the creators, which makes geocaching
								so great!
							</p>
						</content>
					</div>
				</content>
			</article>
		</div>
			
		<footer id="footer">
			<div id="copyright">
				© 2015 AMTT, Inc.
			</div>
			<div id="footerlogo">
				<a href="index.php">
					<img src="img-res/grey-logo.png" alt="AMTT Logo"/>
				</a>
			</div>
			<div id="pagelinks">
				<ul>
					<li>
						<a href="index.php">Home</a>
					</li>
						<?php if ($loggedIn){
							//user is logged in
							echo "<li>";
							echo '<a href="addGeo.php">Geocaches</a>';
							echo "</li>";
						}
						?>
					<li>
						<a href="#">About</a>
					</li>
					<li>
						<a href="contact.php">Contact</a>
					</li>
				</ul>
			</div>
		</footer>
	</body>
</html>
<?php $conn = null ?>
