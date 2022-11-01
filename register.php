<?php
    include_once 'global/header.php'
?>

<script>
        var theImages = [
        "uploads/site/undraw_before_dawn_re_hp4m.svg",
        "uploads/site/undraw_image_viewer_re_7ejc.svg",   
        "uploads/site/undraw_upload_image_re_svxx.svg"];
       
        function changeImage(){
            var size=theImages.length;
            var x = Math.floor(size*Math.random())
            document.getElementById("logInimg").src = theImages[x];
        }
        onload=changeImage
    </script>
    
    <title>Register</title>
</head> 

<body class ="bgBody">
<div id="wrapper">      
    <div class = "row">
    <?php include_once 'global/navbar.php';
          if(isset($_SESSION['userid'])){ 
            header("location: index?page=1");
            exit();
        } ?>
    </div>

    <div class="logRegForm">
   
        <div class = "container">
             <div class = "row d-flex justify-content-center mx-auto text-center">      
             <h2 class = "fs-2 fw-bold">Create an account</h2>
             <div class = "thumbs"><img id="logInimg"></div>

                <form action = "includes/register.php" method="post">                    
                <div class="form-group">
                        <span class = "input-icon"><i class="bi bi-person-circle"></i></span>
                        <input type = "text" name = "Username" placeholder = "Username">
                    </div>    
                    <div class="form-group"> 
                        <span class = "input-icon"><i class="bi bi-envelope"></i></span>    
                        <input type = "text" name = "Email" placeholder = "Email">
                    </div> 
                    <div class="form-group"> 
                        <span class = "input-icon"><i class="bi bi-lock"></i></span>
                        <input type ="password" name = "pass" placeholder = "Password">
                    </div>  
                    <div class="form-group"> 
                        <span class = "input-icon"><i class="bi bi-lock-fill"></i></span>
                        <input type ="password" name = "passconf" placeholder = "Confirm Password">
                    </div>
                    <div class="form-box">   
                        <input class="form-check-input" type="checkbox" name = "cBox">
                        <label class="form-check-label" for="flexCheckDefault">
                        I agree to the <a href="about.php"> terms of service </a>
                        </label>
                    </div>
                    <div class="errormsg">
                        <?php if(isset($_GET["error"])){
                                if($_GET["error"] == "Empty Input"){
                                    echo "Please fill in all fields";
                                }
                                else if($_GET["error"] == "Invalid Username"){
                                    echo "Please choose a proper username, use only letters and numbers";
                                }
                                else if($_GET["error"] == "Invalid Email"){
                                    echo "Invalid Email address";
                                }
                                else if($_GET["error"] == "Passwords dont match"){
                                    echo "Passwords do not match";
                                }
                                else if($_GET["error"] == "user Exists"){
                                    echo "This username already exists. Please try again";
                                }
                                else if($_GET["error"] == "errorOcc"){
                                    echo "An error has occured. Please try again";
                                }
                                else if($_GET["error"] == "ToS"){
                                    echo "Please agree to the Terms and Conditions";
                                }
                                else if($_GET["error"] == "UserMail"){
                                    echo "The username or email address is already in use";
                                }
                                else if($_GET["error"] == "fewChars"){
                                    echo "Please use a passowrd with atleast 8 characters,  
                                    include at least one upper case letter, one number, and one special character";
                                }
                            }?>
                            
                    </div>
                    <button  type = "submit" name = "submit" id="submit">Register</button>
                </form>

                <div>
                    <p>Already have an account? <a href=login>Log in</a><P=/p>
                </div>

            </div>	
        </div>
    </div>
</div>
</body>
</html>


