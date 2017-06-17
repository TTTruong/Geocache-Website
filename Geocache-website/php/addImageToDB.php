<?php
include_once "dbconnect.php";
//get the sent variables
$locId = $_POST["loc_id"]."\n";
$filepath = $_POST["file"]."\n";

$stmt = $conn->prepare('UPDATE locations SET img_url=:url WHERE location_id=:id');
$stmt->bindValue(":url",$filepath);
$stmt->bindValue(":id",$locId);
$stmt->execute();

$numRows = $stmt->rowCount();

if($numRows< 1){
	echo "[addImageToDB]Update error";
}else{
	echo "success";
}

$conn = null;
?>





























