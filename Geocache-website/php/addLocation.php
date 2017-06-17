<?php
include_once "dbconnect.php";
$stmt = $conn->prepare('INSERT INTO locations(location_id, name, latitude, longatude, city, country, difficulty, rating, img_url)
                        VALUES(NULL, :name, :lat, :long, :city, :country, :diff, :rating, :url)');
$stmt->bindValue(":name",$_POST['name']);
$stmt->bindValue(":lat",$_POST['latitude']);
$stmt->bindValue(":long",$_POST['longatude']);
$stmt->bindValue(":city",$_POST['city']);
$stmt->bindValue(":country",$_POST['country']);
$stmt->bindValue(":diff",$_POST['difficulty']);
$stmt->bindValue(":rating",$_POST['rating']);
$stmt->bindValue(":url", $_POST['url']);

$stmt->execute();

$numRows = $stmt->rowCount();
$id = $conn->lastInsertId();

if ($numRows < 1){
	echo "error";
}else{
	echo $id;
}

/* DEBUG OUTPUT
echo $_POST['name']."\n";
echo $_POST['latitude']."\n";
echo $_POST['longatude']."\n";
echo $_POST['city']."\n";
echo $_POST['country']."\n";
echo $_POST['difficulty']."\n";
echo $_POST['rating']."\n";
*/

$conn = null; //disconnect from database

?>





























