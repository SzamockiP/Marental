<?php
	session_start();
    $_SESSION["last_page"]='book.php';
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="Css/book.css">
        <link rel="stylesheet" href="Css/main.css">
        <title>Manga page</title>
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
                <input type="submit" value="Zaloguj się"/>
                <span class="blad">
                    <?php
                        if(isset($_SESSION['error'])) echo $_SESSION['error'];
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
                        if (isset($_SESSION['e_register']))
                        {
                            echo $_SESSION['e_register'];
                            unset($_SESSION['e_register']);
                        }
                    ?>
                </span>
                <div><form><input type="checkbox" name="statute"> Akceptuję regulamin</form></div> 
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
                <?php if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true)) {?>
                    <?php 
                        echo "<p><a href='profile.php'>User</a>: ".$_SESSION['username'].' [ <a href="logout.php">Wyloguj się!</a> ]</p>';
                    ?>
                <?php } else {?>
                <div>    
                    <span onclick='login()' id="login-span">Zaloguj</span>
                    <span onclick='register()' id="register-span">Zajerestruj</span>
                </div> 
                <?php } ?>
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
            <section>
                <section>
                    <?php 
                        require_once "connect.php";
                        $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                        
                        if ($connection->connect_errno!=0){
                            echo "Error: ".$connection->connect_errno;
                        }    
                        else if(is_numeric($_GET['id'])){
                            $sql = sprintf("SELECT isbn FROM books WHERE id='%s'", $_GET['id']);
                            $result = mysqli_query($connection, $sql);
                            if(!$result){
                                
                                $connection->close();
                            }
                            else{
                                $row = mysqli_fetch_assoc($result);
                                echo "<img src='Books_img/".$row['isbn'].".jpg' onerror='this.onerror=null; this.src=\"https://via.placeholder.com/300x429\"' alt='".$row['isbn']."' width='300' height='429'>";
                                $connection->close();
                            }
                        }
                        else {
                            
                            $connection->close();
                        }
                    ?>
                    
                        <?php if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true)) {?>
                            <?php 
                                require_once "connect.php";
                                $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                                if ($connection->connect_errno!=0){
                                    echo "<h3><a href='.'>Wystąpił błąd - załaduj stronę ponownie</a></h3><p class='error'>Error: ".$connection->connect_errno."</p>";
                                }
                                else{
                                    $sql = "SELECT id FROM rented WHERE user_id =". $_SESSION['id']." AND book_id =". $_GET['id'];
                                    $result = mysqli_query($connection,$sql);
                                    if(!$result){
                                        $connection->close();
                                    }
                                    else{
                                        if($result -> num_rows >= 1){
                                            echo "<h3><a href='remove_book.php?book=".$_GET['id']."'>Oddaj książkę</a></h3>";
                                            if(isset($_SESSION['rent_info'])){
                                                echo "<p class='error'>".$_SESSION['rent_info']."</p>";
                                                unset($_SESSION['rent_info']);
                                            } else {
                                                echo "<p class='error'></p>";
                                            }
                                        }
                                        else{
                                            echo "<h3><a href='add_book.php?book=".$_GET['id']."'>Dodaj do listy wypożyczonych</a></h3>";
                                            if(isset($_SESSION['rent_info'])){
                                                echo "<p class='error'>".$_SESSION['rent_info']."</p>";
                                                unset($_SESSION['rent_info']);
                                            }
                                            else {
                                                echo "<p class='error'></p>";
                                            }
                                        }
                                    }
                                }
                            ?>
                        <?php } else {?>
                            <h3><span onclick='login()' id='login-span'>Zaloguj się aby wypożyczyć</span></h3>
                            <p class='error'></p>
                        <?php } ?>
                    
                </section>

                <article>
                    <?php 
                        require_once "connect.php";
                        $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                        
                        if ($connection->connect_errno!=0){
                            echo "Error: ".$connection->connect_errno;
                        }
                        else if(is_numeric($_GET['id'])){
                            $sql = sprintf("SELECT * FROM books WHERE id='%s'", $_GET['id']);
                            $result1 = mysqli_query($connection, $sql);
                            $sql = sprintf("SELECT tag FROM tags WHERE book_id='%s'", $_GET['id']);
                            $result2 = mysqli_query($connection, $sql);

                            if(!$result1 || !$result2){
                                
                                $connection->close();
                            }
                            else{
                                $_SESSION['last_page'] = "book.php?id=".$_GET['id'];

                                $row1 = mysqli_fetch_assoc($result1);
                                $tags = '';
                                while($row2 = mysqli_fetch_assoc($result2)){
                                    $tags .= $row2['tag'].", ";
                                }
                                $tags = substr($tags, 0, -2);

                                echo "<h3>".$row1['title']."</h3>
                                <p>".$row1['description']."</p>
                                <p><b>Data wydania: </b>".$row1['relese_date']."</p>
                                <p><b>Seria: </b>".$row1['series']."</p>
                                <p><b>Wydawca: </b>".$row1['publisher']."</p>
                                <p><b>Ilustrator: </b>".$row1['illustrator']."</p>
                                <p><b>Scenarzysta: </b>".$row1['scenarist']."</p>
                                <p><b>ISBN: </b>".$row1['isbn']."</p>
                                
                                <p><b>Tagi: </b>".$tags."</p>
                                ";
                                $_SESSION['series'] = $row1['series'];
                                $connection->close();
                            }
                        }
                        else {
                            
                            $connection->close();
                        }
                    ?>
                </article>
            </section>

            <section>
                <h2>Podobne książki</h2>
                <nav>
                    <?php
                        require_once "connect.php";
                        $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                        if ($connection->connect_errno!=0){
                            echo "Error: ".$connection->connect_errno;
                        }
                        else{
                            $series = $_SESSION['series'];
                            unset($_SESSION['series']);
                            $sql = "SELECT title, id, isbn FROM books WHERE series='$series' AND NOT id='".$_GET['id']."' LIMIT 6";
                            $result = mysqli_query($connection, $sql);
                            if(!$result){
                                
                                $connection->close();
                            }
                            else{
                                if($result -> num_rows <1){
                                    echo "<p><b>Nie znaleziono podobnych książek</b></p>";
                                    $connection->close();
                                }
                                else{
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<figure><a href='book.php?id=".$row['id']."'>
                                            <img src='Books_img/".$row['isbn'].".jpg' onerror='this.onerror=null; this.src=\"https://via.placeholder.com/90x120\"' alt='".$row['isbn']."' width='90' height='120'>
                                            <p>
                                            </a>
                                            ".$row['title']."
                                        </figure>";
                                    }
                                    $connection->close();
                                }
                            }
                        }
                    ?>
                </nav>
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