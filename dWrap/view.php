<?php
        include_once 'global/header.php';
        require_once 'includes/dbh.inc.php';  
    ?>
    <script>
        function fullImg(element) {
                var newTab = window.open();
                setTimeout(function() {
                    newTab.document.body.innerHTML = element.innerHTML;
                }, 500);
                return false;
            }
    </script>

    <title>View</title>
</head> 

<body class="bgBody">
<div id="wrapper">   
    <div class = "row">
        <?php
            include_once 'global/navbar.php';
            $id = $_SESSION['userid'] ?? null;
            $imgPath = $_GET['imgPath'];
            $uType = $_SESSION["usType"] ?? null;

            if ($imgPath == null){
                header("location: index?page=1");
                exit();
            }

            //Find the id of the user that uploaded the picture
            $select = mysqli_query($conn,"SELECT * FROM images WHERE imgPath = '$imgPath'");
            if(mysqli_num_rows($select) > 0){
                $fetch = mysqli_fetch_assoc($select);  
                $imgUid =  $fetch['usersId'];
                $likesCount = $fetch['likes'];
                //Use to see if an image has been liked
                $imgId = $fetch['imgId'];
            }  else {
                header("location: index?page=1");
                exit();
            }

             //increase views
             mysqli_query($conn,"UPDATE images SET views = views+1 WHERE imgPath = '$imgPath'");
             $getImgViews = mysqli_query($conn, "SELECT * FROM images  WHERE imgPath = '$imgPath'");
             if(mysqli_num_rows($getImgViews) > 0){
                 $fetchViews = mysqli_fetch_assoc($getImgViews);  
                 $imgViews =  $fetchViews['views'];
             } 
        ?>
    </div>
        
    <div class="container-flex viewForm">
        <div class="row d-flex justify-content-center mx-auto text-center">


            <div class="col-md-2 profileCont ">
                <div class="row ">
                    <div class="col-md-12">
                    <div class = "backBtn"> <button onclick="history.back()">Back</button></div> <hr>
                    <div class = "uploader"> <h3>Uploader</h3>
                        <?php 
                        // using the id found in the images table find the name and id of the user from the users table
                            $select = mysqli_query($conn,"SELECT * FROM users WHERE usersId = '$imgUid'");
                            if(mysqli_num_rows($select) > 0){
                                $fetch = mysqli_fetch_assoc($select);
                                $Uid =  $fetch['usersId'];
                                $Uname =  $fetch['usersUsername'];
                                $pfImg = $fetch['profileImg'];   
                            } else{
                                $Uname = 'Deleted User';
                                $pfImg = "default.jpg";
                                $Uid = '';
                            }
                            if(!$pfImg == ''){
                                echo '<img src="uploads/profiles/'.$pfImg.'"><br>';
                            } else {
                                echo '<img src = "uploads/profiles/default.jpg"><br>';
                            }
                            //if logged in you are allowed to check another users profile
                            if(isset($_SESSION["userid"]) && $Uname != 'Deleted User'){ 
                                echo '<a href ="profile.php?user='.$Uname.'&page=1">'.$Uname.'</a>';
                            }  else echo $Uname;
                        ?> 
                            </div><hr>

                            <div>Views: <?php echo $imgViews ?></div>  
                            <div>Likes: <?php echo $likesCount ?>
                            <div class = "likeBtn" >
                                <?php  
                                    if(isset($_SESSION['userid'])){             
                                        //check if user has liked the image and change button if liked or not
                                        $result = mysqli_query($conn,"SELECT * FROM likes WHERE userid=$id AND imgId=$imgId");
                                        if (mysqli_num_rows($result) == 1 ){
                                            echo '<form action ="includes/likes.php?imgPath='.$imgPath.'" method="POST" enctype="multipart/form-data">
                                                <button type="unliked" name="unliked"><i class="bi bi-hand-thumbs-up-fill fa-2x"></i></button>
                                                </form>';
                                        } else {
                                        //like button
                                            echo '<form action ="includes/likes.php?imgPath='.$imgPath.'" method="POST" enctype="multipart/form-data">
                                            <button type="liked" name="liked"><i class="bi bi-hand-thumbs-up fa-2x"></i></button>
                                            </form>';
                                        }
                                    }     
                                ?></div></div> <hr>
                            
                            <div class = "downBtn"><a href = "uploads/pics/<?php echo $imgPath ?>" download><button ><i class="bi bi-download"></i>  DOWNLOAD</button></a></div>  
                            
                            
                          <hr>
                        <div class = "reportForm">
                            <?php
                                    if(isset($_SESSION['userid'])){ 
                                        //report image
                                        if($uType == 'User' && $id != $Uid){
                                            echo '<form action="includes/report.php?imgPath='.$imgPath.'" method="POST" >
                                            <select name="report">
                                                <option value="">Report</option>
                                                <option value="Sexual">Obscene</option>
                                                <option value="Violence">Violence</option>
                                                <option value="Hatefull">Hatefull</option>
                                                <option value="Duplicate">Duplicate</option>
                                                <option value="Spam">Spam</option>
                                            </select> <br>
                                                <button type="submit" name="submit">Report</button>
                                            </form>';
                                        }
                                    }   
                                ?> 
                        </div>
                        <div class = "vDelBtn">
                            <?php
                            //use the variables created from the profileCont div to show or hide delete button
                            //admins are also alowed to delete imgs
                            if(isset($_SESSION['userid'])){ 
                                $uType = $_SESSION["usType"];
                                    if($Uid == $id || $uType == 'Admin'){
                                    echo 
                                    '<form action ="includes/deleteImg.php?imgPath='.$imgPath.'&imgUid='.$Uid.'&userName='.$Uname.'" method="POST">
                                    <button type="submit" name="submit" title="Remove Image">Delete Image</button>
                                    </form>';
                                }  
                            } ?>
                        </div>                 


                    </div>
                </div>
            </div>


            <div class="col-md-10 ">
                <div class="row picDisplay justify-content-center mx-auto text-center">
                    <div class="col-md-12">
                        <a target="_blank" href="uploads/pics/<?php echo $imgPath ?>"> 
                           <img src="uploads/pics/<?php echo $imgPath ?>">  
                        </a> 
                    </div>
                </div>
            </div>
             

        </div>
    </div>

</div>
</body>
    <?php
        include_once 'global/navbar.php'
    ?>
    