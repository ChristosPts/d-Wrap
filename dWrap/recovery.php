    <?php
        include_once 'global/header.php'
    ?>

    <title>Forgot Password</title>
</head> 

 
<body class = bgBody>
<div id="wrapper">     
    <?php include_once 'global/navbar.php'; 
    include_once 'global/navbar.php';
        if(isset($_SESSION['userid'])){ 
                header("location: index?page=1");
                exit();
        }
        ?>

    <div class = "pwdRec">        
        <div class = "container">  
        <div class = "row d-flex justify-content-center row mx-auto text-center">    
            <form action = "includes/PassResetReq.php" method="post">
            <h2 class = "fs-2 fw-bold">Account Recovery</h2>    
            <div class="rounded mx-auto d-block "><img src="uploads/site/Thinking_Two Color.svg"></div>
                  
                <div class="form-group">
                    <span class = "input-icon"><i class="bi bi-envelope"></i></span>    
                    <input type = "text" name = "email" placeholder = "Email address"> <br>
                      
                <div>
                    <?php   
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "Empty Input"){
                                echo "Please enter your email address";
                            }
                            else if($_GET["error"] == "InvalidForm"){
                                echo "Incorrect email form";
                            }
                            else if($_GET["error"] == "wrongEmail"){
                                echo "Incorrect email form";
                            }
                            else if($_GET["error"] == "error"){
                                echo "An error has occured. Please try again";
                            }
                        }
                    ?>
                </div>
                </div>
              
                    <button class="btn login"type = "submit" name = "submit">Send Recovery Key</button>
            </form>
            </div>
         </div>
   </div>     
        


                        
   
</div>
</body>             
</html>
 