<?php
session_start();
if(($_SESSION['uid']) && isset($_POST['delete'])){
    
        include_once ("connection.php");
        $cid = $_POST['cat_id'];
        $id = $_POST['top_id'];

        class info
        {
            public $top_id, $cat_id;

            public function __construct($top_id, $cat_id)
            {
                $this->top_id = $top_id;
                $this->cat_id = $cat_id;
            }
        }
        $obj = new info($id,$cid);



        $sql = "DELETE FROM posts WHERE category_id='" . $obj->cat_id . "' AND topic_id='".$obj->top_id."'";
        $res = mysqli_query($link, $sql) or die(mysqli_error());

        $sql2 = "DELETE FROM topics WHERE category_id='" . $obj->cat_id . "' AND id='".$obj->top_id."'";
        $res2 = mysqli_query($link, $sql2);

        $sql3 = "UPDATE topics SET topic_replies=topic_replies-1 WHERE id='".$obj->top_id."'LIMIT 1";
        $res3 = mysqli_query($link, $sql3);




        if (($res) && ($res2) && ($res3)) {
            echo "<p>Usunięto wątek <a href='view_category.php?cid=".$obj->cat_id."'>Kliknij by wrócić do kategorii</a></p>";
        } else {
            echo "<p>Wystąpił problem z usunięciem wątku.Spróbuj ponownie</p></br><a href='view_topic.php?cid=".$obj->cat_id."&tid=".$obj->top_id."'>Kliknij by wrócić do posta</a>";
        }

    
}else{
    header("Location: index.php");
    exit();
}
?>
