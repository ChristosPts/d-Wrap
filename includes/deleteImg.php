<?php
if(isset($_POST["submit"])){
    session_start();
    require_once 'dbh.inc.php';
    
    $uType = $_SESSION["usType"];
    $usern= $_GET["userName"];

    $imgPath = $_GET['imgPath'];
    $fullPath = '../uploads/pics/'.$imgPath;

    $Uname = 'Deleted User';
    $pfImg = "default.jpg";

    $Uid= $_GET["imgUid"];

    
    $select = mysqli_query($conn,"SELECT * FROM images WHERE imgPath = '$imgPath'");
    if(mysqli_num_rows($select) >0){
        $fetch = mysqli_fetch_assoc($select);
        $imgId =  $fetch['imgId'];
    } else {
        $URL="../index?page=1&error=imgError";
        header('location:'.$URL.''); 
        exit();
    }

    //if user doesnt exit delete img and go back to index 
    if($Uid == ''){
        $query = "DELETE FROM images WHERE imgPath = '$imgPath'";
        mysqli_query($conn,$query);

        $query = "DELETE FROM img_categories WHERE imgId = '$imgId'";
        mysqli_query($conn,$query);

        $URL="../index?page=1&success=success";
        header('location:'.$URL.''); 
        exit();
    } else {
        //else get user data 
        $select = mysqli_query($conn,"SELECT * FROM users WHERE usersId = $Uid");
        if(mysqli_num_rows($select) >0){
            $fetch = mysqli_fetch_assoc($select);
            $uMail =  $fetch['usersEmail'];
            $userT = $fetch['userType'];            
        }       
    }

    if(!unlink($fullPath)){
        //if img cant be deleted stay on view page
        $URL="../view?imgPath=".$imgP."&error=ImgNotDeleted";
        header('location:'.$URL.'');
        }   
    else {
        $query = "DELETE FROM images WHERE imgPath = '$imgPath'";
        mysqli_query($conn,$query);

        $query = "DELETE FROM img_categories WHERE imgId = '$imgId'";
        mysqli_query($conn,$query);
    
        if($uType =='Admin' && $uType !== $userT){
            $message = "One of your images has been deleted for violating our terms of service";
            $headers = "From: chpidevtest@gmail.com \r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($uMail,'Image Deletion',$message,$headers);

            $URL="../index?page=1";
            header('location:'.$URL.''); 
           
            exit();
        } else {
            $URL="../profile?user=".$usern."&page=1&success=success";
            header('location:'.$URL.'');
            exit();
        } 
        
    } 

}  
else {
    $URL="../index?page=1";
    header('location:'.$URL.''); 
    exit();
}
