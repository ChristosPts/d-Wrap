    <?php
        include_once 'global/header.php';
        require_once 'includes/dbh.inc.php';
    ?>

    <title>Home</title>
</head> 
     
<body class = "bgBody">
<div id="wrapper">  
   
    <div class = "row">
         <?php include_once 'global/navbar.php';  ?>  
     </div>
              
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 py-2 searchBar justify-content-center text-center">
                            <?php include_once 'front/searchOptions.php';?>
                        </div>
                    </div>

                    <div class="row mx-4 d-flex justify-content-center text-center">
                        <div class="col-md-12 mt-3 py-4 wrapper-gallery">
                            <div>
                                <?php include_once 'func/galleryIndex.php';?>
                            </div>    
                            <div class = "pagination d-flex justify-content-center text-center">
                                <div class="pageBorder"> <?php include_once 'global/paging.php';?> </div>
                            </div>    
                        </div> 
                    </div>
                </div>
                 
            </div>
        </div>
</div>
   </body>
</html> 
 
     
                      
         