<?php
if(isset($_POST["submit"])){
    session_start();
    require_once '..\includes\dbh.inc.php';
    
    $sorter = $_POST["sortOption"];
    $order = $_POST["orderer"];
    $catOp = $_POST["catOption"];
    
    
    if($catOp=='...'){
        $catOpSet = ''; 
    }
    else {
    $select = mysqli_query($conn,"SELECT * FROM categories WHERE catNames = '$catOp'");
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
        $categoryId = $fetch['catId'];
        $catOpSet = "&category=".$categoryId."";
        }           
    }

   
   if($order == "asc"){
          $orderSet = 'asc';
    }
    else if($order == "desc"){
        $orderSet = 'desc';
    }
    else if($order == "..."){
        $orderSet = 'desc';
   } else if($order == ""){
     $orderSet = 'desc';
   }
    
    if ($sorter == "Likes"){
        $resultSet = 'likes';
        header("location: ../index?page=1&sorting=".$resultSet."&orderAD=".$orderSet."".$catOpSet."");
        exit(); 
    }
    if($sorter == "Random"){
        $resultSet = 'RAND()';
        header("location: ../index?page=1&sorting=".$resultSet."&orderAD=".$orderSet."".$catOpSet."");
        exit(); 
    }  
    if($sorter == "Age"){
        $resultSet = 'uploadDate';
        header("location: ../index?page=1&sorting=".$resultSet."&orderAD=".$orderSet."".$catOpSet."");
        exit(); 
    }  
    
    if($sorter == "Views"){
        $resultSet = 'views';
        header("location: ../index?page=1&sorting=".$resultSet."&orderAD=".$orderSet."".$catOpSet."");
        exit(); 
    }  

    if ($sorter == "..."){
        $resultSet = 'uploadDate';
        header("location: ../index?page=1&sorting=".$resultSet."&orderAD=".$orderSet."".$catOpSet."");
        exit(); 
    }

    if ($sorter == ""){
        $resultSet = 'uploadDate';
        header("location: ../index?page=1&sorting=".$resultSet."&orderAD=".$orderSet."".$catOpSet."");
        exit(); 
    }
 
}
else{
    header("location: ../index?page=1&error");
    exit(); 
}