<?php
session_start();

require_once "connect.php";

$connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');

if (!isset($_SESSION['last_page']))
	$_SESSION['last_page'] = "index.php";

if ($connection->connect_errno != 0) {
	echo "Error: " . $connection->connect_errno;
} else {
	$login = $_POST['username'];
	$password = $_POST['password'];

	$login = htmlentities($login, ENT_QUOTES, "UTF-8");

	if ($result = @$connection->query(
		sprintf(
			"SELECT * FROM users WHERE username='%s'",
			mysqli_real_escape_string($connection, $login)
		)
	)) {
		$user_num = $result->num_rows;
		if ($user_num > 0) {
			$row = $result->fetch_assoc();
			if (password_verify($password, $row['password'])) {
				$_SESSION['logged'] = TRUE;

				$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['email'] = $row['email'];

				unset($_SESSION['error']);
				header('Location:' . $_SESSION['last_page']);
			} else {
				$_SESSION['error'] = 'Nieprawidłowy login lub hasło!';
				header('Location:' . $_SESSION['last_page']);
			}
		} else {
			$_SESSION['error'] = 'Nieprawidłowy login lub hasło!';
			header('Location:' . $_SESSION['last_page']);
		}
	}
	$connection->close();
}
?>