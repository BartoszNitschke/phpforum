<?php
session_start();
include_once ("connection.php");

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = " SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
    $res = mysqli_query($link,$sql);

    if(mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['uid'] = $row['id'];
        $_SESSION['username'] =  $row['username'];
        $_SESSION['role'] = $row['role'];
        header("Location: index.php");
        exit();
    }else{
        echo "Niepoprawny login lub hasło, powróć do strony głównej i spróbuj ponownie";
        exit();
    }
}
