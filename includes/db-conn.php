<?php 

$conn = mysqli_connect("localhost", "root", "", "lost-and-found-system", "3306");

if(!$conn){
    die ("Connection Failed");
}  
echo "Connection Successful";