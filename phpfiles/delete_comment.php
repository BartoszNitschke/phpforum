<?php
session_start();
if(($_SESSION['uid']) && isset($_POST['delete_comment_button'])){
    
        include_once ("connection.php");
        $cid = $_POST['cat_id'];
        $tid = $_POST['top_id'];
        $pid = $_POST['post_id'];


        class info
        {
            private $top_id, $cat_id,$post_id;

            public function __construct($top_id, $cat_id,$post_id)
            {
                $this->top_id = $top_id;
                $this->cat_id = $cat_id;
                $this->post_id = $post_id;

            }

            public function getTopId()
            {
                return $this->top_id;
            }

            public function getCatId()
            {
                return $this->cat_id;
            }

            public function getPostId()
            {
                return $this->post_id;
            }


        }
        $obj = new info($tid,$cid,$pid);


            $sql = "DELETE FROM posts WHERE id='" . $obj->getPostId() . "' AND category_id='" . $obj->getCatId() . "' AND topic_id='".$obj->getTopId()."'";
            $res = mysqli_query($link, $sql) or die(mysqli_error());



            if (($res)) {
                echo "<p>Usunięto komentarz <a href='view_topic.php?cid=".$obj->getCatId()."&tid=".$obj->getTopId()."'>Kliknij by wrócić do posta</a></p>";
            } else {
                echo "<p>Wystąpił problem z usunięciem posta.Spróbuj ponownie</p></br><a href='view_topic.php?cid=".$obj->getCatId()."&tid=".$obj->getTopId()."'>Kliknij by wrócić do posta</a>";
            }

   
}else{
    header("Location: index.php");
    exit();
}
?>
