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
                        <ul class='menu introtxt'></ul>
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
                            <a href='../index.php'>
                                <img src='../Media/Logo.svg ' alt='logo image '>
                            </a>
                        </div>
                        <ul class='menu introtxt'>
                            <li>
                                <a href='myteam.php '>My Team</a>
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
    <p class="titolo bigtxt">PILOTI:</p>

    <?php
        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
        if($conn->connect_error){
            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
        }

        $myquery = "SELECT Numero, NomePilota, CognomePilota, NazioneP, pilota.ValoreFinale, pilota.NomeScuderia, pilota.Foto, Colore
                    FROM pilota JOIN scuderia ON pilota.NomeScuderia = scuderia.NomeScuderia";

        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        $numero = array();
        $nome = array();
        $cognome = array();
        $nazione = array();
        $valore = array();
        $scuderia = array();
        $foto = array();
        $colore = array();

        while($row = $ris->fetch_assoc())
        {
            $numero[] = $row["Numero"];
            $nome[] = $row["NomePilota"];
            $cognome[] = $row["CognomePilota"];
            $nazione[] = $row["NazioneP"];
            $valore[] = $row["ValoreFinale"];
            $scuderia[] = $row["NomeScuderia"];
            $foto[] = $row["Foto"];
            $colore[] = $row["Colore"];
        }

        for ($temp = 0; $temp < count($numero); $temp++)
        {
            echo "<a href='pilota.php?numeropilota=$numero[$temp]' class = 'box-pilota' style = 'background-color: $colore[$temp]' input type='submit'>
                <div class = 'foto-pilota'>
                    <img src='$foto[$temp]' alt='$nome[$temp] $cognome[$temp]' >
                </div>
                <div class = 'info-pilota'>
                    <p class='bigtxt'>$nome[$temp] $cognome[$temp] $numero[$temp]</p>
                    <p class='valore bigtxt'>Valore: $valore[$temp]</p>
                    <p class='normaltxt'>$nazione[$temp]</p>
                    <p class='normaltxt'>$scuderia[$temp]</p>
                </div>
                </a>
                <br><br><br>";
        }
    ?>

    <p class="titolo bigtxt">SCUDERIE:</p>

    <?php
        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
        if($conn->connect_error){
            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
        }

        $myquery = "SELECT NomeScuderia, TPNome, TPCognome, Nazione, ValoreBase, Foto, Colore
        FROM scuderia";

        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        $nome = array();
        $cognome = array();
        $nazione = array();
        $valore = array();
        $scuderia = array();
        $foto = array();
        $colore = array();

        while($row = $ris->fetch_assoc())
        {
            $nome[] = $row["TPNome"];
            $cognome[] = $row["TPCognome"];
            $nazione[] = $row["Nazione"];
            $valore[] = $row["ValoreBase"];
            $scuderia[] = $row["NomeScuderia"];
            $foto[] = $row["Foto"];
            $colore[] = $row["Colore"];
        }

        for ($temp = 0; $temp < count($scuderia); $temp++)
        {
            echo "<a href='scuderia.php?nomescuderia=$scuderia[$temp]' class = 'box-scuderia' style = 'border: 5px solid $colore[$temp]' input type='submit'>
                <div class = 'foto-pilota'>
                    <img src='$foto[$temp]' alt='$scuderia[$temp]' >
                </div>
                <div class = 'info-scuderia'>
                    <p class='bigtxt'>$scuderia[$temp] </p>
                    <p class='valore bigtxt'>Valore: $valore[$temp]</p>
                    <p class='normaltxt'>$nazione[$temp]</p>
                    <p class='normaltxt'>$nome[$temp] $cognome[$temp]</p>
                </div>
                
                </a>
                <br><br><br>";
        }

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

<script src="../CSS/function.js"></script>
<!--------------------------------------------------- Scrollreveal --------------------------------------------------->
<script>
    ScrollReveal().reveal('.reveal', {
        easing: 'cubic-bezier(.215,.61,.355,1)',
        duration: 1500,
        distance: '500px',
    })
</script>

<!--Fatto da Varisco e Germanò-->