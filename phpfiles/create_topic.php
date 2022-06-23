<?php session_start(); ?>
<?php
if((!isset($_SESSION['uid'])) || ($_GET['cid'] == "") ) {
    header("Location: index.php");
    exit();
}
$cid = $_GET['cid'];
?>

<!DOCTYPE html>
<html>
<head>
    <Title>Create Forum Topic</Title>
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
    echo"<div class='intro'>
                <div class='left'>Jesteś zalogowany jako:  <b>".$_SESSION['username']."</b> </div> 
                <div class='right'>
                    <a href='index.php'>Wróć na stronę główną &nbsp; &nbsp;</a> 
                    <a href='logout_parse.php'>Wyloguj &nbsp; &nbsp; </a>
                    <a href='settings.php'>Ustawienia</a>
                </div>
             </div>
";
    ?>

    <hr/>
    <div class="content">
        <p style='color: white; font-size: 22px;'>Temat pytania</p>

      <form action="create_topic_parse.php" method="post">

          <div style="justify-content: center; display: flex; margin-top: 10px;"><input type="text" name="topic_title" size="98" maxlength="150"></div>
          <p style='color: white; font-size: 22px; margin-top: 10px;'>Treść pytania</p>
          <div style="justify-content: center; display: flex; margin-top: 10px;"><textarea name="topic_content" rows="5" cols="75"></textarea></div>
          <br/><br/>
          <input type="hidden" name="cid" value="<?php echo $cid;?>">
          <div style="display: flex; justify-content: center;"><input class="btn btn-light" type="submit" name="topic_submit" value="Zadaj pytanie"></div>
      </form>

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

