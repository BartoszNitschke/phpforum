<?php session_start();
$cid = "";
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

    <hr/>
    <div class="content">
        <?php
        include_once ("connection.php");
        $cid = $_GET['cid'];
        $topics ="";

        if(isset($_SESSION['uid'])){
            $logged = "<a href='create_topic.php?cid=".$cid."' style='color: white;  margin-top: 50px; text-decoration: none; font-size: 22px;'> &nbsp; | &nbsp; Utwórz post</a>";

        }else{
            $logged = " |  Zaloguj się, aby utworzyć post.";
        }

        $sql = "SELECT id FROM categories WHERE id='".$cid."' LIMIT 1";
        $res = mysqli_query($link, $sql) or die(mysqli_error());
        if(mysqli_num_rows($res) == 1){
            $sql2 = "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC ";
            $res2 = mysqli_query($link,$sql2) or die(mysqli_error());
            if(mysqli_num_rows($res2) > 0 ){
                $topics .= "<table width = '100%' style='border-collapse: collapse;'>";
                $topics .= " <tr><td colspan='3'><div><a href='index.php' style='color: white;  margin-top: 50px; text-decoration: none; font-size: 22px;'>
                &nbsp; Strona główna</a> <span style='color: white; font-size: 22px;'>".$logged."</span></div><hr /></td></tr>";

                $topics .= "<tr style='background-color: #4F4C4CC6; color: white;'><td>&nbsp;Temat pytania</td>
                <td width='100' align='center'> Odpowiedzi </td><td width='100' align='center'> Wyświetlenia </td></tr>";

                $topics .= "<tr><td colspan='3'></td><tr/>";



                while($row = mysqli_fetch_assoc($res2)){
                    $tid = $row ['id'];
                    $title = $row['topic_title'];
                    $views = $row['topic_views'];
                    $date = $row['topic_date'];
                    $creator = $row['topic_creator'];
                    $replies = $row['topic_replies'];

                    $sql4 = "SELECT username FROM users WHERE id='".$creator."'";
                    $res4 = mysqli_query($link,$sql4) or die(mysqli_error());
                    $c = mysqli_fetch_assoc($res4);
                    $creator2 = $c['username'];


                    $topics .= "<div>
                                <tr style='background-color: #cccccc;'>
                                <td>
                                <a style='text-decoration: none; color: black; font-size: 22px; font-weight: bold;' 
                                href='view_topic.php?cid=".$cid."&tid=".$tid."'>".$title."</a>
                                <br/>
                                <span>
                    Utworzone przez: <b>".$creator2."</b> w dniu ".$date."
                                </span>
                                </td>
                    <td align='center'><b>$replies</b></td>
                    <td align='center'><b>".$views."</b></td> 
                                </tr>";
                    $topics .= "<tr><td></td><tr/></div>";

                }

                $topics .="</table>";
                echo $topics;
            }else{
                echo"<div style='text-align: center; padding-bottom: 30px;'>
                        <a href='index.php' style='color: white;  margin-top: 50px; text-decoration: none; font-size: 22px;'>Kliknij, by wrócić na stronę główną</a>
                     </div>";
                echo " <p style='color: white;'>W tej kategorii nie ma jeszcze postów.".$logged."</p>";
            }
        }else{
            echo"<div style='text-align: center; padding-bottom: 30px;'>
                    <a href='index.php' style='color: white;  margin-top: 50px; text-decoration: none; font-size: 22px;'>Kliknij, by wrócić na stronę główną</a>
                 </div>";
            echo "<p> Wybrana kategoria nie istnieje!</p>";
        }
        ?>

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

