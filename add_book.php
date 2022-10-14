<?php
session_start();

if (isset($_GET['book']) && is_numeric($_GET['book']) && isset($_SESSION['id'])) {
    require_once "connect.php";
    $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
    if ($connection->connect_errno != 0) {
        $_SESSION['rent_info'] = "Wystąpił błąd";
    } else {
        $sql = "SELECT id FROM rented WHERE user_id =" . $_SESSION['id'] . " AND book_id =" . $_GET['book'];
        $result = mysqli_query($connection, $sql);
        if (!$result) {
            $_SESSION['rent_info'] = "Wystąpił błąd";
            header("Location:" . $_SESSION['last_page']);
            $connection->close();
        } else {
            $sql = "SELECT city, street, street_number, post_code FROM users WHERE id=".$_SESSION['id'];
            $result_adress = mysqli_query($connection, $sql);
            if (!$result_adress) {
                $_SESSION['rent_info'] = "Wystąpił błąd";
                header("Location:" . $_SESSION['last_page']);
                $connection->close();
            } else {
                $row = mysqli_fetch_assoc($result_adress);
                if (is_null($row['city']) || is_null($row['street']) || is_null($row['post_code']) || is_null($row['street_number']) || $row['street_number'] <= 0){
                    $_SESSION['rent_info'] = "Musisz uzupełnić dane adresu";
                    header("Location:" . $_SESSION['last_page']);
                    $connection->close();
                }
                else{
                    if ($result->num_rows >= 1) {
                        $_SESSION['rent_info'] = "Już wypożyczyłeś tę książkę";
                        header("Location:" . $_SESSION['last_page']);
                        $connection->close();
                    } else {
                        $sql = "SELECT rented_num FROM users WHERE id=" . $_SESSION['id'];
                        $result = mysqli_query($connection, $sql);
                        if (!$result) {
                            $_SESSION['rent_info'] = "Wystąpił błąd";
                            header("Location:" . $_SESSION['last_page']);
                            $connection->close();
                        } else {
                            $row = mysqli_fetch_assoc($result);
                            if ($row['rented_num'] >= 10) {
                                $_SESSION['rent_info'] = "Nie możesz wypożyczyć więcej niż 10 książek na raz";
                                header("Location:" . $_SESSION['last_page']);
                                $connection->close();
                            } else {
                                $sql1 = "INSERT INTO rented (user_id,book_id) VALUES (" . $_SESSION['id'] . "," . $_GET['book'] . ")";
                                $sql2 = "UPDATE books SET rented_num = (rented_num + 1) WHERE id=" . $_GET['book'];
                                $sql3 = "UPDATE users SET rented_num = (rented_num + 1) WHERE id=" . $_SESSION['id'];
                                if ($connection->query($sql1) && $connection->query($sql2) && $connection->query($sql3)) {
                                    header("Location:" . $_SESSION['last_page']);
                                    $connection->close();
                                } else {
                                    $_SESSION['rent_info'] = "Wystąpił błąd przy dodawaniu książki";
                                    header("Location:" . $_SESSION['last_page']);
                                    $connection->close();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    $_SESSION['rent_info'] = "Wystąpił błąd";
    if (isset($_SESSION["last_page"]))
        header('Location:' . $_SESSION['last_page']);
    else
        header("Location: index.php");
}

?>
