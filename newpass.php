<?php include_once 'global/header.php'  ?>
        
   
    <title>Reset Password</title>
</head>

<body class = bgBody>
<div id="wrapper">  
    <?php 
        if(isset($_SESSION['userid'])){ 
            header("location: index?page=1");
            exit();
        }
        include_once 'global/navbar.php';
    ?>

    <div class = "pwdRes">        
        <div class = "container">  
        <?php
            $selector = $_GET["selector"] ?? null;
            $validator = $_GET["validator"] ?? null;
        
                if(empty($selector) || empty($validator)){
                    echo '<div class = "row d-flex justify-content-center row mx-auto text-center">';  
                    echo '<div class="rounded mx-auto d-block "><img src="uploads/site/undraw_warning_re_eoyh.svg"></div>';
                    echo "Request could not be validated";
                    echo '</div>';
                } else {
                    if(ctype_xdigit($selector) !== false && ctype_xdigit($validator)  !== false){?>
                        <form action = "includes/PassReset.php" method="POST">
                        <div class = "row d-flex justify-content-center row mx-auto text-center">    
                        <h2 class = "fs-2 fw-bold">Reset Password</h2>      
                        <div class="rounded mx-auto d-block "><img src="uploads/site/Password_Monochromatic.svg"></div>
                             <?php  echo '<input type ="hidden" name = "selector" value = "'.$selector.'">'; ?>
                              <?php echo '<input type ="hidden" name = "validator" value = "'.$validator.'">'; ?>
                            <div class="form-group">
                                <span class = "input-icon"><i class="bi bi-lock"></i></span>
                                <?php echo '<input type ="password" name = "pass" placeholder = "New Password">';?>
                            </div>
                            <div class="form-group">
                                <span class = "input-icon"><i class="bi bi-lock-fill"></i></span>
                                <?php echo '<input type ="password" name = "passConf" placeholder = "Confirm New Password">'; ?>
                            </div>
                            <div>
                          
                            <?php   
                                if(isset($_GET["error"])){
                                    if($_GET["error"] == "EmptyField"){
                                    echo "Please fill in both fields"; 
                                    }
                                    else if($_GET["error"] == "PasswordsDontMatch"){
                                        echo "Passwords do not match";
                                    }
                                    else if($_GET["error"] == "error"){
                                        echo "An error has occured. Please try again";
                                    }   else if($_GET["error"] == "fewChars"){
                                        echo "Please use a passowrd with atleast 8 characters,  
                                        include at least one upper case letter, one number, and one special character";
                                    }
                                }  ?> 
                            
                            </div>  
                            <button class = "py-2"  type = "submit" name = "submit" id="submit">Reset Password</button> 
                        </form>
                    <?php  }   
                }?>
        </div>
    </div>   
</div>  
</body>
</html>