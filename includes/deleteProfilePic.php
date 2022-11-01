<?php
if(isset($_POST["submit"])){
    
    session_start();
    require_once 'dbh.inc.php';
    
    $id = $_SESSION["userid"];    
    $select = mysqli_query($conn,"SELECT * FROM users WHERE usersId = '$id'");
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
      
    }
    $fullPath = '../uploads/profiles/'.$fetch['profileImg'];
    if(!unlink($fullPath)){
        header("location: ../profile_settings?error=ImgNotDeleted");
        exit();
    }  
    else {
        $query = "UPDATE users SET profileImg = NULL WHERE usersId = '$id' ";
        mysqli_query($conn,$query);
        header("location: ../profile_settings?success=ImgDeleted");
        exit();
    }
}

else{
    header("location: ../profile_settings?fail");
    exit();
}