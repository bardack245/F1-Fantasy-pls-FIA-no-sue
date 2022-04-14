<?php
    session_start();
    require('../data/connessione_db.php');
?>

<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="../CSS/style.css">
    <!------------------------------------------------- favicon ------------------------------------------------->
    <link rel="shortcut icon" href="../Media/LogoR.svg" type="image/x-icon">
    <!------------------------------------------------- Scrollreveal ------------------------------------------------->
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Market</title>
</head>
<body onscroll="black_band()">
    <?php
        if(!isset($_SESSION["nickname"]))
        {
            echo "<div class='header__container'>
                    <header>
                        <div class='logo'>
                            <a href='../index.php'>
                                <img src='../Media/Logo.svg ' alt='logo image '>
                            </a>
                        </div>
                        <ul class='menu introtxt'>
                            <li>
                                <a href='market.php '>Market</a>
                            </li>
                        </ul>
                        <div class='cta introtxt '>
                            <a href='login.php' class='button' >LOGIN</a>
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
                            <a href='home.php'>
                                <img src='../Media/Logo.svg ' alt='logo image '>
                            </a>
                        </div>
                        <ul class='menu introtxt'>
                            <li>
                                <a href='myteam.php '>My Team</a>
                            </li>
                            <li>
                                <a href='market.php '>Market</a>
                            </li>
                        </ul>
                        <div class='cta introtxt'>
                            <a href='account.php' class='button' >
                                $nickname
                            </a>
                        </div>
                        <div class='cta introtxt '>
                            <a href='logout.php' class='button' >LOGOUT</a>
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

    <div class = 'mt3'></div>
    <?php
        $numero = $_GET["numeropilota"];

        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
        if($conn->connect_error){
            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
        }

        $myquery = 'SELECT Numero, NomePilota, CognomePilota, NazioneP, pilota.ValoreIniziale, pilota.ValoreFinale, pilota.NomeScuderia, pilota.Foto, Colore
                    FROM pilota JOIN scuderia ON pilota.NomeScuderia = scuderia.NomeScuderia
                    WHERE "$numero" = Numero';
        
        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        $nome = $ris["NomePilota"];
        $cognome = $ris["CognomePilota"];
        $nazione = $ris["NazioneP"];













    ?>







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