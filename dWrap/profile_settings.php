<?php
        include_once 'global/header.php';
        require_once 'includes/dbh.inc.php';
        $id = $_SESSION["userid"];
        $usern = $_SESSION["username"];
        $uType = $_SESSION["usType"];
    ?>   

    <title>Settings</title>
</head> 

<body class = "bgBody">
<div id="wrapper">    
    <div class="row">
        <?php include_once 'global/navbar.php';
            if(!isset($id)) {
            header("Location:index?page=1");
            die("Please login");
        }?> 
    </div>

    <div class="container-fluid">
        <div class="row pfSettings d-flex justify-content-center mx-auto text-center">
            <div class="col-md-12">
                
                <div class="row" >
            
                    <div class="col-md-1 my-5 backBtn backBtnPos">
                            <?php echo '<a href="profile?user='.$usern.'"><button>Back</button></a>';  ?>  
                    </div>
                
                    <div class="col-md-10 changeBox">
                        <div class="row box d-flex justify-content-center mx-auto text-center">
                            <div class="col-md-12">
                             
                                <div class = "DelBtn">            
                                    <form action ="includes/deleteProfilePic.php" method="POST">  
                                        <button type="submit" name="submit" title="Remove Profile Image"><i class="bi bi-x-lg"></i></button>     
                                    </form>    
                                </div> 
                                
                                <div class = "UplBtn">    
                                    <form  action ="includes/uploadProfileImg.php" method="POST" enctype="multipart/form-data" id = "form1">
                                        <input type="submit" name="submit" style="display:none" id="submit">
                                        <input type="file" name="file" id="file" onchange="document.getElementById('submit').click()" style="display:none">
                                        <label for="file" class="btn" title="Upload Profile Image"><i class="bi bi-upload"></i> </label> 
                                    </form>
                                </div>
                                
                                <div class = "ChangePpic" id = "ChangePpic">
                                    <?php
                                        $select = mysqli_query($conn,"SELECT * FROM users WHERE usersId = '$id'");
                                        if(mysqli_num_rows($select) > 0){
                                            $fetch = mysqli_fetch_assoc($select);
                                            $pfUserId = $fetch['usersId'];
                                            $imgp = $fetch['profileImg']; 
                                        }
                                        if($fetch['profileImg'] == ''){
                                            echo '<img src="uploads/profiles/default.jpg">';
                                        } else {
                                            echo '<img src="uploads/profiles/'.$fetch['profileImg'].'">';} ?> 
                                </div> <hr>
                                       
                                <div  class = "changePass col-md-12" id = "changePass">
                                    <h3>Change Password</h3>
                                    <?php if(isset($_GET["success"])){
                                        if($_GET["success"] == "ImgDeleted"){
                                            echo "";
                                            }
                                            else if($_GET["success"] == "Success"){
                                                echo "Password change successfull";
                                            }
                                        }?>
                                                    
                                    <form  action = "includes/changePwd.inc.php" method="post" id = "changePwdForm" class = "changePwdForm">                                            
                                        <div class="form-group">
                                            <span class = "input-icon"><i class="bi bi-shield-lock-fill"></i></span>
                                            <input type = "password" name = "oldPass" placeholder="Old Password">
                                        </div>    
                                        <div class="form-group">
                                            <span class = "input-icon"><i class="bi bi-lock"></i></span>
                                            <input type ="password" name = "newPass" placeholder="New Password">
                                        </div>
                                        <div class="form-group"> 
                                            <span class = "input-icon"><i class="bi bi-lock-fill"></i></span>
                                            <input type ="password" name = "newPassConf" placeholder="Confirm New Password">
                                        </div>
                                        <div>
                                            <?php  
                                            if(isset($_GET["error"])){
                                                if($_GET["error"] == "Empty Input"){
                                                    echo "Empty field";
                                                }
                                                else if($_GET["error"] == "PwdMatch"){
                                                    echo "Passwords don't match";
                                                }
                                                else if($_GET["error"] == "Wrong Input"){
                                                    echo "Incorrect Password";
                                                }
                                            }
                                            ?>
                                            </div>
                                            <button  type = "submit" name = "submit" id="submit">Change Password</button>
                                    </form>
                                </div>        
                                        
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                        <div class = "deleteProf" id = "deleteProf">
                            <form action ="includes/deleteProfile.php" method="post">
                            <input type="hidden" id="key" name="key" value="<?php echo "$pfUserId";?>" />    
                            <button type="submit" name="submit"  onclick="return confirm('Are you sure?')">Delete Account</button></form> 
                        </div>      
                    </div>
               
                </div>
              
            </div>                     
        </div>                        
    </div>   
</div>

</body>
</html>


    