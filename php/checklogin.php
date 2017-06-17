<?php
session_start();
include_once "dbconnect.php";
print_r($_SESSION);
if (empty($_SESSION)){
    //no previous user in session
    echo "no user logged in"."<br/>";

    //obtain the values submitted by the user
    $input_email = $_POST['email'];
    $input_password = md5($_POST['password']);

    //do server-side validation to see if user exists
    $stmt=$conn->prepare('SELECT user_id,email,password FROM users WHERE email=:em');
    $stmt->bindValue(":em",$input_email);
    $stmt->execute();
    $numRows = $stmt->rowCount();

    if($numRows<1){
        echo "error, no user by the name:"." ".$input_email."<br/>";
        $_SESSION['valid']=False;
        header("Location: ../index.php");
    }else{
        //user exists, must compare password
        while($row=$stmt->fetch()){
            if ($input_password == $row['password']){
                //passwords match = legit user
                echo $row['user_id']."<br/>";
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['user']=$row['email'];
                $_SESSION['valid'] = True;         
                header("Location: ../index.php");
            }else{
                //invalid password
                $_SESSION['valid']= False;
                header("Location: ../index.php");
            }
        }
    }        
}else{
    echo "User already logged in?";
    header("Location: ../index.php");
}

$conn = null;
?>





























