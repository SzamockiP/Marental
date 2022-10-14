<?php
session_start();
$_SESSION["last_page"] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Css/main.css">
    <link rel="stylesheet" href="Css/search.css">
    <title>Search manga</title>
    <link rel="icon" type="image/png" href="Img/logo2.png">
    <script src="JavaScript/login.js"></script>
    <script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script><script> window.start.init({Palette:"palette8",Theme:"block",Mode:"banner top",Message:"Ta strona wykorzystuje ciasteczka, czy zgadzasz się na to?",ButtonText:"Tak",LinkText:"Czytaj więcej",Time:"5",Location:"https://www.cookiesandyou.com",})</script>
</head>

<body>
    <div id="dark" onclick="dark_onclick()"></div>
    <div id="login">
        <h2>Zaloguj się</h2>
        <form action="login.php" method="post">
            <span>Nazwa użytkownika:</span>
            <input type="text" name="username">
            <span>Hasło:</span>
            <input type="password" name="password">
            <input type="submit" value="Zaloguj się" />
            <span class="blad">
                <?php
                if (isset($_SESSION['error'])) echo $_SESSION['error'];
                ?>
            </span>
        </form>
    </div>

    <div id="register">
        <h2>Rejestracja</h2>
        <form action="register.php" method="post">
            <span>Nazwa użytkownika:</span>
            <input type="text" name="username">
            <span>Adres E-mail:</span>
            <input type="text" name="email">
            <span>Hasło:</span>
            <input type="password" name="password1">
            <span>Powtórz hasło:</span>
            <input type="password" name="password2">
            <input type="submit" value="Zarejestruj się">
            <span class="blad">
                <?php
                if (isset($_SESSION['e_register'])) {
                    echo $_SESSION['e_register'];
                    unset($_SESSION['e_register']);
                }
                ?>
            </span>
            <div>
                <form><input type="checkbox" name="statute"> Akceptuję regulamin</form>
            </div>
        </form>
    </div>

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
            <?php if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) { ?>
                <?php
                    echo "<p><a href='profile.php'>User</a>: ".$_SESSION['username'].' [ <a href="logout.php">Wyloguj się!</a> ]</p>';
                ?>
            <?php } else { ?>
                <div>
                    <span onclick='login()' id="login-span">Zaloguj</span>
                    <span onclick='register()' id="register-span">Zajerestruj</span>
                </div>
            <?php } ?>
        </section>

        <section>
            <div>
                <figure>
                    <img src="img/menu.png" onclick="menu()">
                </figure>
                <a href="index.php">
                    <img src="img/logo.png">
                </a>
            </div>
            <form action="search_script.php" method="post">
                <input type="text" name="phrase" placeholder="Wyszukaj książkę">
                <input type="submit" value="🔎︎">
            </form>
            <div>
                <a href="profile.php"><span>🕮 Lista wypożyczeń</span></a>
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
        <nav>
            <form action="search_script.php" method="post">
                <h2>Wyszukiwarka:</h2>
                    <p><input type="text" name="phrase"><input type="submit" value="Szukaj"></p>
                <h3>Filtry</h3>

                <p>Sortuj: 
                    <select name="sort_by">
                        <option value="ddesc">Po dacie wydania malejąco</option>
                        <option value="dasc">Po dacie wydania rosnąco</option>
                        <option value="pdesc">Po popularności malejąco</option>
                        <option value="pasc">Po popularności rosnąco</option>
                        <option value="aasc">Alfabetycznie A-Z</option>
                        <option value="adesc">Alfabetycznie Z-A</option>
                        <option value="qdesc">Po dostępności malejąco</option>
                        <option value="qasc">Po dostępności rosnąco</option>
                    </select>
                </p>

                <h3>Tagi</h3>
                <?php
                require_once "connect.php";
                $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                if ($connection->connect_errno != 0) {
                    echo "Error: " . $connection->connect_errno;
                } else {
                    $sql = "SELECT tag FROM tags GROUP BY tag ORDER BY COUNT(tag) DESC LIMIT 10";
                    $result = mysqli_query($connection, $sql);
                    if (!$result) {

                        $connection->close();
                    } else {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<p><input type='checkbox' name='tag[]' value='" . $row['tag'] . "'>" . $row['tag'] . "</p>";
                        }
                        $connection->close();
                    }
                }
                ?>

                <h3>Wydawca</h3>
                <?php
                require_once "connect.php";
                $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                if ($connection->connect_errno != 0) {
                    echo "Error: " . $connection->connect_errno;
                } else {
                    $sql = "SELECT publisher FROM books GROUP BY publisher ORDER BY COUNT(publisher) DESC LIMIT 10";
                    $result = mysqli_query($connection, $sql);
                    if (!$result) {

                        $connection->close();
                    } else {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<p><input type='checkbox' name='publisher[]' value='" . $row['publisher'] . "'>" . $row['publisher'] . "</p>";
                        }
                        $connection->close();
                    }
                }
                ?>
            </form>
        </nav>

        <section>
            <?php
            require_once "connect.php";
            $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
            if ($connection->connect_errno != 0) {
                echo "Error: " . $connection->connect_errno;
            } else {
                $sql = "SELECT DISTINCT b.id, b.title, b.isbn, b.publisher FROM books AS b, tags AS t WHERE b.id = t.book_id";
                if (isset($_GET['phrase'])) {
                    $phrase = "'%" . $_GET['phrase'] . "%'";
                    $sql .= " AND (b.title LIKE $phrase OR b.scenarist LIKE $phrase OR b.illustrator LIKE $phrase OR b.publisher LIKE $phrase OR b.isbn LIKE $phrase OR b.relese_date LIKE $phrase OR b.series LIKE $phrase OR t.tag LIKE $phrase)";
                }
                if (isset($_GET['tags'])) {
                    $sql .= " AND (t.tag='" . implode("' OR t.tag='", explode('%', $_GET['tags'])) . "')";
                }
                if (isset($_GET['publisher'])) {
                    $sql .= " AND (b.publisher='" . implode("' OR b.publisher='", explode('%', $_GET['publisher'])) . "')";
                }
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'pdesc') $sql .= " ORDER BY rented_num DESC, b.id DESC;";
                    else if ($_GET['sort'] == 'pasc') $sql .= " ORDER BY rented_num ASC, b.id DESC;";
                    else if ($_GET['sort'] == 'aasc') $sql .= " ORDER BY title ASC, b.id DESC;";
                    else if ($_GET['sort'] == 'adesc') $sql .= " ORDER BY title DESC, b.id DESC;";
                    else if ($_GET['sort'] == 'qdesc') $sql .= " ORDER BY quantity DESC, b.id DESC;";
                    else if ($_GET['sort'] == 'qasc') $sql .= " ORDER BY quantity ASC, b.id DESC;";
                    else if ($_GET['sort'] == 'ddesc') $sql .= " ORDER BY relese_date DESC, b.id DESC;";
                    else if ($_GET['sort'] == 'dasc') $sql .= " ORDER BY relese_date ASC, b.id DESC;";
                    else $sql .= " ORDER BY b.id DESC;";
                } else $sql .= " ORDER BY relese_date DESC, b.id DESC;;";
                $result = mysqli_query($connection, $sql);
                if (!$result) {

                    $connection->close();
                } else {
                    $array_rows = array();
                    while ($row = mysqli_fetch_array($result)) {
                        array_push($array_rows, $row);
                    }
                    $num_array_rows = count($array_rows);
                    if ($num_array_rows <= 0) {
                        echo "<div class='paginator'><p><b>Brak wyników wyszukiwania</b></p></div>";
                        echo "<div class='pagination'>
                        <a href='#'>&laquo;</a>
                        <a href='#' class='active'>1</a>
                        <a href='#'>&raquo;</a>
                        </div>";
                    } else {
                        echo "<div class='paginator'>";
                        $x = ($_GET['page'] - 1) * 16 + 1;
                        while ($x <= 16 * $_GET['page'] && $x <= $result->num_rows) {
                            echo "<div class='book'>
                                    <a href='book.php?id=" . $array_rows[$x - 1]['id'] . "'>
                                        <img src='Books_img/" . $array_rows[$x - 1]['isbn'] . ".jpg' onerror='this.onerror=null; this.src=\"https://via.placeholder.com/150x200\"' alt='" . $array_rows[$x - 1]['isbn'] . "' width='150' height='200'>
                                    </a>
                                    <h3>" . $array_rows[$x - 1]['title'] . "</h3>
                                    <h4>".$array_rows[$x - 1]['publisher']."</p>
                                </div>";
                            $x++;
                        }
                        echo "</div>";
                        if(ceil($num_array_rows/16)<=1){
                            echo "<div class='pagination'>
                                <a href='#'>&laquo;</a>
                                <a href='#' class='active'>1</a>
                                <a href='#'>&raquo;</a>
                            </div>";
                        }
                        else{
                            $link1 = "search.php?";
                            $link2 = "search.php?";
                            if(isset($_GET['phrase'])){
                                $link1 .= "phrase=".$_GET['phrase']."&";
                                $link2 .= "phrase=".$_GET['phrase']."&";
                            }

                            if(isset($_GET['page']) && $_GET['page']>1)
                                $link1 .= "page=".strval(intval($_GET['page'])-1)."&";
                            else
                                $link1 .= "page=".$_GET['page']."&";

                            if(isset($_GET['page']) && $_GET['page']<ceil($num_array_rows/16))
                                $link2 .= "page=".strval(intval($_GET['page'])+1)."&";
                            else
                                $link2 .= "page=".$_GET['page']."&";

                            if(isset($_GET['tags'])){
                                $link1 .= "tags=".$_GET['tags']."&";
                                $link2 .= "tags=".$_GET['tags']."&";
                            }
                            if(isset($_GET['publisher'])){
                                $link1 .= "publisher=".$_GET['publisher']."&";
                                $link2 .= "publisher=".$_GET['publisher']."&";
                            }
                            if(isset($_GET['sort'])){
                                $link1 .= "sort=".$_GET['sort']."&";
                                $link2 .= "sort=".$_GET['sort']."&";
                            }

                            echo "<div class='pagination'>
                            <a href='".$link1."'>&laquo;</a>
                            <a href='#' class='active'>".$_GET['page']."</a>
                            <a href='".$link2."'>&raquo;</a>
                            </div>";
                        }
                    }
                    $connection->close();
                }
            }
            ?>
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