<?php
class info
{
    public $password, $id;

    public function __construct($password, $id)
    {
        $this->password = $password;
        $this->id = $id;
    }
}
$obj = new info($password,$id);
?>