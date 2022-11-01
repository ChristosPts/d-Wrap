<?php
   if (isset($_POST["submit"])){

    require 'dbh.inc.php';

    $selector = $_POST["selector"];
    $validator =  $_POST["validator"];
    $password = $_POST["pass"];
    $passConfirm = $_POST["passConf"];

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    echo $validator;
 
  if(empty($password) || empty($password)){
        header("location: ../newpass?selector=".$selector."&validator=".$validator."&error=EmptyField");
        exit();
    }

    else if ($password !== $passConfirm){
        header("location: ../newpass?selector=".$selector."&validator=".$validator."&error=PasswordsDontMatch");
        exit();
    }  else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        header("location: ../newpass?selector=".$selector."&validator=".$validator."&error=fewChars");
        exit();
    } else {
    

    $currentDate = date("U");
    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpiration >= ?";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../newpass?error=error");
        exit();
    } else {    

        mysqli_stmt_bind_param($stmt,"ss",$selector,$currentDate);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(!$row = mysqli_fetch_assoc($result)){
            header("location: ../newpass?error=error");
            exit();
         
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin,$row["pwdResetToken"]);

            if($tokenCheck === false){
                header("location: ../newpass?error=error");
                exit();

            } elseif($tokenCheck === true){
                $tokenEmail = $row['pwdResetEmail'];
                $sql = "SELECT * FROM users WHERE usersEmail=?";
                $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        header("location: ../newpass?error=error");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if(!$row = mysqli_fetch_assoc($result)){
                            header("location: ../newpass?error=error");
                            exit();
                        } else {
                            $sql = "UPDATE users SET usersPassword = ? WHERE usersEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                header("location: ../newpass?error=error");
                                exit();
                            } else {
                                //update password in users table
                                $hashedNewPwd = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt,"ss",$hashedNewPwd,$tokenEmail);
                                mysqli_stmt_execute($stmt);

                                //Delete token
                                $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt,$sql)){
                                    header("location: ../recovery?error=error");
                                    exit();
                                } else {
                                    // what the ? gets replaced with
                                    mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                                    mysqli_stmt_execute($stmt);
                                    header("location: ../login?success=PwdUpdated");
                                }

                            }

                        }
                    }
            }

        }
    } 
    }
 
} else {
     header("location: ../index?page=1&error");
    exit();
}
