<?php

session_start();
if($_SERVER['HTTP_HOST']=="localhost"){
    $connection=mysqli_connect("localhost","root","","srinath_cms");
}
else{
    $connection=mysqli_connect("localhost","phpmyadmin","raja@#","srinath_cms");
}

?>
