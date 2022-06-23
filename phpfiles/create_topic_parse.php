<?php
session_start();
if($_SESSION['uid'] == "") {
    header("Location: index.php");
    exit();
}
if (isset($_POST['topic_submit'])){
    if(($_POST['topic_title'] == "") && ($_POST['topic_content'] == "")){
        echo"Nie wypełniono obu pól. Spróbuj ponownie.";
        exit();
    }else{
        include_once ("connection.php");
        $cid = $_POST['cid'];
        $title = $_POST['topic_title'];
        $content = $_POST['topic_content'];
        $creator = $_SESSION['username'];

        class info
        {
            public $creator, $cat_id,$content,$title;

            public function __construct($creator,$cat_id,$content,$title)
            {
                $this->creator = $creator;
                $this->cat_id = $cat_id;
                $this->content = $content;
                $this->title = $title;
            }
        }
        $obj = new info($creator,$cid,$content,$title);



        $sql = "INSERT INTO topics (category_id, topic_title, topic_creator, topic_date, topic_reply_date) VALUES 
                ('".$obj->cat_id."', '".$obj->title."','".$obj->creator."',now(),now())
";
        $res = mysqli_query($link,$sql) or die(mysqli_error());

        $new_topic_id = mysqli_insert_id($link);
        $sql2 = "INSERT INTO posts (category_id, topic_id, post_creator, post_content, post_date) VALUES ('".$obj->cat_id."', '".$new_topic_id."','".$obj->creator."','".$obj->content."',now())";
        $res2 = mysqli_query($link, $sql2) or die(mysqli_error());

        $sql3 = "UPDATE categories SET last_post_date=now(), last_user_posted = '".$obj->creator."' WHERE id = '".$obj->cat_id."' LIMIT 1";
        $res3 = mysqli_query($link, $sql3) or die(mysqli_error());

        if(($res) && ($res2) && ($res3)){
            header("Location: view_topic.php?cid=".$obj->cat_id."&tid=".$new_topic_id);
        }else{
            echo"Wystąpił problem z utworzeniem pytania. Spróbuj ponownie";
        }

    }
}


?>
