<?php
	session_start();
    $_SESSION["last_page"]='index.php';
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="Css/index.css">
        <link rel="stylesheet" href="Css/main.css">
        <title>Marental</title>
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
                <li><a href="search.php?page=1&tags=Okruchy-życia">Okruchy-życia</a></li>
                <li><a href="search.php?page=1&tags=Romans">Romans</a></li>
                <li><a href="search.php?page=1&tags=Przygodowa">Przygodowa</a></li>
                <li><a href="search.php?page=1&tags=Fantastyka">Fantastyka</a></li>
                <li><a href="search.php?page=1&tags=Harem">Harem</a></li>
                <li><a href="search.php?page=1&tags=Girls-love">Girls-love</a></li>
                <li><a href="search.php?page=1&tags=Dramat">Dramat</a></li>
                <li><a href="search.php?page=1&tags=Ecchi">Ecchi</a></li>
                <li><a href="search.php?page=1&tags=Josei">Josei</a></li>
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
                <aside>
                    <ul>
                        <li><a href="search.php?page=1&publisher=Waneko">Waneko</a></li>
                        <li><a href="search.php?page=1&publisher=Studio+JG">Studio JG</a></li>
                        <li><a href="search.php?page=1&publisher=JPF+-+Japonica+Polonica+Fantastic">JPF</a></li>
                        <li><a href="search.php?page=1&publisher=Dango">Dango</a></li>
                        <li><a href="search.php?page=1&publisher=Kotori">Kotori</a></li>
                        <li><a href="search.php?page=1&publisher=Osiem+macek">Osiem macek</a></li>
                        <li><a href="search.php?page=1&publisher=Hanami">Hanami</a></li>
                        <li><a href="search.php?page=1&publisher=Anna+Maria+Sutkowska">A.M.S.</a></li>
                        <li><a href="search.php?page=1&publisher=Nekokurage">Nekokurage</a></li>
                    </ul>
                </aside>

                <section>
                    <nav>
                        <div class="mySlides fade">
                            <div class="numbertext">1 / 5</div>
                            <a href="http://jachciarze.pl/" target="_blank"><img src="img/2.png" style="width:100%"></a>
                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext">2 / 5</div>
                            <a><img src="img/3.png" style="width:100%"></a>
                        </div>
        
                        <div class="mySlides fade">
                            <div class="numbertext">3 / 5</div>
                            <a href="http://jachciarze.pl/" target="_blank"><img src="img/4.png" style="width:100%"></a>
                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext">4 / 5</div>
                            <a href="http://marental.cba.pl/book.php?id=184"><img src="img/5.png" style="width:100%"></a>
                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext">5 / 5</div>
                            <a><img src="img/1.png" style="width:100%"></a>
                        </div>
        
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </nav>
                    <br>
    
                    <div style="text-align:center">
                        <span class="dot" onclick="currentSlide(1)"></span>
                        <span class="dot" onclick="currentSlide(2)"></span>
                        <span class="dot" onclick="currentSlide(3)"></span>
                        <span class="dot" onclick="currentSlide(4)"></span>
                        <span class="dot" onclick="currentSlide(5)"></span>
                    </div>
                </section>
            </section>

            <aside>
                <h1>Polecane książki:</h1>
            </aside>

            <section>
            <?php

                require_once "connect.php";
                $connection = @new mysqli($db_host, $db_user, $db_password, $db_name);
$connection->set_charset('utf8');
                if ($connection->connect_errno!=0){
                    echo "Error: ".$connection->connect_errno;
                }
                else{
                    $sql = "SELECT id, title, publisher, isbn, description FROM books ORDER BY rented_num DESC, title ASC LIMIT 10";
                    $result = mysqli_query($connection,$sql);
                    if(!$result){
                        $connection->close();
                    }
                    else{
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<div>
                                    <a href='book.php?id=" . $row['id'] . "'>
                                    <img src='Books_img/".$row['isbn'].".jpg' onerror='this.onerror=null; this.src=\"https://via.placeholder.com/90x120\"' alt='".$row['isbn']."' width='90' height='120'>
                                    </a>
                                    <div>
                                        <h3>" . $row["title"] . "</h3>
                                        <h4>" . $row["publisher"] . "</h4>
                                        <span>" . implode(" ",array_slice(explode(" ",$row["description"]),0,15)) . "...</span>
                                    </div>
                                </div>";
                        }
                        $connection -> close();
                    } 
                }
                // dupa
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
        <script src="JavaScript/slider.js"></script>
    </body>
</html>


