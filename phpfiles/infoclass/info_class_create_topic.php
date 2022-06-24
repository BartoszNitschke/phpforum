<?php
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
?>
