<?php
   if (isset($_POST["submit"])){

    require 'dbh.inc.php';

    $email = $_POST['email'];
    //using different tokens prevents timing attacks
    //user authentication token
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    
    if(empty($email)){
        header("location: ../recovery?error=Empty Input");
        exit();
    } else {
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            header("location: ../recovery?error=InvalidForm");
            exit();
        } else {   
            $url = "http://localhost/dWrap/newpass?selector=".$selector."&validator=".bin2hex($token).""; 
            $expires = date("U") + 900;

            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("location: ../recovery?error=wrongEmail");
                exit();
            } else {
                // what the ? gets replaced with
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
            }

            $sql = "INSERT INTO pwdreset(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpiration) 
                    VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("location: ../recovery?error=error");
                exit();
            } else {
                $hashedToken = password_hash($token,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ssss",$email,$selector,$hashedToken,$expires);
                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            $message = "<p>We received a password reset request. 
            The reset password link expires in 30 minures. </p>";
            $message .= "<a href=".$url.">Reset Password</a>";
            $message .= "<p>If youd did not request a password reset you can ignore this email. </p>";

            $headers = "From: dWrap </*enter your email  address here*/> \r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($email,'dWrap Password Reset',$message,$headers);
            header("location: ../index?page=1&success=PassReq");
            exit();
            //database authentication token
        }
    }
}
else{
    header("location: ../index?page=1");
    exit();
}

