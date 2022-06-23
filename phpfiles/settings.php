<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <Title>Forum - Settings</Title>
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
        echo"<div class='intro'>
                <div class='left'>Jesteś zalogowany jako:  <b>".$_SESSION['username']."</b> </div> 
                <div class='right'>
                    <a href='index.php'>Wróć na stronę główną &nbsp; &nbsp;</a> 
                    <a href='logout_parse.php'>Wyloguj &nbsp; &nbsp; </a>
                    <a href='settings.php'>Ustawienia</a>
                </div>
             </div>
";

    }
    ?>

    <hr/>
    <div class="content">

        <p style='color: white; font-size: 22px;'>Ustawienia</p>

      <div style="display: flex; justify-content: center; color: white;"> <form action="change_name.php" method="post">
           Login: <input type="text" name="username" placeholder="<?php echo $_SESSION['username'];?>">
            <input type="submit" name="name_button" value="Edytuj">
          </form></div>

        <div style="display: flex; justify-content: center; color: white; margin-top: 5px;">
        <form action="change_password.php" method="post">
            Hasło: <input type="password" name="password" >
            <input type="submit" name="password_button" value="Edytuj">
        </form>
        </div>

        <div style="display: flex; justify-content: center; color: white; margin-top: 10px;">
        <form action="delete_account.php" method="post">
            <input type="submit" name="delete_account" value="Usuń konto">
        </form>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
        crossorigin="anonymous"></script>
</body>

</html>
