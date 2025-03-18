<?php 
session_start();
if($_SESSION['usertype']!="ADMINISTRATOR"){
    header("location: index.php");
}
if(!isset($_SESSION['username'])){
     header("location: index.php");
}
?>