<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylelogowanieprawdziwe.css">
</head>
<body>
    <header>
        <section id="pwrts">
            <button id="pwrt"><img id="strzalka_powrotna" src="zdj/back.png" alt="strzałka powrotna"></button>
        </section>
        <section id="tytuly">
            <h1 id="Naglowek">Biuletyn Informacji Publicznej: Logowanie</h1>
            <h2>Centrum Kształcenia Zawodowego i Ustawicznego w Brodnicy</h2>
        </section>
        <section id="zdjecie_logo">
            <img src="zdj/bip_logo_pomn1_grad.png" alt="Logo BIP">
        </section>
    </header>
    <main>
    <div id="formularz_logowania">
        <img src="zdj/CKZIU.svg" alt="Logo CKZiU" id="ckziu">
        <form action="logowanie.php" method="POST" id="formularz">
            <input type="text" name="nazwa" id="nazwa1" placeholder="Login">
            <input type="password" name="haslo" id="haslo1" placeholder="Hasło">
            <a href="s"><img id="przekreslone_oko" src="zdj/eye-password-hide-svgrepo-com.svg" alt=""></a>
            <button name="za" id="wyslij">Zaloguj się</button>
        </form>
    </div>
    <script>
            document.querySelector('a').addEventListener('click', function(e){
            e.preventDefault();
            w=document.getElementById('haslo1');
            if(w.type == 'password') {
            w.type = 'text';
            this.innerHTML = '<img id="oko" src="zdj/eye-password-show-svgrepo-com.svg" alt="">';
            } else {
            w.type = 'password';
            this.innerHTML = '<img id="oko" src="zdj/eye-password-hide-svgrepo-com.svg" alt="">';
            } 
        })
        document.getElementById('pwrt').addEventListener('click', function() {
            window.location.href = 'index.php';
        });
    </script>
    </main>
</body>
</html>
