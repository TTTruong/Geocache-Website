<?php
header("Content-type: application/json");
//@ Reference http://www.w3schools.com/php/php_file_upload.asp
//[file] => Array
//[name] => lab6c.png
//[type] => image/png
//[tmp_name] => /opt/lampp/temp/phpPlnDuB
//[error] => 0
//[size] => 72994


//echo $_FILES['file']['name']; //contains the name of the file
$target_dir = "img-res/geo-items/";
$target_file = $target_dir.basename($_FILES['file']['name']);
$file_extension = pathinfo($target_file,PATHINFO_EXTENSION); //returns "png" for a filename.png file
$img_verified = 0;

//check if a real iamge or fake
//echo print_r($_SERVER);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$file_check = getimagesize($_FILES['file']['tmp_name']);
	if($file_check){
		//It is an actual file
		$img_verified = 1;
	}else{
		//Not an actual file
		$img_verified = 0;                
	}
}

//check the file format
if($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg"
	&& $file_extension != "gif" ) {
	//The file is not the right format
	//echo "File is not in the right format\n";
	$uploadOk = 0;
}

if ($_FILES['file']['size'] > 500000){
	//echo "Image too large!\n";
	$img_verified = 0;
}

//check if file already exists
if (file_exists($target_file)){
	//file already exists, adding unique number to the filename
	$target_file = $target_dir.explode(".", $_FILES['file']['name'])[0].time().".$file_extension";
}

if ($img_verified == 0){
	//the file failed verification
}else{
	//Image was verified, need to attempt to upload it    
	if (move_uploaded_file($_FILES['file']['tmp_name'], "../".$target_file)) {
		//echo $target_file."\n";
		//echo "Moved:".$_FILES['file']['tmp_name']." to ->".$target_file."\n";
		//echo "success\n";
		$return_array = array(
			"completed" => "True",
				"filename"=> $target_file
		);
	} else {
		//echo "Error uploading the file\n";
		$return_array = array(
			"completed" => "False"
		);
	}
}
echo json_encode($return_array);
?>






























