<?php session_start();

?>
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
    $cid = $_GET['cid'];
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
                    <a href='view_category.php?cid=".$cid."'>Wróć do kategorii &nbsp; &nbsp;</a> 
                    <a href='logout_parse.php'>Wyloguj &nbsp; &nbsp; </a>
                    <a href='settings.php'>Ustawienia</a>
                </div>
             </div>
";
    }
    ?>

    <hr/>
    <div class="content">
       <?php
       $tid="";
       include_once ("connection.php");
       $cid = $_GET['cid'];
       $tid = $_GET['tid'];
       $sql = "SELECT * FROM topics WHERE category_id='".$cid."' AND id='".$tid."' LIMIT 1";
       $res = mysqli_query($link,$sql) or die(mysqli_error());
       if(isset($_SESSION['uid'])) {
           if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
               echo "<div style='padding-bottom: 10px;'><form action='delete_post.php' method='post'>
            <input type='hidden' name='top_id' value='" . $tid . "'>
            <input type='hidden' name='cat_id' value='" . $cid . "'>
            <input type='submit' name='delete' value='Usuń cały wątek' class='btn btn-light'></form></div>

";


           }
       }


       if(mysqli_num_rows($res) == 1){
           echo "<table width='100%'>";
           while($row = mysqli_fetch_assoc($res)){
               $sql2 = "SELECT * FROM posts WHERE category_id='".$cid."' AND topic_id='".$tid."'";
               $res2 = mysqli_query($link,$sql2) or die(mysqli_error());
               $i=1;
               while($row2 = mysqli_fetch_assoc($res2)){
                   echo "<tr><td valign='top' style='border: 1px solid #000000; background-color: #cccccc;'><div style='min-height: 125px;'><b>Temat: ".$row['topic_title']."</b><br/>
                   by <b>".$row2['post_creator']."</b> - ".$row2['post_date']."<hr/>".$row2['post_content']."</div></td></tr>
                   <tr><td colspan='2'>";
                   if(isset($_SESSION['uid'])) {
                       if ($_SESSION['role'] == 1) {
                           if ($i != 1) {
                               echo "<div style='display: flex;'><div style='padding-right: 10px;'><form action='delete_comment.php' method='post'>
                            <input type='hidden' name='top_id' value='" . $row2['topic_id'] . "'>
                            <input type='hidden' name='cat_id' value='" . $row2['category_id'] . "'>
                            <input type='hidden' name='post_id' value='" . $row2['id'] . "'>
                           <input type='submit' name='delete_comment_button' value='Usuń zawartość' class='btn btn-light'></div>

</form>";


                           }

                           echo "<form action='edit_topic.php' method='post'>
                            <input type='hidden' name='top_id' value='" . $row2['topic_id'] . "'>
                            <input type='hidden' name='cat_id' value='" . $row2['category_id'] . "'>
                            <input type='hidden' name='post_id' value='" . $row2['id'] . "'>
                            <input type='hidden' name='post_content' value='" . $row2['post_content'] . "'>
                           <input type='submit' name='edit_topic_button' value='Edytuj zawartość' class='btn btn-light'>

</form></div>";
                       }



                       if ($_SESSION['role'] == 2) {
                           if ($i != 1) {
                               echo "<form action='delete_comment.php' method='post'>
                            <input type='hidden' name='top_id' value='" . $row2['topic_id'] . "'>
                            <input type='hidden' name='cat_id' value='" . $row2['category_id'] . "'>
                            <input type='hidden' name='post_id' value='" . $row2['id'] . "'>
                           <input type='submit' name='delete_comment_button' value='Usuń zawartość' class='btn btn-light'>

</form>";


                           }
                       }

                       if ($_SESSION['role'] == 0 && $row2['post_creator'] == $_SESSION['username']) {


                           if ($i == 1) {
                               echo "<form action='delete_post.php' method='post'>
            <input type='hidden' name='top_id' value='" . $tid . "'>
            <input type='hidden' name='cat_id' value='" . $cid . "'>
            <input type='submit' name='delete' value='Usuń cały wątek' class='btn btn-light'></form>

";
                           } else {
                               echo "<form action='delete_comment.php' method='post'>
                            <input type='hidden' name='top_id' value='" . $row2['topic_id'] . "'>
                            <input type='hidden' name='cat_id' value='" . $row2['category_id'] . "'>
                            <input type='hidden' name='post_id' value='" . $row2['id'] . "'>
                           <input type='submit' name='delete_comment_button' value='Usuń zawartość' class='btn btn-light'>

</form>";
                           }
                           echo "<form action='edit_topic.php' method='post'>
                            <input type='hidden' name='top_id' value='" . $row2['topic_id'] . "'>
                            <input type='hidden' name='cat_id' value='" . $row2['category_id'] . "'>
                            <input type='hidden' name='post_id' value='" . $row2['id'] . "'>
                            <input type='hidden' name='post_content' value='" . $row2['post_content'] . "'>
                           <input type='submit' name='edit_topic_button' value='Edytuj zawartość' class='btn btn-light'>

</form>";


                       }
                   }

                   $i++;
                   echo "<hr/></td></tr>";


               }
               $old_views = $row['topic_views'];
               $new_views = $old_views + 1;
               $sql3 = "UPDATE topics SET topic_views='".$new_views."' WHERE category_id='".$cid."' AND id='".$tid."' LIMIT 1";
               $res3 = mysqli_query($link, $sql3) or die(mysqli_error());
           }
           echo "</table>";
           if(isset($_SESSION['uid'])){
               echo "<tr><td colspan='2'><input class='btn btn-light' type='submit' value='Skomentuj' onClick=\"window.location = 'post_reply.php?cid=".$cid."&tid=".$tid."'\"/><hr/>";
           }
           else{
               echo "<tr><td colspan='2'><p style='color: white; font-size: 22px;'>Zaloguj się, aby dodać odpowiedź</p></td></tr>";
           }
       }else{
           echo"<p>This topic does not exist. </p>";
       }

       ?>

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

