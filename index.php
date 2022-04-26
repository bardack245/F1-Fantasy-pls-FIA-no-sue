<?php
    session_start();
    require('data/connessione_db.php');
?>




<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!------------------------------------------------- Normalize css  ------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />
    <!------------------------------------------------- Interfont  ------------------------------------------------->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!------------------------------------------------- My css  ------------------------------------------------->
    <link rel="stylesheet" href="./CSS/style.css">
    <!------------------------------------------------- favicon ------------------------------------------------->
    <link rel="shortcut icon" href="./Media/LogoR.svg" type="image/x-icon">
    <!------------------------------------------------- Scrollreveal ------------------------------------------------->
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>F1 Fantasy</title>
</head>

<body onscroll="black_band()">
<?php
        if(!isset($_SESSION["nickname"]))
        {
            echo "<div class='header__container'>
                    <header>
                        <div class='logo'>
                            <a href='index.php'>
                                <img src='Media/Logo.svg ' alt='logo image '>
                            </a>
                        </div>
                        <ul class='menu introtxt'>
                            <li>
                                <a href='Pagine/market.php'>Market</a>
                            </li>
                        </ul>
                        <div class='cta introtxt '>
                            <a href='Pagine/login.php' class='button' >LOGIN</a>
                        </div>
                        <div class='hamburger' onclick='showhide() '>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </header>
                </div>";
        } else 
        {
            $nickname = $_SESSION['nickname'];

            echo "<div class='header__container'>
                    <header>
                        <div class='logo'>
                            <a href='index.php'>
                                <img src='Media/Logo.svg ' alt='logo image '>
                            </a>
                        </div>
                        <ul class='menu introtxt'>
                            <li>
                                <a href='Pagine/myteam.php '>My Team</a>
                            </li>
                            <li>
                                <a href='Pagine/market.php'>Market</a>
                            </li>
                        </ul>
                        <div class='cta introtxt'>
                            <a href='Pagine/account.php' class='button' >
                                $nickname
                            </a>
                        </div>
                        <div class='cta introtxt '>
                            <a href='Pagine/logout.php' class='button' >LOGOUT</a>
                        </div>
                        <div class='hamburger' onclick='showhide() '>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </header>
                </div>";
        }
    
    ?>

    <!------------------------------------------------- Content ------------------------------------------------->
    <div class="mt3"></div>

            <div class="sfondo">
                <div class="hero__content ">
                  <h1 class="title ">Benvenuto nel sito ufficiale dell'F1 Fantasy!</h1>
                </div>
            </div>

            <h1>
                Benvenuto nel sito ufficiale dell'F1 Fantasy!
            </h1>

            <h3>
                Il gioco per appassionati di F1!<br>
            </h3>
            <h2>
                ISTRUZIONI
            </h2>
            <P>
                Forma un indomito team per distruggere gli avversari e dominare il campionato!<br>
                Il team deve essere formato da cinque piloti ed una scuderia, scelti tra il circus.<br>
            </P>
            <h2>
                VALORE
            </h2>
            <p>
                Ogni giocatore e scuderia ha un valore di acquisto. Questo valore varia durante la stagione in base ai risultati delle prestazioni.<br>
            </p>
            <h2>
                PUNTEGGIO
            </h2>
            <p>
                Ogni membro del tuo team ottiene un punteggio in base ai risultati del weekend di gara!<br>
            </p>
            <h3>
                Punteggio Piloti
            </h3>
            <p>
                Il punteggio dei piloti viene cacolato come il doppio della differenza tra la posizone finale e quella in griglia. Inoltre vengono aggiunti bonus per la posizione di arrivo e di qualifica e l'arrivo prima del compagno di scuderia.<br>
            </p>
            <h3>
                Punteggio Scuderia  
            </h3>
            <p>
                Il punteggio della scuderia viene calcolato come media dei punteggi dei due piloti.<br>
            </p>
            <h2>
                VINCERE
            </h2>
            <p>
                e vincerete solamente avendo più punti degli altri!
            </p>

        </div>
    
    <!------------------------------------------------- Footer ------------------------------------------------->
    <footer class="mt3 mst3">
        <canvas id="canvas1">
        </canvas>
        <div class="creator__grid">
            <div class="creator__column">
                <div>
                    <a href="https://github.com/bardack245" target="_blank">
                        <h3 class="introtxt tw">Varisco Marco</h3>
                    </a>
                </div>
            </div>
            <div class="creator__column">
                <div>
                    <a href="https://github.com/yuukigerma" target="_blank">
                        <h3 class="introtxt tw">Germanò Matteo</h3>
                    </a>
                </div>
            </div>
        </div>
    </footer>





</body>

</html>

<script src="./CSS/function.js "></script>
<!--------------------------------------------------- Scrollreveal --------------------------------------------------->
<script>
    ScrollReveal().reveal('.reveal', {
        easing: 'cubic-bezier(.215,.61,.355,1)',
        duration: 1500,
        distance: '500px',
    })
</script>

<!--Fatto da Varisco e Germanò-->