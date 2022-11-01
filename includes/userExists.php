<?php
require_once 'dbh.inc.php';

function userExists($conn,$username,$email){
    /*It checks if a username exists or an email is already in use
    this will also let us login with either the username or the email */
    $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../login?error=userExist");
        exit();
    }
    /*ss since im passing two strings name and email if i was passing
     5 strings then i would have sssss */
    mysqli_stmt_bind_param($stmt,"ss",$username,$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
