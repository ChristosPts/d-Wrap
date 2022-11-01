<?php
if(isset($_POST["submit"])){
    session_start();

    require_once 'dbh.inc.php';

    $uid = $_POST["key"];
    $uType = $_SESSION["usType"];

    $select = mysqli_query($conn,"SELECT * FROM users WHERE usersId = $uid");
    if(mysqli_num_rows($select) >0){
        $fetch = mysqli_fetch_assoc($select);
        $uMail =  $fetch['usersEmail'];
        $userT = $fetch['userType'];  
        $imgp = $fetch['profileImg'];     
        $Uname =  $fetch['usersUsername'];
    }
 
    $select = mysqli_query($conn,"SELECT * FROM users WHERE usersId = '$id'");
    
    $fullPath = '../uploads/profiles/'.$imgp;
    if(!unlink($fullPath)){
        $URL="../profile?user=".$Uname."&page=1";
        header('location:'.$URL.'');
        exit();
    }  
    else {
        $query = "UPDATE users SET profileImg = NULL WHERE usersId = '$id' ";
        mysqli_query($conn,$query);
   
        if($uType =='Admin' && $uid != $_SESSION["userid"]){
            
            $message = "Your account has been deleted for violating our terms of service";
            $headers = "From: /*Enter your email here*/ \r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($uMail,'Account Deletion',$message,$headers);

            $query = "DELETE FROM users WHERE usersId = '$uid'";
            mysqli_query($conn,$query); 
            header("location: ../index?page=1");
            exit();
        }
        
        else if($uType =='User' || ($uType =='Admin' && $uid == $_SESSION["userid"])){
            
            $message = "Your account has been deleted, we're sad to see you go";
            $headers = "From: /*Enter your email here*/ \r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($uMail,'Account Deletion',$message,$headers);

            $query = "DELETE FROM users WHERE usersId = '$uid'";
            mysqli_query($conn,$query); 
            include_once 'logout.inc.php';
        }   
    } 
}
 
else{
    header("location: ../index?page=1&error");
    exit();
}
