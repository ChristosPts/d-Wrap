<?php
  session_start();
  require_once 'dbh.inc.php';
  $imgP = $_GET['imgPath'];
  $id = $_SESSION["userid"];

  $results = mysqli_query($conn,"SELECT * FROM images WHERE imgPath = '$imgP'");
        while ($row = mysqli_fetch_assoc($results)){
        $postid = $row['imgId'];
    }   

if (isset($_POST['liked'])) {
  
    $result = mysqli_query($conn, "SELECT * FROM images WHERE imgId=$postid");
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];
    mysqli_query($conn, "INSERT INTO likes (userId, imgId) VALUES ($id, $postid)");
    mysqli_query($conn, "UPDATE images SET likes=$n+1 WHERE imgId=$postid");
    $URL="../view?imgPath=".$imgP."";
    header('location:'.$URL.'');
    exit();
}

if (isset($_POST['unliked'])) {
    
    $result = mysqli_query($conn, "SELECT * FROM images WHERE imgId=$postid");
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];

    mysqli_query($conn, "DELETE FROM likes WHERE imgId=$postid AND userId=$id");
    mysqli_query($conn, "UPDATE images SET likes=$n-1 WHERE imgId=$postid");
    $URL="../view?imgPath=".$imgP."";
    header('location:'.$URL.'');
    exit();
}