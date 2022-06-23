<?php
session_start();
if($_SESSION['uid']){
    if(isset($_POST['password_button'])){
        include_once ("connection.php");

        $password = $_POST['password'];
        $id = $_SESSION['uid'];

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

        if(strlen($password) < 6){
            echo "Hasło musi mieć minimum 6 znaków! Spróbuj ponownie!";
            echo "</br><a href='settings.php'>Wróć do ustawień</a>";
        }
        else {
            $sql = "UPDATE users SET password='" . $obj->password . "' WHERE id='" . $obj->id . "'LIMIT 1";
            $res = mysqli_query($link, $sql) or die(mysqli_error());

            if (($res)) {
                echo "<p>Zmieniono hasło. <a href='settings.php'>Kliknij by wrócić do ustawień</a></p>";
            } else {
                echo "<p>Wystąpił problem ze zmianą hasła.Spróbuj ponownie</p></br><a href='settings.php'>Kliknij by wrócić do ustawień</a>";
            }
        }
    }else{
        exit();
    }
}else{
    header("Location: index.php");
    exit();
}
?>
