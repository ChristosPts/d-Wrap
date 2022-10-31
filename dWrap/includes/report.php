<?php

if(isset($_POST["submit"])){
    require_once 'dbh.inc.php';
    session_start();

    $imgp = $_GET['imgPath'];
    $id = $_SESSION['userid'];
    $reason = $_POST['report'];
    echo $reason;

    if($reason == ""){
        header("location: ../view?imgPath=". $imgp."&error=SelectReason");
        exit(); 
    } else {
    $select = mysqli_query($conn,"SELECT * FROM users WHERE usersId=$id");
     if(mysqli_num_rows($select) >0){
        $fetch = mysqli_fetch_assoc($select);
        $uMail =  $fetch['usersEmail'];
        $uName = $fetch['usersUsername'];

        $email = "chpidevtest@gmail.com";
        $message = "<p>The following image has been reported for $reason
        <a href='http://localhost/dWrap/view?imgPath=$imgp'>Reported Image</a></p>";
        $headers = "From: ".$uMail."\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        mail($email,'Image report from '.$uName.'',$message,$headers);
        header("location: ../view?imgPath=". $imgp."&success=imgReported");
        exit(); 

    
    } else {
        header("location: ../view?imgPath=". $imgp."&error=error1");
        exit(); 
    } 
}
    
    
}

else{
    header("location: ../view?imgPath=". $imgp."&error=error1");
    exit(); 
}