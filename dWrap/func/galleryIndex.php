<?php          
    $limit = 30;
    //check for set page
    isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
    
    //check if page is a number if its not the assign the value 0
    if(!is_numeric($page) || $page < 0){
        $page = 1;
    }
    //check for pg1
    if($page>1){
        $start = ($page*$limit) - $limit;
    }else {
        $start = 0;
    } 
    
    // Fetches the value of $_GET['user'] and returns given value ex 'uploadDate desc' 
    //if it does not exist.
    
    $sorting = $_GET['sorting'] ?? 'uploadDate';
    $ordering = $_GET['orderAD'] ?? 'desc';
    $categoryId = $_GET['category'] ?? null;  

    if($ordering != "asc" && $ordering != "desc"){
        $ordering = 'desc';
    }
    if($sorting != "likes" && $sorting != "RAND()" && $sorting != "uploadDate" && $sorting != "views"){
        $sorting = "uploadDate";
       
    }  
           
    if(is_null($categoryId) ){
        $sort = mysqli_query($conn,"SELECT * FROM images order by $sorting $ordering LIMIT $start,$limit");
        $select = mysqli_query($conn,"SELECT * FROM images order by $sorting $ordering");
    }
    else if(!is_numeric($categoryId = $_GET['category'])){
        $sort = mysqli_query($conn,"SELECT * FROM images order by $sorting $ordering LIMIT $start,$limit");
        $select = mysqli_query($conn,"SELECT * FROM images order by $sorting $ordering"); 
    }

    else if($categoryId!==null){      
        $sort = mysqli_query($conn,"SELECT * FROM images WHERE imgId IN 
        (SELECT imgId FROM img_categories where catId = $categoryId) 
        ORDER BY $sorting $ordering LIMIT $start,$limit");      
        
        $select =  mysqli_query($conn,"SELECT * FROM images WHERE imgId IN 
         (SELECT imgId FROM img_categories where catId = $categoryId) 
         ORDER BY $sorting $ordering");  
        
    }   

    if(mysqli_num_rows($sort) <= 0){
        echo '<div class="emptyMsg">No images found</div>';
    } else {         
    while ($row = mysqli_fetch_assoc($sort)){
        $imgp = $row['imgPath'];
        echo 
        '<div class = "galImgs">
            <a href = "view?imgPath='. $imgp.'"> <img class="img-responsive" src=" uploads/pics/'. $imgp.'"></a> 
        </div>';
        }  
    }

 