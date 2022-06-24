<?php
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
?>