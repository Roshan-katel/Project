<?php
$host="localhost";
$user="root";
$pass="";
$db="swday";
$conn=mysqli_connect($host,$user,$pass,$db);
if(!$conn){
    echo die('database is not connected');
}
?>