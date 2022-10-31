<div class="ContainerNav">
    <nav class = "navbar shadow  navbar-expand-sm  bg"  id ="navbarId">
        <div class="logo"><a class="navbar-brand fs-1 ms-4 fw-bolder" href='index?page=1'>dWrap</a></div>
        <button 
        class="navbar-toggler  me-4" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#toggleMenu"
        aria-controls = "mavbarMav"
        aria-expanded = "false"
        aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="toggleMenu">
            <ul class = "navbar-nav ms-auto text-center">
                <li><a href="about" class = "nav-link fs-4 mx-4">About</a></li>
           
            <?php
                if(isset($_SESSION["userid"])){ 
                    $id = $_SESSION["userid"];
                    $usern = $_SESSION["username"];
                    echo '<li><a href="profile?user='.$usern.'&page=1" class = "nav-link mx-4 fs-4">Profile</a></li>';
                    echo '<li><a href="includes/logout.inc.php" class = "nav-link mx-4 fs-4">Log out</a></li>';
                }
                else{
                    echo '<li><a href="login" class = "nav-link mx-4 fs-4">Login</a></li>';
                    echo '<li><a href="register" class = "nav-link mx-4 fs-4">Register</a> </li>';
                }  
            ?>
            </ul>
        </div>
 
           
       
    </nav> 
</div>      