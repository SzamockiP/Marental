<?php
    session_start();

    if(isset($_GET['book']) && is_numeric($_GET['book']) && isset($_SESSION['id'])){
        require_once "connect.php";
        $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
        if ($connection->connect_errno!=0){
            $_SESSION['rent_info'] = "Wystąpił błąd";
        }
        else{
            $sql = "SELECT id FROM rented WHERE user_id =". $_SESSION['id']." AND book_id =". $_GET['book'];
            $result = mysqli_query($connection,$sql);
            if(!$result){
                $_SESSION['rent_info'] = "Wystąpił błąd";
                header("Location:".$_SESSION['last_page']);
                $connection->close();
            }
            else{
                if($result -> num_rows < 1){
                    $_SESSION['rent_info'] = "Nie można oddać książki bo nie jest wypożyczona";
                    header("Location:".$_SESSION['last_page']);
                    $connection->close();
                }
                else{
                    $sql1 = "DELETE FROM rented WHERE user_id=".$_SESSION['id']." AND book_id=".$_GET['book'];
                    $sql2 = "UPDATE books SET rented_num = (rented_num - 1) WHERE id=".$_GET['book'];
                    $sql3 = "UPDATE users SET rented_num = (rented_num - 1) WHERE id=".$_SESSION['id'];
                    if($connection -> query($sql1) && $connection -> query($sql2) && $connection -> query($sql3)){ 
                        header("Location:".$_SESSION['last_page']);
                        $connection->close();
                    }
                    else{
                        $_SESSION['rent_info'] = "Wystąpił błąd przy usuwaniu książki";
                        header("Location:".$_SESSION['last_page']);
                        $connection->close();
                    }
                }
            }
        } 
    } else {
        $_SESSION['rent_info'] = "Wystąpił błąd";
        if(isset($_SESSION["last_page"]))
            header('Location:'.$_SESSION['last_page']);		
        else
            header("Location: index.php");
    }
?>