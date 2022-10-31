<?php

if(isset($_POST["submit"])){
    session_start();
    require_once 'dbh.inc.php';


    $id = $_SESSION["userid"];
    
    $file = $_FILES['file'];  
    $fileName = $file['name'];
    //temporary location
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    //split filename and extention
    $fileExt = explode('.', $fileName);
    //get extentions
    $fileActualExt = strtolower(end($fileExt));

    //array with allowed extentions
    $allowed = array('jpg','jpeg','png');

  
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 10000000){
                //create unique image id
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../uploads/profiles/'. $fileNameNew;
                $image_update = mysqli_query($conn,"UPDATE users SET profileImg = '$fileNameNew' WHERE usersId = '$id'");
                if($image_update){
                    move_uploaded_file($fileTmpName,$fileDestination);
                }

                header("location: ../profile_settings?success=Image uploaded successfully!");
                exit();
            }
            else{ 
                header("location: ../profile_settings?error=File size too large");
                exit();
            }
        }
        else{
            header("location: ../profile_settings?error=An error has occured please try again");
            exit();
        }
    }
    else{
        header("location: ../profile_settings?error=File type not allowed");
        exit();
    }
  


} else {
    header("location: ../profile_settings?Error");
}
 