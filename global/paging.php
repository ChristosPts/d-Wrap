<?php   
    $numRows = mysqli_num_rows($select);
    $totalPages = ceil($numRows/$limit);

    echo '<a href=index?page=1&sorting='.$sorting.'&orderAD='.$ordering.'&category='.$categoryId.'><<</a>';   
    $prev = $page-1;
    if($prev>=1){
        echo "<a href=?page=".$prev."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><</a>"; 
    } else{
        echo "<a><</a>"; 
    }

    /*for($x = 1; $x<= $totalPages; $x++){
       echo "<a href=?page=".$x."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId.">".$x."</a>";
    }*/
    
    if($page == 1){
        echo "<a class=activePage href=?page=1&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>1</button></a>";
        if($totalPages > 2 ){
            echo "<a href=?page=2&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>2</button></a>";
            echo "<a href=?page=3&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>3</button></a>";
        }
        else if($totalPages == 2){
            echo "<a href=?page=2&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>2</button></a>";
        }
        else echo "";
    }

    if($page > 1 && $page < $totalPages){
        $x = $page - 1;
        $z = $page + 1;  
         echo "<a href=?page=".$x."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>".$x."</button></a>";
         echo "<a class=activePage href=?page=".$page."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>".$page."</button></a>";
         echo "<a href=?page=".$z."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>".$z."</button></a>";
    }
    
    if($page == $totalPages && $totalPages >2){
        $t2 = $totalPages - 2;
        $t1 = $totalPages - 1;
        echo "<a href=?page=".$t2."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>".$t2."</button></a>";
        echo "<a href=?page=".$t1."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>".$t1."</button></a>";
        echo "<a class=activePage href=?page=".$totalPages."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId."><button>".$totalPages."</button></a>";
    }

    $next = $page+1;
    if($next<=$totalPages){
        echo "<a href=?page=".$next."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId.">></a>"; 
    } else{
        echo "<a>></a>"; 
    }          
    $y = ceil($totalPages);
    echo "<a href=?page=".$y."&sorting=".$sorting."&orderAD=".$ordering."&category=".$categoryId.">>></a>";     