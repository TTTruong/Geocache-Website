<?php
$dbname = "mihaylov";
$dbuser = "alex";
$dbpass = "admin";
$dbhost = "localhost";

try{
    $regError = ""; //error if user is unable to register
    //check if user added in valid data
    if (empty(trim($_POST["email"]))){
        $regError = "Empty Username.";
    }else if(empty(trim($_POST["password"]))){
        $regError = "Empty Password.";        
    }else{
        //user has entered in some information, check if email is already in database
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
        $stmt = $conn->prepare('SELECT * FROM users WHERE email=:em');
        $stmt->bindValue(":em", $_POST["email"]);
        $stmt->execute();

        $numRows = $stmt->rowCount();
        if ($numRows > 0){
            //Error, username already in database
            $regError = "Username already exists.";        
        }else{
            //email is put in for the first time
            //User has entered in valid information
            //Enter the user information into the database
            $stmt = $conn->prepare('INSERT INTO users(user_id, email,password) 
                            VALUES(NULL, :em, :pw)');

            $stmt->bindValue(":em", $_POST["email"]);
            $stmt->bindValue(":pw", md5($_POST["password"]));
            $stmt->execute();

            $numRows = $stmt->rowCount();
            $id = $conn->lastInsertId();

            if($numRows<1){
                echo "Error: numRows < 1";
                die();
            }else{
                //SUCCESS
                $_SESSION['user'] = $_POST["email"];
                $_SESSION['valid'] = True;
                //echo "user inserted successfully";
                $emailEror="Valid";
                header('Location: index.php');
            }
            $conn = null;
        }                      
    }
    
}catch (PDOException $e){
    echo $e->getMessage();
}            
?>



























































