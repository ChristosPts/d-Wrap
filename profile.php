    <?php
        include_once 'global/header.php';
        require_once 'includes/dbh.inc.php';
      ?>

   
    <title>Profile</title>
</head> 

<body class = "bgBody">
<div id="wrapper">   
    <?php   
        $id = $_SESSION["userid"];
        $uname = $_GET['user'] ?? null;
        $uType =  $_SESSION["usType"];

        if(!isset($id)) {
            header("Location:index?page=1");
            die("Please login");
        }

        if($uname == null){
            header("Location:index?page=1");
            exit();
        }     
    ?>

    <div class = "row">
         <?php include_once 'global/navbar.php';  ?>  
     </div>
        
    <div class="container-fluid ">
        <div class="row "> 
            <div class="col-md-12 my-4 ProfPpic justify-content-center text-center">        
                <?php
                //get user information based on the user passed from the link on top 
                    $select = mysqli_query($conn,"SELECT * FROM users WHERE usersUsername = '$uname'");
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                        $Uid =  $fetch['usersId'];
                        $userT = $fetch['userType'];
                    } else {
                        header("Location:index?page=1");
                        exit();
                       }     
                    
                    if($fetch['profileImg'] == ''){
                        echo '<img src="uploads/profiles/default.jpg">';
                    } else  if($fetch['profileImg'] !== TRUE ){
                        echo '<img src="uploads/profiles/'.$fetch['profileImg'].'">';
                    }
                    if(isset($_SESSION['userid'])){ 
                        if($Uid == $_SESSION['userid']){
                        echo '<br> <a href="profile_settings" class="text-decoration-none">'.$uname.'</a> ';
                        }
                    }   else echo $uname;
                ?>
            </div>
        </div>
    </div>         
      
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-md-12">
    
                <?php  //Show upload buttons only to owners of profile pages   
                    if($Uid == $id){ ?>
                   <div class="row  mx-4 upseBar">
                            <div class="col-md-6 py-2 justify-content-center text-center">
                            <?php include  'front/searchOptionsPf.php';  ?>
                        </div>
                            <div class="col-md-6 py-2  justify-content-center text-center">
                                <form action ="includes/uploadImg" method="POST" enctype="multipart/form-data">
                                    <input type="file" name ="file" style="display:none" id="getFile"> 
                                    <label for="file" class="btn" onclick="document.getElementById('getFile').click()">Select Image</label>
                                    <?php include "front\catOptions.php"; ?>
                                   <button type="submit" name="submit">UPLOAD</button> 
                        
                                </form>
                                <div class = "errorMsgs">
                                <?php 
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "FileTypeNotAllowed"){
                                            echo "File Type Not Allowed"; 
                                        }  else if($_GET["error"] == "error1"){
                                            echo "An error has occured please try again";
                                        }
                                        else if($_GET["error"] == "FileTooLarge"){
                                            echo "Max filesize is 10 MB";
                                        }
                                        else if($_GET["error"] == "SelectCategory"){
                                            echo "Please Select a Category";
                                        }
                                    }?>
                                 </div>   
                            </div>
                        </div>
                   <?php } 
                    else { // show only search bar to guests ?>
                    <div class="row  mx-4 upseBar">
                        <div class="col-md-12 py-2 justify-content-center text-center">  
                            <?php include 'front/searchOptionsPf.php';  ?>
                        </div>
                     </div> 
            <?php } ?>
            
                    <div class="row mx-4 d-flex justify-content-center text-center">
                        <div class="col-md-12 mt-3 py-4 wrapper-gallery">
                            <div>
                                <?php include_once 'func/galleryPf.php';?>
                            </div>
                            <div class = "pagination d-flex justify-content-center text-center">
                                <div class="pageBorder"> <?php include_once 'global/pagingPf.php';?> </div>
                            </div>      
                        </div>
                    </div>
                 </div>
                 
            </div>
        </div>
 

   <hr>
    <div class = "deleteProf py-2 justify-content-center text-center" id = "deleteProf">
    <?php 
      // show delete profile button to admins
    if($uType == 'Admin' && $uType !== $userT){?>
          <form action ="includes/deleteProfile.php" method="post">
            <input type="hidden" id="key" name="key" value="<?php echo "$Uid";?>" />    
            <button type="submit" name="submit"  onclick="return confirm('Are you sure?')">DELETE</button>
            </form>        
    <?php } ?>
   </div>    
</div>       
</body>
</html> 
 
     
                      
        


                 
    