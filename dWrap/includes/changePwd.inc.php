<?php
 session_start(); 
 
if(isset($_POST["submit"])){

    $oldPassword = $_POST["oldPass"];
    $newPassword = $_POST["newPass"];
    $passConfirm = $_POST["newPassConf"];
    $id = $_SESSION["userid"];

    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $lowercase = preg_match('@[a-z]@', $newPassword);
    $number    = preg_match('@[0-9]@', $newPassword);
    $specialChars = preg_match('@[^\w]@', $newPassword);
    
    require_once 'dbh.inc.php';
 
        $sql = "SELECT * FROM users WHERE usersId = '" . $id . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($result);

        if(empty($oldPassword) || empty($newPassword) || empty($passConfirm)){
            header("location: ../login?error=Empty Input");
            exit();
        } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newPassword) < 8) {
            header("location: ../profile_settings?error=fewChars");
            exit(); 
        } else if (password_verify($oldPassword, $row->usersPassword)){
            // Check if password is same
            if ($newPassword == $passConfirm){
            // Change password
                $sql = "UPDATE users SET usersPassword = ? WHERE  usersId = '" . $id . "'";            
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("location: ../register?error=An error has occured");
                    exit();
                } else {
                    //update password in users table
                    $hashedNewPwd = password_hash($newPassword, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"s",$hashedNewPwd);
               
          
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    header("location: ../profile_settings?success=Success");
                    exit(); 
                }  
                
                } else {
                    header("location: ../profile_settings?error=PwdMatch");
                    exit();
              }
          }
 


}
else {
    header("location: ../profile_settings");
    exit();
}