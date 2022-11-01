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
    <title>404</title>
</head> 

<body class = "bgBody">
<div id="wrapper">  
    <div class = "container-flex">
        <div class = "row d-flex justify-content-center mx-auto text-center errorBodyBox">         
            <div class="col-md-12 my-5 ">
                <h2>404 Page Not Found</h2>
                <h2 id = "countdown"></h2>
            </div>	
        </div>
    </div>

</div>
</body>
</html>
