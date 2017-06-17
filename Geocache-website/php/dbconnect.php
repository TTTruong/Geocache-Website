<?php
$dbname = "mihaylov";
$dbuser = "alex";
$dbpass = "admin";
$dbhost = "localhost";

try{
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

}catch (PDOException $e){
    echo $e->getMessage();
}            
?>





























