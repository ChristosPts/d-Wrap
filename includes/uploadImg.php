<?php

if(isset($_POST["submit"])){
    session_start();
    require_once 'dbh.inc.php';

    $catname = $_POST["catOption"];
 
    $usern= $_SESSION["username"];
    $id = $_SESSION["userid"];
    $time = date('Y-m-d H:i:s');   

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

    if($catname === "..."){
        $URL="../profile?user=".$usern."&error=SelectCategory";
        header('location:'.$URL.'');
        exit();
    }

    
     if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 11000000){
                //create unique image id
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../uploads/pics/'. $fileNameNew;
                $sql = "INSERT INTO images(usersId,imgPath,uploadDate) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("location: ../profile?error=error1");
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"sss", $id,$fileNameNew,$time);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                if($sql){
                    move_uploaded_file($fileTmpName,$fileDestination);
                }

                /*-----------Input category id and img id in imgcategories table----------------- */
                       $select1 = mysqli_query($conn,"SELECT * FROM categories WHERE catNames='$catname'");
                        if(mysqli_num_rows($select1) > 0){
                            $fetch = mysqli_fetch_assoc($select1);
                            $cat =  $fetch['catId'];
                        }

                        $select2 = mysqli_query($conn,"SELECT * FROM images WHERE imgPath='$fileNameNew'");
                        if(mysqli_num_rows($select2) > 0){
                            $fetch = mysqli_fetch_assoc($select2);
                            $imgId =  $fetch['imgId'];
                        }
                        
                        $sql2 = "INSERT INTO img_categories(catId,imgId) VALUES (?,?)";
                        $stmt2 = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt2,$sql2)){
                            header("location: ../profile?error=error1");
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt2,"ss", $cat,$imgId);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_close($stmt2);
                        
                /*----------------------------------- */
                $URL="../profile?user=".$usern."&success=".$fileNameNew."";
                header('location:'.$URL.'');
                exit();        
            }
            else{ 
                $URL="../profile?user=".$usern."&error=FileTooLarge";
                header('location:'.$URL.'');
                exit();
            }
        }
        else{
            $URL="../profile?user=".$usern."&error=error1";
            header('location:'.$URL.'');
            exit();
        }
    }
    else{
            $URL="../profile?user=".$usern."&error=FileTypeNotAllowed";
            header('location:'.$URL.'');
        exit();
    }
 
}

else{
    header("location: ../profile?'".$usern."'");
    exit();
}
