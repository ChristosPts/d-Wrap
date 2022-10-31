    <?php        
        include_once 'global/header.php';
        require_once 'includes/dbh.inc.php';
    ?>
        
    <script>
        var timeleft = 5;
            var downloadTimer = setInterval(function(){
            if(timeleft < 0){
                window.location.href='index?page=1';
            } else {
                document.getElementById("countdown").innerHTML = "Redirecting in "+ timeleft + " seconds...";
            }
            timeleft -= 1;
            }, 1000);
    </script>
     <title>Verify</title>
</head> 
     
<body class = "bgBody">
<div id="wrapper">     
    <div class = "container-flex">
        <div class = "row d-flex justify-content-center mx-auto text-center">        
            <div class="col-md-12 my-5 homeRedir">
                <?php if(isset($_GET['vkey'])){
                $vkey = $_GET['vkey'];
                $result = mysqli_query($conn,"SELECT Verified FROM users WHERE verified = '0' AND vkey = '$vkey' limit 1");
                //validate email
                if(mysqli_num_rows($result) ==1){
                    $updateVer = mysqli_query($conn,"UPDATE users SET verified = '1' WHERE vkey = '$vkey' limit 1");
                    echo '<h2>Account verification successfull</h2><br>';
                    echo '<img src="uploads\site\undraw_mail_sent_re_0ofv.svg">';
                } else {
                    echo '<h2>This account does not exist or has already been verified</h2><br>';
                    echo '<img src="uploads\site\undraw_not_found_re_44w9.svg">';
                    }
                }
                else{ die("Something went wrong");  } ?> 
            </div> 
            <h2 id = "countdown"></h2>
        </div>
    </div>
    </div>             
  </body>
</html>        