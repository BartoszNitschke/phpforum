<?php
session_start();
if($_SESSION['uid'] && isset($_POST['edit_content'])){
    
        include_once ("connection.php");
        $cid = $_POST['cat_id'];
        $tid = $_POST['top_id'];
        $pid = $_POST['post_id'];
        $pcid = $_POST['edited_content'];


        class info
        {
            private $top_id, $cat_id,$post_id,$edited_con;

            public function __construct($top_id, $cat_id,$post_id,$edited_con)
            {
                $this->top_id = $top_id;
                $this->cat_id = $cat_id;
                $this->post_id = $post_id;
                $this->edited_con = $edited_con;

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

            public function getEditedCon()
            {
                return $this->edited_con;
            }


        }
        $obj = new info($tid,$cid,$pid,$pcid);



        $sql = "UPDATE posts SET post_content='" . $obj->getEditedCon() . "' WHERE id='" . $obj->getPostId() . "'AND category_id='".$obj->getCatId()."'AND topic_id='".$obj->getTopId()."'";
        $res = mysqli_query($link, $sql) or die(mysqli_error());


        if (($res)) {
            echo "<p>Edytowano zawartość <a href='view_topic.php?cid=".$obj->getCatId()."&tid=".$obj->getTopId()."'>Kliknij by wrócić do posta</a></p>";
        } else {
            echo "<p>Wystąpił problem z usunięciem wątku.Spróbuj ponownie</p></br><a href='view_topic.php?cid=".$obj->getCatId()."&tid=".$obj->getTopId()."'>Kliknij by wrócić do posta</a>";
        }

 
}else{
    header("Location: index.php");
    exit();
}
?>

