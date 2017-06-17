<?php
header("Content-type: application/json");

include_once "dbconnect.php"; //connect to the database
$stmt = $conn->prepare("SELECT * FROM locations WHERE location_id=:lid");
$stmt->bindValue(":lid",$_POST['location_id']);//$_POST gets info sent from js
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$locations = $stmt->fetchAll();

foreach($locations as $location){

	//store all the queried information in local variables
	$location_id = $location['location_id'];
	$name = $location['name'];
	$latitude = $location['latitude'];
	$longatude = $location['longatude'];
	$city = $location['city'];
	$country = $location['country'];
	$difficulty = $location['difficulty'];
	$rating = $location['rating'];
	$img_url = $location['img_url'];

	//prepare the array to be sent as json
	$loc_array = array(
		"location_id" => $location_id,
			"name" => $name,
			"latitude" => $latitude,
			"longatude" => $longatude,
			"city" => $city,
			"country" => $country,
			"difficulty" => $difficulty,
			"rating" => $rating,
			"img_url" => $img_url
	);
}
echo json_encode($loc_array);
?>





























