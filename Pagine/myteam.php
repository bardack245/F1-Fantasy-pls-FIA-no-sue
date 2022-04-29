<?php
    session_start();
    require('../data/connessione_db.php');

    if(!isset($_SESSION["nickname"]))
    {
        header("location: ../index.php");
    };

    $nickname = $_SESSION["nickname"];

    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pulsante_inserisci"])) {
        $NomeSquadra = $_POST["nomesquadra"];
        $CreaSquadra = "INSERT INTO squadra (NomeSquadra) VALUES
                        ('$NomeSquadra')";
        
        if($conn->query($CreaSquadra) === true) {
		} else {
			echo "Error updating record: " . $conn->error;
		}

        $CreaSquadra2 = "UPDATE squadra
                        SET Nick = '$nickname'
                        WHERE NomeSquadra = '$NomeSquadra'";

        if($conn->query($CreaSquadra2) === true) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
		
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminapilota"])) {

        $numeropilota = $_POST["numero"];
        $NomeSquadra = $_POST["nomesquadra"];

        $EliminaPilota = "DELETE FROM fantapartecipap
                            WHERE Numero = '$numeropilota' AND Nomesquadra = '$NomeSquadra'";

        if($conn->query($EliminaPilota) === true) {
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminascuderia"])) {

        $scuderia = $_POST["scuderia"];
        $NomeSquadra = $_POST["nomesquadra"];

        $EliminaScuderia = "DELETE FROM fantapartecipas
                            WHERE NomeScuderia = '$scuderia' AND Nomesquadra = '$NomeSquadra'";

        if($conn->query($EliminaScuderia) === true) {
		} else {
			echo "Error updating record: " . $conn->error;
		}
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
    <title>My Team</title>
</head>
<body onscroll="black_band()">
    <?php require("header.php");


        
        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
        if($conn->connect_error){
            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
        }

        $myquery = "SELECT squadra.NomeSquadra, fantapartecipap.Numero, NomePilota, CognomePilota, NazioneP, pilota.ValoreFinale, pilota.NomeScuderia, pilota.Foto, Colore
                    FROM utente JOIN squadra ON utente.Nick = squadra.Nick JOIN fantapartecipap ON squadra.NomeSquadra = fantapartecipap.Nomesquadra JOIN pilota ON fantapartecipap.Numero = pilota.Numero JOIN scuderia ON pilota.NomeScuderia = scuderia.NomeScuderia
                    WHERE '$nickname' = utente.Nick";

        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        $numero = array();
        $nome = array();
        $cognome = array();
        $nazione = array();
        $valore = array();
        $scuderia = array();
        $foto = array();
        $colore = array();

        foreach($ris as $row){
            $NomeSquadra = $row["NomeSquadra"];
            $numero[] = $row["Numero"];
            $nome[] = $row["NomePilota"];
            $cognome[] = $row["CognomePilota"];
            $nazione[] = $row["NazioneP"];
            $valore[] = $row["ValoreFinale"];
            $scuderia[] = $row["NomeScuderia"];
            $foto[] = $row["Foto"];
            $colore[] = $row["Colore"];

        }

        $sql = "SELECT squadra.NomeSquadra
                FROM squadra
                WHERE '$nickname' = Nick";

        $ris = $conn->query($sql) or die("<p>Query fallita! ".$conn->error."</p>");

        $NomeSquadra = NULL;
        foreach($ris as $row){
            $NomeSquadra = $row["NomeSquadra"];
        }

        if($NomeSquadra != NULL){
            echo "<div class = 'mt3'</div>
                <h1 class = 'titolo bigtxt'>$NomeSquadra</h1>";
        } else {
            echo "<div class = 'mt3'</div>
                <h1 style='width: 20%; margin: auto;'>Nome della squadra:</h1>
                <form action=\"$_SERVER[PHP_SELF]\" method='post' style='width: 75%; margin: auto;'>
                    <table class='tab_input'>
                        <tr>
                            <td>Nome Squadra:</td> <td><input type='text' name='nomesquadra' required></td>
                        </tr>
                    </table>
                    <p style='width: 20%; margin: auto;'>
                        <input type='submit' name='pulsante_inserisci' value='Inserisci'>
                    </p>
                </form>
                <div class = 'mt1'></div>";
        }
        

        for ($temp = count($numero); $temp < 5; $temp++){
            echo "<a href='piloti.php' class = 'box-pilota' input type='submit'>
            <p class = 'normaltxt' style = 'text-align: center'>Aggiungi pilota</p> <br>
            <p class = 'bigtxt' style = 'text-align: center'>+</p>
            </a>
            <br><br><br>";    
        }

        for ($temp = 0; $temp < count($numero); $temp++)
        {
            echo "<div class = 'box-pilota' style = 'background-color: $colore[$temp]'>
            <table class='team'>
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
                    <td class='tdbutton'>
                    <form action=\"$_SERVER[PHP_SELF]\" method='post' style = 'display: block'>
                        <p>
                            <input type='submit' name='eliminapilota' value='X' style='border-color: $colore[$temp]; color: $colore[$temp]'>
                            <input type='hidden' name='numero' value='$numero[$temp]'>
                            <input type='hidden' name='nomesquadra' value='$NomeSquadra'>
                        </p>
                    </form>
                    </td>
                </tr>    
            </table>
            </div>
            <br><br><br>";    
        }

        $myquery = "SELECT squadra.NomeSquadra, scuderia.NomeScuderia, TPNome, TPCognome, Nazione, ValoreBase, Foto, Colore
                    FROM utente JOIN squadra ON utente.Nick = squadra.Nick JOIN fantapartecipas ON squadra.NomeSquadra = fantapartecipas.NomeSquadra JOIN scuderia ON fantapartecipas.NomeScuderia = scuderia.NomeScuderia
                    WHERE '$nickname' = utente.Nick";

        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        $scuderia = NULL;
        foreach($ris as $row)
        {
            $nome = $row["TPNome"];
            $cognome = $row["TPCognome"];
            $nazione = $row["Nazione"];
            $valore = $row["ValoreBase"];
            $scuderia = $row["NomeScuderia"];
            $foto = $row["Foto"];
            $colore = $row["Colore"];
        }

        if($scuderia != NULL){
            echo "<div class = 'box-scuderia' style = 'border: 5px solid $colore'>
            <table class='team'>
                <tr>
                <td class='tdfoto'>
                    <div class = 'foto-pilota'>
                        <img src='$foto' alt='$scuderia' >
                    </div>
                </td>
                <td>
                    <div class = 'info-scuderia'>
                        <p class='bigtxt'>$scuderia</p>
                        <p class='normaltxt'>$nazione</p>
                        <p class='normaltxt'>$nome $cognome</p>
                    </div>
                </td>
                <td class='tdvalore'>
                    <div class = 'info-scuderia'>
                        <p class='bigtxt'>Valore:<br>$valore M</p>
                    </div>
                </td>
                <td class='tdbutton'>
                    <form action=\"$_SERVER[PHP_SELF]\" method='post' style = 'display: block'>
                    <p>
                    <input type='submit' name='eliminascuderia' value='X' style='border-color: $colore; color: $colore'>
                    <input type='hidden' name='nomesquadra' value='$NomeSquadra'>
                    <input type='hidden' name='scuderia' value='$scuderia'>
                    </p>
                    </form>
                </td>
                </tr>
            </table>
            </div>
                <br><br><br>";
        } else{
            echo "<a href='scuderie.php' class = 'box-scuderia' style = 'border: 5px solid black' input type='submit'>
                <p class = 'normaltxt' style = 'text-align: center'>Aggiungi scuderia</p> <br>
                <p class = 'bigtxt' style = 'text-align: center'>+</p>
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