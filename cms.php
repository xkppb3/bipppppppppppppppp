<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="glowna_style.css">
    <style>
        .expand-icon {
            margin-right: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding-left: 20px;
        }

        li {
            margin: 5px 0;
            position: relative;
        }

        li > .expand-icon {
            position: absolute;
            left: -20px;
        }

        li > a.rzecz {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <section id="sekcja_logo_ckziu">
            <img id="logo_ckziu" src="zdj/CKZIU.svg" alt="Logo Ckziu Brodnica">
        </section>
        <section id="sekcja_tytul">
            <h1 id="Naglowek">Biuletyn Informacji Publicznej</h1>
            <h2>Centrum Kształcenia Zawodowego i Ustawicznego w Brodnicy</h2>
        </section>
        <section id="sekcja_logo_bip">
            <img id="logo_bip" src="zdj/bip_logo_pomn1_grad.png" alt="Logo Biuletyn Informacji Publicznej">
        </section>
        <section id="nawigacja">
            <section id="guziki_nawigacji">
                <form id="wyszukiwarka" method="GET">
                    <input id="wyszukaj" name="wyszukaj" type="text">
                    <button id="lupa_guzik" name="lupa_guzik"><img id="lupa_ikonka" src="zdj/search-svgrepo-com.png" alt="Lupa"></button>
                    <p id="wf">Wyszukaj frazę</p>
                </form>
                <?php
                    $wynikk = null;
                    $con = new mysqli('localhost', 'root', '', 'baza_bip');
                    if (isset($_GET['wyszukaj'])) {
                        $query = $_GET['wyszukaj'];
                        $sql = "SELECT * FROM dane WHERE tytul LIKE '%$query%'";
                        $wynikk = $con->query($sql);
                    }
                ?>
                <span id="ud">
                   <button id="ulatwienia_dostepu">Ułatwienia Dostępu</button>
                   <ul id="lista" style="display: none; position: absolute;">
                    <li><button id="zwiekszanie" class="skalowanie" onclick="zwiekszenie()"><img id="zdj_zwiekszanie" src="zdj/noun-font-size-591141.png" alt="Zwiększanie">Powiększanie</button></li>
                    <li><button id="zmniejszanie" class="skalowanie" onclick="zmniejszenie()"><img id="zdj_zmniejszanie" src="zdj/noun-decrease-font-size-4866497.png" alt="zmniejszanie">Zmniejszanie</button></li>
                    <li><button class="skalowanie" onclick="podstawowy()"><img id="zdj_przywrocenie" src="zdj/font-text-icon-256.png" alt="przywrócenie">Przywrócenie</button></li>
                    <li><button class="skalowanie" onclick="daltonisci()"><img id="zdj_skala_szarosci" src="zdj/grayscale.png" alt="Skala Szarości">Skala szarości</button></li>
                    <li><button class="skalowanie" onclick="kontrast()"><img id="zdj_contrast" src="zdj/contrast.png" alt="Kontrast">Kontrast</button></li>
                   </ul>
               </span>
               <script>
                var domyslny_rozmiar = 16;
                var wysoki_kontrast = false;
                var max_rozmiar = domyslny_rozmiar * 2;
                function zwiekszenie() {
                  var zmiana_na_liczbe = parseFloat(window.getComputedStyle(document.body, null).getPropertyValue('font-size'));
                  document.documentElement.style.fontSize = (zmiana_na_liczbe * 1.2) + 'px';
                  var nowa_wielkosc = zmiana_na_liczbe * 1.2;
                  if(nowa_wielkosc >= max_rozmiar){
                    document.getElementById('zwiekszanie').disabled = true;
                  }

                  document.getElementById('zmniejszanie').disabled = false;
                }

                function zmniejszenie() {
                  var zmiana_na_liczbe = parseFloat(window.getComputedStyle(document.body, null).getPropertyValue('font-size'));
                  document.documentElement.style.fontSize = (zmiana_na_liczbe * 0.8) + 'px';
                  var nowa_wielkosc_m = zmiana_na_liczbe * 0.8;
                  if(nowa_wielkosc_m <= domyslny_rozmiar){
                    document.getElementById('zmniejszanie').disabled = true;
                  }

                  document.getElementById('zwiekszanie').disabled = false;
                }

              
                function podstawowy() {
                    document.documentElement.style.fontSize = domyslny_rozmiar + 'px';
                    document.getElementById('zwiekszanie').disabled = false;
                    document.getElementById('zmniejszanie').disabled = false;
                    document.documentElement.style.filter = 'none';
                    document.documentElement.style.backgroundColor = '';
                    document.body.style.color = '';
                    var elements = document.querySelectorAll('*');
                    elements.forEach(function(element) {
                        element.style.backgroundColor = '';
                        element.style.borderColor = '';
                        element.style.color = '';
                        element.classList.remove('kontrast-hover');
                    });
                    document.getElementById('wypisywanie_contentu').style.color = '';
                    document.getElementById('nawigacja').style.border = '';
                }
                var daltonisciEnabled = false;
                function daltonisci() {
                    if (!daltonisciEnabled) {
                        document.documentElement.style.filter = 'grayscale(100%)';
                        daltonisciEnabled = true;
                    } else {
                        document.documentElement.style.filter = '';
                        daltonisciEnabled = false;
                    }
                }
                var kontrastEnabled = false;
                function kontrast() {
                    if (!kontrastEnabled) {
                        document.documentElement.style.filter = 'none';
                        document.documentElement.style.backgroundColor = 'black';
                        document.body.style.color = 'yellow';
                        var elements = document.querySelectorAll('*');
                        elements.forEach(function(element) {
                            element.style.backgroundColor = 'black';
                            element.style.borderColor = 'yellow';
                            element.style.color = 'yellow';
                            element.classList.add('kontrast-hover');
                        });
                        document.getElementById('wypisywanie_contentu').style.color = 'yellow';
                        document.getElementById('wypisywanie_contentu').addEventListener('DOMNodeInserted', changeTextColor);
                        kontrastEnabled = true;
                    } else {
                        document.documentElement.style.filter = '';
                        document.documentElement.style.backgroundColor = '';
                        document.body.style.color = '';
                        var elements = document.querySelectorAll('*');
                        elements.forEach(function(element) {
                            element.style.backgroundColor = '';
                            element.style.borderColor = '';
                            element.style.color = '';
                            element.classList.remove('kontrast-hover');
                        });
                        document.getElementById('wypisywanie_contentu').style.color = '';
                        document.getElementById('wypisywanie_contentu').removeEventListener('DOMNodeInserted', changeTextColor);
                        kontrastEnabled = false;
                    }
                }
                function changeTextColor(event) {
                    if (kontrastEnabled) {
                        var target = event.target;
                        target.style.color = 'yellow';
                    }
                }
              </script>
               <script>
                   document.getElementById('ulatwienia_dostepu').addEventListener('click', function() {
                       var lista = document.getElementById('lista');
                       if (lista.style.display == 'none') {
                           lista.style.display = 'block';
                       } else {
                           lista.style.display = 'none';
                       }
                   });
               </script>
            </section>

            <span id="span_logowanie">
                <button id="zaloguj"><a href="zaloguj.php"><img id="ikonka_logowania" src="zdj/wywalaj.png" alt="Zaloguj"></a></button>
                <script>
                    document.getElementById('ikonka_logowania').addEventListener('mouseover', function() {
                        this.src = 'zdj/wywalaj.png';
                    });

                    document.getElementById('ikonka_logowania').addEventListener('mouseout', function() {
                        this.src = 'zdj/wywalaj.png';
                    });
                </script>
            </span>
            
        </section>
        <section id="mapa">

        </section>
    </header>
    <main>
        <section id="podzial_maina">
            <div class="lista_hierarchiczna">
                <div class="lista_rozwijana" id="lista_rozwijana">
                    
                <form method="POST">
                        <input type="text" name="nazwa" id="zuzia">
                        <input type="submit" value="DODAJ" name="dodajjj">
                    </form>
                        <?php
                        if (isset($_POST['dodajjj'])) {
                            $nazwa =  $_POST['nazwa'];
                            $con = new mysqli("localhost", "root", "", "baza_bip");
                            $sql = "INSERT INTO dane (tytul) VALUES ('$nazwa')";
                            mysqli_query($con, $sql);
                        }
                         ?>
                    <?php
                        $con = new mysqli("localhost", "root", "", "baza_bip");
                        function generowanie_listy($rodzic, $con, $czy_zakorzenione = false) {
                            $sql = "SELECT ID, tytul, content FROM dane WHERE rodzic " . ($rodzic ? "= $rodzic" : "IS NULL");
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                echo '<ul' . ($czy_zakorzenione ? '' : ' style="display:none"') . '>';
                                while($wiersz = $result->fetch_assoc()) {
                                    $sql1 = "SELECT COUNT(*) as count FROM dane WHERE rodzic = " . $wiersz['ID'];
                                    $wynik1 = $con->query($sql1);
                                    $wiersz1 = $wynik1->fetch_assoc();
                                    $czy_ma = $wiersz1['count'] > 0;
                                    echo '<li>';
                                    echo '<span class="expand-icon">+</span>';
                                    echo '<a href="javascript:void(0)" class="rzecz" dane-content="' . htmlspecialchars($wiersz['content']) . '" dane-id="' . $wiersz['ID'] . '">' . htmlspecialchars($wiersz['tytul']) . '</a>';
                                    echo ' <a href="edit.php?id=' . $wiersz['ID'] . '" class="edit-btn">Edytuj</a>';
                                    echo ' <a href="usun.php?id=' . $wiersz['ID'] . '" class="edit-btn">usuń</a>';
                                    echo '<a href="add.php?parent=' . htmlspecialchars($wiersz['ID']) . '" class="add-btn">Dodaj</a>';
                                   
                                    generowanie_listy($wiersz['ID'], $con);
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                        }
                        generowanie_listy(null, $con, true);
                        
                    ?>
                     </div>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['usun']) && !empty($_POST['usun'])) {
                    $z = $_POST['usun'];
                    $con = new mysqli("localhost", "root", "", "baza_bip");
                    $sql ="DELETE FROM `dane` WHERE `dane`.`ID` = $z";
                    mysqli_query($con, $sql);

                }
            }
            ?>
            <section id="content">
                <div id="wypisywanie_contentu" class="wypisywanie_contentu">
                    <?php 
                        if ($wynikk != null && $wynikk -> num_rows > 0) {
                            while($wierszz = $wynikk->fetch_assoc()) {
                                echo "<a class='wyszukanie' href='cms.php?id=" . $wierszz["ID"] . "'>" . $wierszz["tytul"] . "</a><br>";
                            }
                        } 
                        if(isset($_GET['id'])) {
                            $idd = $_GET['id'];
                            $sql = "SELECT content FROM dane WHERE ID = $idd";
                            $wyn = mysqli_query($con, $sql);
                            $row = mysqli_fetch_row($wyn);
                            echo $row[0];
                        }
                        $con->close();
                    ?>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        function ukryj_podstrony() {
                            const podstrony = document.querySelectorAll('.podkontener');
                            podstrony.forEach(podstrona => {
                                podstrona.style.display = 'none';
                            });
                        }

                        document.querySelectorAll('.expand-icon').forEach(icon => {
                            icon.addEventListener('click', function() {
                                const sublist = this.parentElement.querySelector('ul');
                                if (sublist) {
                                    sublist.style.display = sublist.style.display == 'none' ? 'block' : 'none';
                                    this.textContent = this.textContent == '+' ? '-' : '+';
                                }
                            });
                        });

                        function schowaj_rodzice_podstrony(element) {
                            const rodzice_podstrony = element.parentElement.querySelectorAll('.podkontener');
                            rodzice_podstrony.forEach(podstrona => {
                                podstrona.style.display = 'none';
                            });
                        }

                        document.querySelectorAll('.rzecz').forEach(rzecz => {
                            rzecz.addEventListener('click', function() {
                                ukryj_podstrony();
                                const podkontener = this.nextElementSibling;
                                if (podkontener && podkontener.tagName == 'UL') {
                                    podkontener.style.display = podkontener.style.display == 'none' ? 'block' : 'none';
                                }
                                schowaj_rodzice_podstrony(this);
                                const content = this.getAttribute('dane-content');
                                document.getElementById('wypisywanie_contentu').innerHTML = content;
                            });
                        });

                        document.getElementById('dodajZakladkeBtn223').addEventListener('click', function() {
                            const nowaZakladka = prompt('Wpisz tytuł nowej zakładki:');
                            if (nowaZakladka) {
                                const ul = document.querySelector('.lista_rozwijana > ul');
                                const newLi = document.createElement('li');
                                const newExpandIcon = document.createElement('span');
                                newExpandIcon.classList.add('expand-icon');
                                newExpandIcon.textContent = '+';
                                const newLink = document.createElement('a');
                                newLink.classList.add('rzecz');
                                newLink.href = 'javascript:void(0)';
                                newLink.textContent = nowaZakladka;
                                const editBtn = document.createElement('a');
                                editBtn.href = '#';
                                editBtn.classList.add('edit-btn');
                                editBtn.textContent = 'Edytuj';
                                const addBtn = document.createElement('a');
                                addBtn.href = '#';
                                addBtn.classList.add('add-btn');
                                addBtn.textContent = 'Dodaj';
                                newLi.appendChild(newExpandIcon);
                                newLi.appendChild(newLink);
                                newLi.appendChild(editBtn);
                                newLi.appendChild(addBtn);
                                ul.appendChild(newLi);

                                // Dodaj nowe event listenery do nowych elementów
                                newExpandIcon.addEventListener('click', function() {
                                    const sublist = this.parentElement.querySelector('ul');
                                    if (sublist) {
                                        sublist.style.display = sublist.style.display == 'none' ? 'block' : 'none';
                                        this.textContent = this.textContent == '+' ? '-' : '+';
                                    }
                                });

                                newLink.addEventListener('click', function() {
                                    ukryj_podstrony();
                                    const podkontener = this.nextElementSibling;
                                    if (podkontener && podkontener.tagName == 'UL') {
                                        podkontener.style.display = podkontener.style.display == 'none' ? 'block' : 'none';
                                    }
                                    schowaj_rodzice_podstrony(this);
                                    const content = this.getAttribute('dane-content');
                                    document.getElementById('wypisywanie_contentu').innerHTML = content;
                                });
                            }
                        });
                    });
                </script>
            </section>
        </section>
    </main>
    <footer>
        <section id="f1">
           <a href=""><h5>Kontakt</h5></a> 
            Powiatowe Centrum Obsługi w Brodnicy <br>
            Zamkowa 13/a <br>
            87-300 Brodnica <br>
            tel.: 56 6498242 <br>
            56 6498243 <br>
            email: pco@brodnica.com.pl <br>
            <a href="">Znajdź nas na mapie</a>
        </section>
        <section id="f2">
            <h5>Przydatne Informacje</h5>
            <ul>
                <li><a href="">Redukcja</a></li>
                <li><a href="">Rejestr zmian</a></li>
                <li><a href="">Mapa serwisu</a></li>
                <li><a href="">Ostatnie zmiany</a></li>
                <li><a href="">Instrukcja obsługi</a></li>
                <li><a href="">Administracja</a></li>
                <li><a href="">Deklaracja dostępności</a></li>
                <li><a href="">BIP</a></li>
            </ul>
        </section>
        <section id="f3">
            <h5>Prawo</h5>
            <ul>
                <li><a href="">Dostęp do informacji</a></li>
                <li><a href="">Podstawy Prawa</a></li>
                <li><a href="">Polityka Prywatności</a></li>
                <li><a href="">deklaracja dostępności</a></li>
            </ul>
        </section>
        <section id="f4">
            <h5>Ułatwienia dostępu</h5>
            <ul>
                <li><a href="">Instrukcja</a></li>
                <li><a href="">Skróty klawiszowe</a></li>
                <li><a href="">Ostatnio dodane</a></li>
            </ul>
        </section>
    </footer>
</body>

</html>
