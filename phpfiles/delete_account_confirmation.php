<?php
session_start();
if(($_SESSION['uid']) && isset($_POST['delete_account'])){


    include_once ("connection.php");
    $id = $_SESSION['uid'];

    echo"<form action='delete_account.php' method='post'>
         Czy na pewno chcesz usunąć konto?
         <br>
         <input type='submit' value='Usuń konto' name='delete_account'>
</form>
        <br>
        <a href='settings.php'>Powróć do ustawień</a>
";

}else{
    header("Location: index.php");
    exit();
}
?>
