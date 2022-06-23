<?php session_start(); ?>
<?php
if((!isset($_SESSION['uid'])) || ($_GET['cid'] == "") ) {
    header("Location: index.php");
    exit();
}
$cid = $_GET['cid'];
$tid = $_GET['tid'];
?>

<!DOCTYPE html>
<html>
<head>
    <Title>Post Reply</Title>
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
                    <a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Wróć do pytania &nbsp; &nbsp;</a> 
                    <a href='logout_parse.php'>Wyloguj &nbsp; &nbsp; </a>
                    <a href='settings.php'>Ustawienia</a>
                </div>
             </div>
";
    ?>

    <hr/>
    <div class="content">
        <form action="post_reply_parse.php" method="post">
            <p style="color: white; font-size: 22px;">Odpowiedz na komentarz</p>
            <div style="margin-top: 20px; display: flex; justify-content: center;"><textarea  name="reply_content" rows="5" cols="75"></textarea></div>

            <input type="hidden" name="cid" value="<?php echo $cid;?>"/>
            <input type="hidden" name="tid" value="<?php echo $tid; ?>"/>
           <div style="margin-top: 15px; display: flex; justify-content: center;"> <input type="submit" name="reply_submit" value="Post your reply" class="btn btn-light"/>
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


