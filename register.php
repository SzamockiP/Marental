<?php
session_start();
if (isset($_POST['username'])) {
	$flag = true;
	$username = $_POST['username'];
	if ((strlen($username) < 3) || (strlen($username) > 20)) {
		$flag = false;
		$_SESSION['e_register'] = "Nazwa użytkownika musi posiadać od 3 do 20 znaków!";
	}
	if (ctype_alnum($username) == false) {
		$flag = false;
		if (!isset($_SESSION['e_register']))
			$_SESSION['e_register'] = "Nazwa użytkownika może składać się tylko z liter i cyfr (bez polskich znaków)";
	}
	$email = $_POST['email'];
	$email_s = filter_var($email, FILTER_SANITIZE_EMAIL);
	if ((filter_var($email_s, FILTER_VALIDATE_EMAIL) == false) || ($email_s != $email) || (strlen($email) > 320)) {
		$flag = false;
		if (!isset($_SESSION['e_register']))
			$_SESSION['e_register'] = "Podaj poprawny adres e-mail!";
	}
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	if ((strlen($password1) < 8) || (strlen($password1) > 20)) {
		$flag = false;
		if (!isset($_SESSION['e_register']))
			$_SESSION['e_register'] = "Hasło musi posiadać od 8 do 20 znaków!";
	}
	if ($password1 != $password2) {
		$flag = false;
		if (!isset($_SESSION['e_register']))
			$_SESSION['e_register'] = "Podane hasła nie są identyczne!";
	}
	$password_hash = password_hash($password1, PASSWORD_DEFAULT);
	if (!isset($_POST['statute'])) {
		$flag = false;
		if (!isset($_SESSION['e_register']))
			$_SESSION['e_register'] = "Potwierdź akceptację regulaminu!";
	}
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	try {
		$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
		if ($connection->connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		} else {
			$result = $connection->query("SELECT id FROM users WHERE email='$email'");
			if (!$result) throw new Exception($conenction->error);
			$num_email = $result->num_rows;
			if ($num_email > 0) {
				$flag = false;
				$_SESSION['e_register'] = "Istnieje już konto przypisane do tego adresu e-mail!";
			}
			$result = $connection->query("SELECT id FROM users WHERE username='$username'");
			if (!$result) throw new Exception($connection->error);
			$num_username = $result->num_rows;
			if ($num_username > 0) {
				$flag = false;
				$_SESSION['e_register'] = "Istnieje już konto o podanej nazwie użytkownika!";
			}
			if ($flag == true) {
				if ($connection->query("INSERT INTO users(username,password,email) VALUES ('$username', '$password_hash', '$email')")) {
					header("Location:" . $_SESSION['last_page']);
				} else {
					throw new Exception($connection->error);
				}
			} else {
				header("Location:" . $_SESSION['last_page']);
			}
			$connection->close();
		}
	} catch (Exception $e) {
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		/* echo '<br />Informacja developerska: '.$e;  */
	}
}
?>