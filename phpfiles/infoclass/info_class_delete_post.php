<?php
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
?>