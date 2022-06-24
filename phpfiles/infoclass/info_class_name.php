<?php
class info
{
    public $login, $id;

    public function __construct($login, $id)
    {
        $this->login = $login;
        $this->id = $id;
    }
}
$obj = new info($login,$id);
?>
