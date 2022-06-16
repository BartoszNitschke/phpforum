<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <Title>Forum</Title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
          crossorigin="anonymous">
    <link rel="stylesheet"  href="style.css"/>



</head>
<body>

<div class="wrapper">
    <div class="top"></div>
    <h1 class="title">Forum internetowe</h1>
    <p style="color: white">Dyskutuj na każdy temat!</p>
    <div class="top"></div>
    <?php
    if(!isset($_SESSION['uid'])){
        echo"<form action='login_parse.php' method='post'>
       <div style='margin-top: 15px;'><div class='login'>  
       <input type='text' class='form-control' placeholder='Login' aria-label='Username' aria-describedby='basic-addon1' name='username' style='margin-left:5px; ;'>
        <input type='password' class='form-control' placeholder='Hasło' aria-label='Username' aria-describedby='basic-addon1' name='password' style='margin-left: 10px;'>
        <input type='submit' name='submit' value='Zaloguj' class='btn btn-light' style='margin-left: 10px;'></div></form>
        
       
";
        echo"<form action='redirection.php'><input type='submit' name='register' value='Zarejestruj się' class='btn btn-light' style='margin-left: 1130px;'></form>";


    }else{
        echo"<div class='intro'><div class='left'>Jesteś zalogowany jako:  <b>".$_SESSION['username']."</b> </div> <div class='right'> <a href='logout_parse.php'>Wyloguj &nbsp; &nbsp; </a>
         <a href='settings.php'>Ustawienia</a></div></div>
";
    }
    ?>

</div>
   <hr/>
    <div class="content">
        <?php
        include_once ("connection.php");
        $sql = "SELECT * FROM categories ORDER BY category_title ASC";
        $res = mysqli_query($link, $sql) or die(mysqli_error());
        $categories = "";

        if( mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $title = $row['category_title'];
                $desc = $row['category_description'];
                $categories .="<a href='view_category.php?cid=".$id."' class='category'>".$title. " - ".$desc."</a>";

            }
            echo $categories;
        }else{
            echo "<p>Aktualnie nie ma kategorii do wyświetlenia, spróbuj ponownie później!</p> ";
        }
        ?>
<hr/>
    </div>

<div class="footer">
Forum internetowe &copy; 2022

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
        crossorigin="anonymous"></script>
</body>

</html>
