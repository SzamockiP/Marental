<?php
session_start();

if(isset($_POST['password'])){
    $password = $_POST['password'];
    $new_email = $_POST['new_email'];

    require_once "connect.php";
    $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
    if ($connection->connect_errno != 0) {
        $_SESSION['change_email_i'] = "Wystąpił błąd";
    } else {
        $sql = "SELECT email, password FROM users WHERE id=".$_SESSION['id'];
        $result = mysqli_query($connection, $sql);
        if (!$result || is_null($password) || is_null($new_email)) {
            $_SESSION['change_email_i'] = "Wystąpił błąd";
            header("Location:" . $_SESSION['last_page']);
            $connection->close();
        } else {
            if(filter_var(filter_var($new_email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) == true && filter_var($new_email, FILTER_SANITIZE_EMAIL) == $new_email){
                $row = mysqli_fetch_assoc($result);
                if(password_verify($password, $row['password'])){
                    $sql = "UPDATE users SET email = '".$new_email."' WHERE id = ".$row['id'];
                    $connection -> query($sql);
                    $_SESSION['change_email_i'] = "Zmieniono email";
                    header('Location:'.$_SESSION['last_page']);
                    $connection -> close();
                } else {
                    $_SESSION['change_email_i'] = "Złe hasło";
                    header('Location:'.$_SESSION['last_page']);
                    $connection -> close();
                }
                
            } else {
                header('Location:'.$_SESSION['last_page']);
                $_SESSION['change_email_i'] = "Niepoprawny email";
                $connection -> close();
            }
        }
    }
} else {
    $_SESSION['change_email_i'] = "Wystąpił błąd";
    if(isset($_SESSION["last_page"]))
		header('Location:'.$_SESSION['last_page']);		
	else
		header("Location: index.php");
}

?>