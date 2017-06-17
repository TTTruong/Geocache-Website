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
		<title>Contact - AMTT - Geocaching</title>
		<link rel="stylesheet" href="jquery-local/jquery-ui-1.11.4.custom/jquery-ui.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/mobile.css" type="text/css" media="screen and (max-width: 760px)"/>
		<link rel="stylesheet" href="css/coin-slider-styles.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/hover-min.css" type="text/css"/>
		<link rel="stylesheet" href="css/main.css" type="text/css"/>
		<link rel="stylesheet" href="css/contact.css" type="text/css"/>
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
			<form id="loginForm" method="POST" action="php/contactchecklogin.php">
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
				echo '<a href="php/contactlogout.php">';
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
			<article id="authors">
				<content>
					<header>
						Authors
					</header>
					<content>
						<div id="Alex">
							<header>
								Alex Mihaylov
							</header>
							<div id="alex-pic">
								<img src="img-res/avatar.jpg" alt="Profile Pic">
							</div>
							<content>
								100536396
								<a href="mailto:alex.mihaylov@uoit.net">alex.mihaylov@uoit.net</a><br>
								GitHub: <a href="https://github.com/amihaylo">amihaylo</a>
							</content>
						</div>
						<div id="Truyen">
							<header>
								Truyen Truong
							</header>
							<div id="truyen-pic">
								<img src="img-res/avatar.jpg" alt="Profile Pic">
							</div>
							<content>
								100516976
								<a href="mailto:truyen.truong@uoit.net">truyen.truong@uoit.net</a><br>
								GitHub: <a href="https://github.com/TTTruong">TTTruong</a>
							</content>
						</div>
					</content>
				</content>
			</article>
		</div>    
		<!--FOOTER -->
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
						<a href="about.php">About</a>
					</li>
					<li>
						<a href="#">Contact</a>
					</li>
				</ul>
			</div>
		</footer>
	</body>
</html>
<?php $conn = null ?>
