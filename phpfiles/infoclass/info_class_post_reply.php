<?php
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

?>
