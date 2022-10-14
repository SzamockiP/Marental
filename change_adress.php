<?php
session_start();

if(isset($_POST['password'])){
    $password = $_POST['password'];
    $new_city = $_POST['new_city'];
    $new_street = $_POST['new_street'];
    $new_street_number = $_POST['new_street_number'];
    $new_post_code = $_POST['new_post_code'];


    require_once "connect.php";
    $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
    if ($connection->connect_errno != 0) {
        $_SESSION['change_adress_i'] = "Wystąpił błąd";
    } else {
        $sql = "SELECT password, id FROM users WHERE id=".$_SESSION['id'];
        $result = mysqli_query($connection, $sql);
        if (!$result || is_null($password) || is_null($new_city) || is_null($new_street) || is_null($new_street_number) || is_null($new_post_code)) {
            $_SESSION['change_adress_i'] = "Wystąpił błąd";
            header("Location:" . $_SESSION['last_page']);
            $connection->close();
        } else {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                $sql = "UPDATE users SET city = '".$new_city."', street='".$new_street."', street_number=".$new_street_number.", post_code='".$new_post_code."' WHERE id = ".$row['id'];
                $connection -> query($sql);
                $_SESSION['change_adress_i'] = "Zmieniono adres";
                header('Location:'.$_SESSION['last_page']);
                $connection -> close();
            } else {
                $_SESSION['change_adress_i'] = "Złe hasło";
                header('Location:'.$_SESSION['last_page']);
                $connection -> close();
            }
        }
    }
} else {
    $_SESSION['change_adress_i'] = "Wystąpił błąd";
    if(isset($_SESSION["last_page"]))
		header('Location:'.$_SESSION['last_page']);		
	else
		header("Location: index.php");
}

?>