<?php
include ("connection.php");

if(isset($_POST['register_user'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $min_length = 6;

    if ($username == "" || $password == "") {
        echo "Login lub hasło nie zostały wypełnione!";
        echo "<br/> <a href='register.php'>Powrót do rejestracji</a>'";
    } else {
        if (strlen($password) >= $min_length && strlen($username) >= $min_length) {
            $sql2 = "SELECT * FROM users WHERE username='" . $username . "'";
            $res2 = mysqli_query($link, $sql2) or die(mysqli_error());

            if (mysqli_num_rows($res2)) {
                echo "Podana nazwa użytkownika już istnieje!";
                echo "<br/><a href='register.php'>Powrót do rejestracji</a>";
                exit();
            }


            $sql = "INSERT INTO users (username,password)
        VALUES ('" . $username . "', '" . $password . "');
";
            $res = mysqli_query($link, $sql) or die(mysqli_error());


            if (($res)) {
                echo "Zarejestrowałeś się jako : " . $username;
                echo "<br/><a href='index.php'>Powrót na stronę główną</a>";
            } else {
                echo "Nie udało się zarejestrować, spróbuj ponownie\n";
                echo "Error: " . mysqli_error($link);
                echo "<br/> <a href='register.php'>Powrót do rejestracji</a>'";
            }
        } else {
            echo "Login i hasło muszą zawierać minimum 6 znaków ";
            echo "<br/> <a href='register.php'>Powrót do rejestracji</a>'";
        }

    }
}else{
    echo"Wystąpił błąd podczas rejestracji!";
    echo "<br/> <a href='register.php'>Powrót do rejestracji</a>'";
}

?>
