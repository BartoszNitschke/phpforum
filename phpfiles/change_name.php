<?php
session_start();
if(($_SESSION['uid']) && isset($_POST['name_button'])){
    include_once ("connection.php");

        $login = $_POST['username'];
        $id = $_SESSION['uid'];

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


        if(strlen($login) < 6){
            echo "Login musi mieć minimum 6 znaków! Spróbuj ponownie!";
            echo "</br><a href='settings.php'>Wróć do ustawień</a>";
        }
        else {
            $sql = "UPDATE users SET username='" . $obj->login . "' WHERE id='" . $obj->id . "'LIMIT 1";
            $res = mysqli_query($link, $sql) or die(mysqli_error());

            if (($res)) {
                echo "<p>Zmieniono login. <a href='settings.php'>Kliknij by wrócić do ustawień</a></p>";
            } else {
                echo "<p>Wystąpił problem ze zmianą loginu.Spróbuj ponownie</p></br><a href='settings.php'>Kliknij by wrócić do ustawień</a>";
            }
        }
}else{
    header("Location: index.php");
    exit();
}
?>
