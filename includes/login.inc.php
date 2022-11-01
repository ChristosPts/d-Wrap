<?php

if(isset($_POST["submit"])){

    /*username can be used for both mail and username */
    $username = $_POST["username"];
    $password = $_POST["pass"];

    require_once 'dbh.inc.php';
    require_once 'userExists.php';
    /*Error handlers*/
    if(empty($username) || empty($password)){
        header("location: ../login?error=Empty Input");
        exit();
    } else {
        /*I ask for either username or email,  */
        $userExists = userExists($conn,$username,$username);
        if($userExists === false ){
            header("location: ../login?error=Wrong Input");
            exit();
        } else {
            /*Compare password with the hashed(encrypted password) int the database 
            I take the collumn name from the DB which i want to compare*/
            $hashedPass = $userExists["usersPassword"];
            /*Password comparison */
            $checkPwd = password_verify($password,$hashedPass);

            if($checkPwd === false){
                header("location: ../login?error=Wrong Input");    
                exit();
            }
            else if ($checkPwd === true){
                /*sessions allow the user to stay loged in when changing pages closing browswer etc*/
                session_start();
                /*Superglobal variable (always accessible, regardless of scope - from any function, 
                class or file without having to do anything special.) */
                /*Second var is from DB */
                $_SESSION["userid"] =  $userExists["usersId"];
                $_SESSION["username"] =  $userExists["usersUsername"]; 
                $_SESSION["usType"] = $userExists["userType"]; 
                header("location: ../index?page=1");    
                exit();
            }
        }
    }
 
     
 

 
 

}

 

else{
    header("location: ../login");
    exit();
}