    <?php  include_once 'global/header.php'  ?>
    
    <script>
        var theImages = [
        "uploads/site/undraw_female_avatar_re_kbxm.svg",
        "uploads/site/undraw_male_avatar_re_8fid.svg",
        "uploads/site/undraw_pic_profile_re_1865.svg",
        "uploads/site/undraw_profile_pic_re_upir.svg"];

        function changeImage(){
            var size=theImages.length;
            var x = Math.floor(size*Math.random());
            document.getElementById("logInimg").src= theImages[x];          
        }
        onload=changeImage

    </script>
    
    <title>Login</title>
</head> 

<body class = "bgBody">
<div id="wrapper">    
    <div class = "row">
        <?php
            include_once 'global/navbar.php';
            if(isset($_SESSION['userid'])){ 
                    header("location: index?page=1");
                    exit();
            } ?>
   </div>

    <div class = "logRegForm">        
         <div class = "container">
            <div class = "row d-flex justify-content-center mx-auto text-center">      
                    <form action = "includes/login.inc.php" method="post">
                    <h2 class = "fs-2 fw-bold">Welcome Back!</h2>
                        <div class="ChangeForm form_icon"><img id="logInimg"></div>
                        <h4>Sign into your account</h4>
                            <div class="form-group">
                                 <span class = "input-icon"><i class="bi bi-person-circle"></i></span>
                                 <input type = "text" name = "username" placeholder = "Username/Email"> 
                            </div>
                            <div class="form-group">
                                 <span class = "input-icon"><i class="bi bi-lock"></i></span>
                                 <input type ="password" name = "pass" placeholder = "Password">
                            </div>
                            <div>
                            <?php  
                            if(isset($_GET["error"])){
                                if($_GET["error"] == "Empty Input"){
                                    echo "Empty User or Password field";
                                }
                                else if($_GET["error"] == "Wrong Input"){
                                    echo "Incorrect User or Password";
                                }
                            } ?>
                           
                            </div>
                         <button class="btn login" type = "submit" name = "submit" id="submit">Log in</button>
                    </form> 
                 
                <ul>
                    <a href=recovery>Forgot your password?</a>
                    <p>Dont have an account? <a href=register>Register here</a></p>
                </ul>
                
            </div>
        </div>
    </div>
</div>    
</body>
</html>

