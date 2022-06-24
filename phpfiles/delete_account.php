<?php
session_start();
if(($_SESSION['uid']) && isset($_POST['delete_account'])){
    
        include_once ("connection.php");
        $id = $_SESSION['uid'];

   
            $sql = "DELETE FROM users WHERE id='".$id."'";
            $res = mysqli_query($link, $sql) or die(mysqli_error());

            if (($res)) {
                session_destroy();
                echo "<p>Twoje konto zostało usunięte. <a href='index.php'>Kliknij, aby wrócić na stronę główną</a></p>";
            } else {
                echo "<p>Wystąpił problem ze zmianą loginu.Spróbuj ponownie</p></br><a href='settings.php'>Kliknij by wrócić do ustawień</a>";
            }

}else{
    header("Location: index.php");
    exit();
}
?>
