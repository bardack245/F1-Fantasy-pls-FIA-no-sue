<?php
    session_start();
    require('../data/connessione_db.php');

    $nickname = $_SESSION['nickname'];

    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);

    $myquery = "SELECT NomeSquadra
                FROM squadra
                WHERE Nick = '$nickname'";

    $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

    foreach($ris as $row){
        $NomeSquadra = $row["NomeSquadra"];
    }
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
    <?php require("header.php") ?>


    <div class = 'mt3'></div>
    <p class="titolo bigtxt">PILOTI:</p>

    <?php
        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
        if($conn->connect_error){
            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
        }

        $myquery = "SELECT Numero, NomePilota, CognomePilota, NazioneP, pilota.ValoreFinale, pilota.NomeScuderia, pilota.Foto, Colore
                    FROM pilota JOIN scuderia ON pilota.NomeScuderia = scuderia.NomeScuderia
                    WHERE Numero NOT IN (SELECT pilota.Numero
                                            FROM pilota JOIN fantapartecipap on pilota.Numero = fantapartecipap.Numero
                                            WHERE Nomesquadra = '$NomeSquadra')";

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
            echo "<a href='aggiungipilota.php?numeropilota=$numero[$temp]' class = 'box-pilota' style = 'background-color: $colore[$temp]' input type='submit'>
                    <table>
                        <tr>    
                            <td class='tdfoto'>
                                <div class = 'foto-pilota'>
                                    <img src='$foto[$temp]' alt='$nome[$temp] $cognome[$temp]' >
                                </div>
                            </td>    
                            <td>
                                <div class = 'info-pilota'>
                                    <p class='bigtxt'>$nome[$temp] $cognome[$temp] $numero[$temp]</p>
                                    <p class='normaltxt'>$nazione[$temp]</p>
                                    <p class='normaltxt'>$scuderia[$temp]</p>
                                </div>
                            </td>
                            <td class='tdvalore'>
                                <div class = 'info-pilota'>
                                    <p class='bigtxt'>Valore:<br>$valore[$temp] M</p>
                                </div>
                            </td>
                        </tr>    
                    </table>
                </a>
                <br><br><br>";
        }
    ?>


    <?php include("footer.php") ?>
    


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