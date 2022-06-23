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

    <p style="color: white">Panel rejestracji</p>

    <div class="top"></div>

    <?php
    if(isset($_SESSION['uid'])){
        echo"<div class='intro'>
                <div class='left'>Jesteś zalogowany jako:  <b>".$_SESSION['username']."</b> </div> 
                <div class='right'> <a href='logout_parse.php'>Wyloguj &nbsp; &nbsp; </a>
                <a href='settings.php'>Ustawienia</a></div>
             </div>
";
    }
    ?>

    <hr/>
    <div class="content">
<?php
if(!isset($_SESSION['uid'])){
    echo"<form action='register_parse.php' method='post'>

         <div style='display: flex; justify-content: center;'>
            <input type='text' name='username' placeholder='Login' class='form-control' aria-label='Username' aria-describedby='basic-addon1'>
         </div>
         
         <div style='display: flex; justify-content: center; margin-top: 5px;'>
            <input type='password' name='password' placeholder='Hasło' class='form-control' aria-label='Username' aria-describedby='basic-addon1'>
         </div>
         
         <div style='display: flex; justify-content: center; margin-top: 8px;'>
            <input type='submit' name='register_user' value='Zarejestruj się' class='btn btn-light'>
         </div>


</form>";
}


?>
        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php" style="color: white;  margin-top: 50px; text-decoration: none; font-size: 22px;">Kliknij, by wrócić na stronę główną</a>
        </div>
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
