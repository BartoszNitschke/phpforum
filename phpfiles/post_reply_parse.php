<?php
session_start();
if($_SESSION['uid']){
    if(isset($_POST['reply_submit'])){
        include_once ("connection.php");
        $creator = $_SESSION['username'];
        $cid = $_POST['cid'];
        $tid = $_POST['tid'];
        $reply_content = $_POST['reply_content'];

        class info
        {
            private $creator, $cat_id,$top_id,$reply_con;

            public function __construct($creator, $cat_id,$top_id,$reply_con)
            {
                $this->creator = $creator;
                $this->cat_id = $cat_id;
                $this->top_id = $top_id;
                $this->reply_con = $reply_con;

            }

            public function getCreator()
            {
                return $this->creator;
            }

            public function getCatId()
            {
                return $this->cat_id;
            }

            public function getTopId()
            {
                return $this->top_id;
            }

            public function getReplyCon()
            {
                return $this->reply_con;
            }



        }
        $obj = new info($creator,$cid,$tid,$reply_content);


        $sql = "INSERT INTO posts (category_id, topic_id, post_creator, post_content, post_date) VALUES (
                '".$obj->getCatId()."', '".$obj->getTopId()."', '".$obj->getCreator()."', '".$obj->getReplyCon()."', now()                                                                               
)";
        $res = mysqli_query($link, $sql) or die(mysqli_error());

        $sql2 = "UPDATE categories SET last_post_date = now(), last_user_posted='".$obj->getCreator()."' WHERE id ='".$obj->getCatId()."' LIMIT 1";
        $res2 = mysqli_query($link, $sql2) or die(mysqli_error());

        $sql3 = "UPDATE topics SET topic_reply_date=now(), topic_last_user='".$obj->getCreator()."' WHERE id='".$obj->getTopId()."' LIMIT 1";
        $res3 = mysqli_query($link, $sql3) or die(mysqli_error());


        $sql4 = "UPDATE topics SET topic_replies=topic_replies+1 WHERE id='".$obj->getTopId()."'LIMIT 1";
        $res4 = mysqli_query($link, $sql4) or die(mysqli_error());

        if(($res) && ($res2) && ($res3) && ($res4)){
            echo"<p>Twój komentarz został wstawiony. <a href='view_topic.php?cid=".$obj->getCatId()."&tid=".$obj->getTopId()."'>Kliknij, aby wrócić do pytania</a></p>";
        }else{
            echo "<p>Wystąpił problem z opublikowaniem twojego komentarza. Spróbuj ponownie później</p>";
        }

    }else{
        exit();
    }
}else{
    exit();
}
?>
