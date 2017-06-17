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
		<title>Main - AMTT - Geocaching</title>
		<link rel="stylesheet" href="jquery-local/jquery-ui-1.11.4.custom/jquery-ui.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/mobile.css" type="text/css" media="screen and (max-width: 760px)"/>
		<link rel="stylesheet" href="css/coin-slider-styles.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/hover-min.css" type="text/css"/>
		<link rel="stylesheet" href="css/main.css" type="text/css"/>
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
			<form id="loginForm" method="POST" action="php/checklogin.php">
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
					echo '<a href="#">Sign up</a>';
					echo '</div>';				
				}
			}else if($_SESSION['valid']==True){				
				//logout button
				echo '<div id="logoutButton">';
				echo '<a href="php/logout.php">';
				echo '<img src="img-res/log-out.svg" data-toggle="tooltip" title="Logout"/>';
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
			<article id="welcomeRegister">
				<content>
					<header>
						<?php if ($loggedIn){
							//user is logged in
							echo "Welcome Back $user!";
						}else{
							echo "Start exploring by signing up today!";
						}
						?>
					</header>
					<div id="galleryHolder">
						<div id="gallery">
							<a href="about.php">
								<img src="img-res/welcome1.jpg" id="img1"/> 
								<span>
									Geocaching is a hunting activity that uses latitude and longitude 
									coordinates for finding hidden objects.
								</span>
							</a>
							<a href="#infoSummary">
								<img src="img-res/welcome2.jpg" id="img2"/>
								<span>
									Start exploring today!
								</span>
							</a>
							<a href="contact.php">
								<img src="img-res/welcome3.png" id="img3"/> 
								<span>
									Hiring today!
								</span>
							</a>
						</div>
					</div>
					<?php
					if($loggedIn){
						//user is logged in
						echo "<div id='profilePic'>";
						echo '<img src="img-res/default-profile-pic.png" alt="Profile Pic">';
						echo "</div>";
					}else{
						
					?>
						<?php $regError="";
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							//$emailEror="error lel";
							include_once "php/handleRegistration.php";
						}
						?>
						                        
						<form id="register" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<p>Start Here</p>
							<input id="registerEmail" class="login" type="text" name="email" placeholder="Username" autocomplete="off"></input></br>
							<input id="registerPass" class="login" type="password" name="password" placeholder="Password"></input>
							<button id="registerButton">Register</button></br></br>
							<span id="error"><?php echo $regError ?></span>
						</form>
					<?php } ?>
				</content>
			</article>
			<article id="locationSummary">
				<content>
					<table>
						<?php
						include_once "php/dbconnect.php"; //connect to the database
						$stmt = $conn->prepare("SELECT img_url FROM locations LIMIT 8");
						$stmt->execute();
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						$items = $stmt->fetchAll();
						$i = 1;
						echo "<tr>";
						foreach($items as $item){
							if (($i % 4) == 0){
								$newRow = true;
							}else{
								$newRow = false;
							}
							echo "<td><img src=./".$item['img_url']."></td>";
							if($newRow){echo "</tr>";}
							if($newRow){echo "<tr>";}
							$i++;
						}
						echo "</tr>";
						?>
					</table>
				</content>
			</article>
			<article id="infoSummary">
				<content>
					<div id="step1">
						<header>
							Sign up for free with ease!
						</header>
						<img src="img-res/step1-img.png" alt="Step 1 - Sign Up!"/>
						<content>
							<p>
								Start searching for geocaches by signing up for free now!
								Signing up allows to view all the geocaches that other
								searchers have created, and are finding. All you need is
								to sign up with an username and password to start your
								adventure!
							</p>
						</content>
					</div>
					<div id="step2">
						<header>
							Find geocaches!
						</header>
						<img src="img-res/step2-img.png" alt="Step 2 - Find Geocaches!"/>
						<content>
							<p>
								There is a vast assortment of different types of geocaches.
								These geocaches could be close or far away from you. They
								could vary from micro items to large items. Each geocache
								has it's own difficulty that vary from very easy to impossible!
							</p>
						</content>
					</div>
					<div id="step3">
						<header>
							Create your own geocaches!
						</header>
						<img src="img-res/step3-img.png" alt="Step 3 - Create Geocaches!"/>
						<content>
							<p>
								While you are searching for geocaches that have been created,
								you can create your very own geocache that you or others could
								search for! You could customize your geocache to be very easy for
								the new searchers, or impossible for the intense searchers.
							</p>
						</content>
					</div>
				</content>
			</article>
		</div>    
		<!--FOOTER -->
		<footer id="footer">
			<div id="copyright">
				© 2015 AMTT, Inc.
			</div>
			<div id="footerlogo">
				<a href="#">
					<img src="img-res/grey-logo.png" alt="AMTT Logo"/>
				</a>
			</div>
			<div id="pagelinks">
				<ul>
					<li>
						<a href="#">Home</a>
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
						<a href="contact.php">Contact</a>
					</li>
				</ul>
			</div>
		</footer>
	</body>
</html>
<?php $conn = null ?>
