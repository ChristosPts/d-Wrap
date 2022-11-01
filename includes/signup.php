<?php

if (isset($_POST["submit"])){

    $username = $_POST["Username"];
    $email = $_POST["Email"];
    $password = $_POST["pass"];
    $passConfirm = $_POST["passconf"];
    $BoxConfirm = $_POST["cBox"];

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    require_once 'dbh.inc.php';
    require_once 'userExists.php';
  
    $vkey = md5(time().$username); 
    
    if(empty($username) || empty($email) || empty($password) || empty($passConfirm)){
        header("location: ../register?error=Empty Input");
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            header("location: ../register?error=Invalid Username");
            exit();
    } else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            header("location: ../register?error=Invalid Email");
            exit();
    } else if($password !== $passConfirm){
            header("location: ../register?error=Passwords dont match");
            exit();
    } else  if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            header("location: ../register?error=fewChars");
            exit();
    }  else if(empty($BoxConfirm)){
            header("location: ../register?error=Please agree to the ToS");
            exit();
    } else {
        $userExists = userExists($conn,$username,$email);
        if($userExists !== false ){
            header("location: ../register?error=UserMail");
            exit();
        }else{
            $sql = "INSERT INTO users(usersUsername,usersEmail,usersPassword,vkey,registerDate) VALUES (?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
           
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("location: ../register?error=An error has occured");
                exit();
            }
         
            /*password protection*/
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $time = date('Y-m-d H:i:s');
            /*ss since im passing two strings name and email*/
            $insert = mysqli_stmt_bind_param($stmt,"sssss", $username,$email,$hashedPwd,$vkey,$time);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        
            if($insert){
                $message = "<a href='http://localhost/dWrap/verify?vkey=$vkey'>Verify Account</a>";
                $headers = "From: /*Enter your email here*/ \r\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                mail($email,'dWrap Email Verification',$message,$headers);
                header("location: ../index?page=1&success=Success");
                exit();
            }   
        }
     }
}

 
else {
    header("location: ../register?error");
    exit();
}
