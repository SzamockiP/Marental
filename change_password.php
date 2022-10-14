<?php
session_start();

if(isset($_POST['password'])){
    $password = $_POST['password'];
    $new_password1 = $_POST['new_password1'];
    $new_password2 = $_POST['new_password2'];

    require_once "connect.php";
    $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
    if ($connection->connect_errno != 0) {
        $_SESSION['change_pass_i'] = "Wystąpił błąd";
    } else {
        $sql = "SELECT id, password FROM users WHERE id=".$_SESSION['id'];
        $result = mysqli_query($connection, $sql);
        if (!$result || is_null($password) || is_null($new_password1) || is_null($new_password2)) {
            $_SESSION['change_pass_i'] = "Wystąpił błąd";
            header("Location:" . $_SESSION['last_page']);
            $connection->close();
        } else {
            if($new_password1 == $new_password2 && strlen($new_password1)>=8 && strlen($new_password2) <= 20){
                $row = mysqli_fetch_assoc($result);
                if(password_verify($password, $row['password'])){
                    $sql = "UPDATE users SET password = '".password_hash($new_password1, PASSWORD_DEFAULT)."' WHERE id = ".$row['id'];
                    $connection -> query($sql);
                    $_SESSION['change_pass_i'] = "Zmieniono hasło";
                    header('Location:'.$_SESSION['last_page']);
                    $connection -> close();
                } else {
                    $_SESSION['change_pass_i'] = "Złe hasło";
                    header('Location:'.$_SESSION['last_page']);
                    $connection -> close();
                }
            } else {
                header('Location:'.$_SESSION['last_page']);
                $_SESSION['change_pass_i'] = "Nowe hasła się nie zgadzają są złej długości (8 do 20 znaków)";
                $connection -> close();
            }
        }
    }
} else {
    $_SESSION['change_pass_i'] = "Wystąpił błąd";
    if(isset($_SESSION["last_page"]))
		header('Location:'.$_SESSION['last_page']);		
	else
		header("Location: index.php");
}

?>