<?php
$host ="localhost";
$username = "root";
$password = "";
$db = "forum";

$link =  mysqli_connect($host,$username,$password, $db) or die(mysqli_error());
?>