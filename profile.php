<?php
session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
} else {
    $_SESSION['last_page'] = "profile.php";
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Css/profile.css">
    <link rel="stylesheet" href="Css/main.css">
    <title>My profile</title>
    <link rel="icon" type="image/png" href="Img/logo2.png">
    <script src="JavaScript/profile.js"></script>
    <script src="JavaScript/login.js"></script>
    <script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script><script> window.start.init({Palette:"palette8",Theme:"block",Mode:"banner top",Message:"Ta strona wykorzystuje ciasteczka, czy zgadzasz się na to?",ButtonText:"Tak",LinkText:"Czytaj więcej",Time:"5",Location:"https://www.cookiesandyou.com",})</script>
</head>

<body onload="load()">
    <div id="dark" onclick="dark_onclick_profile()"></div>

    <div id="menu">
        <ul>
                <li><a href="search.php?page=1&tags=Seinen">Seinen</a></li>
                    <li><a href="search.php?page=1&tags=Dramat">Dramat</a></li>
                    <li><a href="search.php?page=1&tags=Przygodowa">Przygodowa</a></li>
                    <li><a href="search.php?page=1&tags=Romans">Romans</a></li>
                    <li><a href="search.php?page=1&tags=Okruchy-życia">Okruchy-życia</a></li>
                    <li><a href="search.php?page=1&tags=Harem">Harem</a></li>
                    <li><a href="search.php?page=1&tags=Girls-love">Girls-love</a></li>
                    <li><a href="search.php?page=1&tags=Shounen">Shounen</a></li>
                    <li><a href="search.php?page=1&tags=Fantastyka">Fantastyka</a></li>
                    <li><a href="search.php?page=1&tags=Ecchi">Ecchi</a></li>
        </ul>
    </div>

    <header>
        <section>
            <a href="logout.php">Wyloguj się!</a>
        </section>

        <section>
            <div>
                <figure>
                    <img src="Img/menu.png" onclick="menu()">
                </figure>
                <a href="index.php">
                    <img src="Img/logo.png">
                </a>
            </div>
            <form action="search_script.php" method="post">
                <input type="text" placeholder="Wyszukaj książkę">
                <input type="submit" value="🔎︎">
            </form>
            <div>
                <a href="#"><span>🕮 Lista wypożyczeń</span></a>
            </div>
        </section>

        <nav>
            <ul>
                    <li><a href="search.php?page=1&tags=Seinen">Seinen</a></li>
                    <li><a href="search.php?page=1&tags=Dramat">Dramat</a></li>
                    <li><a href="search.php?page=1&tags=Przygodowa">Przygodowa</a></li>
                    <li><a href="search.php?page=1&tags=Romans">Romans</a></li>
                    <li><a href="search.php?page=1&tags=Okruchy-życia">Okruchy-życia</a></li>
                    <li><a href="search.php?page=1&tags=Harem">Harem</a></li>
                    <li><a href="search.php?page=1&tags=Girls-love">Girls-love</a></li>
                    <li><a href="search.php?page=1&tags=Shounen">Shounen</a></li>
                    <li><a href="search.php?page=1&tags=Fantastyka">Fantastyka</a></li>
                    <li><a href="search.php?page=1&tags=Ecchi">Ecchi</a></li>
             </ul>
        </nav>
    </header>

    <main>
        <section id="mainSection">
            <ul>
                <li>Panel klienta</li>
                <li onclick="btn1_onclick()">Dane konta</li>
                <li onclick="btn2_onclick()">Wypożyczone książki</li>
                <li onclick="btn3_onclick()">Adresy rozliczeniowe i dostawy</li>
            </ul>


            <article>
                <h2>Dane Konta</h2>
                <div>
                    <h3>Nazwa użytkownika: </h3>
                    <p><?php echo $_SESSION['username'] ?></p>
                    <br>
                    <h3>Zmień E-mail</h3>
                    <span><?php echo "Aktualny email: ".$_SESSION['email'] ?></span>
                    <form action="change_email.php" method="post">
                        <span>Hasło</span> <br>
                        <input type="password" name="password"> <br>
                        <span>Nowy email</span> <br>
                        <input type="password" name="new_email"> <br>
                        <input type="submit" value="Zmień email"> <br>
                    </form>
                    <?php if(isset($_SESSION['change_email_i'])){echo "<span>".$_SESSION['change_email_i']."</span>"; unset($_SESSION['change_email_i']);}?>
                    <br>
                    <h3>Zmień hasło</h3>
                    <form action="change_password.php" method="post">
                        <span>Aktualne hasło</span> <br>
                        <input type="password" name="password"> <br>
                        <span>Nowe hasło</span> <br>
                        <input type="password" name="new_password1"> <br>
                        <span>Powtórz nowe hasło</span> <br>
                        <input type="password" name="new_password2"> <br>
                        <input type="submit" value="Zmień hasło"> <br>
                    </form>
                    <?php if(isset($_SESSION['change_pass_i'])){echo "<span>".$_SESSION['change_pass_i']."</span>"; unset($_SESSION['change_pass_i']);}?>
                </div>
            </article>

            <article>
                <h2>Wypożyczone książki:</h2>
                <div class="books">
                    <?php
                    require_once "connect.php";
                    $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                    if ($connection->connect_errno != 0) {
                        echo "Error: " . $connection->connect_errno;
                    } else {
                        $sql = "SELECT b.title, b.id, b.isbn FROM books AS b, rented AS r, users AS u WHERE b.id = r.book_id AND u.id = r.user_id AND u.id = " . $_SESSION['id'];
                        $result = mysqli_query($connection, $sql);
                        if (!$result) {
                            $connection->close();
                        } else {
                            if (empty($result)) {
                                echo "<h3> Brak książek </h3>";
                                $connection->close();
                            } else {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<div class='book'>
                                        <a href='book.php?id=" . $row['id'] . "'>
                                            <img src='Books_img/".$row['isbn'].".jpg' onerror='this.onerror=null; this.src=\"https://via.placeholder.com/150x200\"' alt='".$row['isbn']."' width='150' height='200'>
                                        </a>
                                        <h3>" . $row['title'] . "</h3>
                                    </div>";
                                }
                                $connection->close();
                            }
                        }
                    }
                    ?>
                </div>
            </article>

            <article>
                <h2>Adres: </h2>
                <div>
                    <h3>Adres</h3>
                    <?php 
                    require_once "connect.php";
                    $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                    if ($connection->connect_errno != 0) {
                        echo "Error: " . $connection->connect_errno;
                    } else {
                        $sql = "SELECT city, street, street_number, post_code FROM users WHERE id=".$_SESSION['id'];
                        $result = mysqli_query($connection, $sql);
                        if (!$result) {
                            echo "Wystąpił błąd";
                            $connection->close();
                        } else {
                            $row = mysqli_fetch_assoc($result);
                            if (is_null($row['city'])) echo "<span>Miasto: </span>"; else echo "<span>Miasto: ".$row['city']."</span>";
                            if (is_null($row['street'])) echo "<span>Ulica: </span>"; else echo "<span>Ulica: ".$row['street']."</span>";
                            if (is_null($row['street_number']) || $row['street_number']<=0) echo "<span>Numer ulicy: </span>"; else echo "<span>Numer ulicy: ".$row['street_number']."</span>";
                            if (is_null($row['post_code'])) echo "<span>Kod pocztowy: </span>"; else echo "<span>Kod pocztowy: ".$row['post_code']."</span>";
                        }
                    }
                    ?>
                    <h3>Zmień adres</h3>
                    <form action="change_adress.php" method="post">
                        <span>Aktualne hasło</span> <br>
                        <input type="password" name="password"> <br>
                        <span>Miasto</span> <br>
                        <input type="text" name="new_city"> <br>
                        <span>Ulica</span> <br>
                        <input type="text" name="new_street"> <br>
                        <span>Numer ulicy</span> <br>
                        <input type="number" name="new_street_number"> <br>
                        <span>Kod pocztowy</span> <br>
                        <input type="text" name="new_post_code"> <br>
                        <input type="submit" value="Zmień adres"> <br>
                    </form>
                    <?php if(isset($_SESSION['change_adress_i'])){echo "<span>".$_SESSION['change_adress_i']."</span>"; unset($_SESSION['change_adress_i']);}?>
                </div>
            </article>
        </section>
    </main>

    <footer>
        <section>
                <div>
                    <span>✉ biuro.marental@gmail.com</span>
                </div>
                <div>
                    <span>☏ 213-742-069</span>
                </div>
            </section>

            <section>
                <div>
                    <span>Regulamin:</span><br>
                    <p>Strona została stworzona w ramach projektu szkolnego Powiatowego Zespołu Szkół nr 2 im. Bohaterskiej Załogi ORP „Orzeł" w Wejherowie. Witryna nie jest prawdziwą wypożyczalnią mang, zatem nie da się u nas wypożyczać książek. Informacje z książek zostały pobrane ze strony internetowej www.gildia.pl oraz www.yatta.pl. Nie odpowiadamy za bezpieczeństwo podanych przy logowaniu danych, więc należy używać informacji zmyślonych.</p>
                </div>      
            </section>

            <section>
                <span>&copy; Marental Sp. z.o.o. Wszelkie prawa zastrzeżone.</span>
                
            </section>
    </footer>
</body>

</html>