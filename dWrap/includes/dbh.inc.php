<?php

$serverName = "localhost";
$dbUserame = "root";
$dbPassword = "";
$dbName = "dwrapdb";

$conn = mysqli_connect($serverName,$dbUserame,$dbPassword,$dbName);

if (!$conn){
    die("Connection failed: " .mysqli_connect_error());
}