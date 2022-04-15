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
    <!------------------------------------------------- Anychart ------------------------------------------------->
    <script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-base.min.js"></script>
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
                            <a href='../index.php'>
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

        $myquery = "SELECT Numero, NomePilota, CognomePilota, NazioneP, pilota.ValoreIniziale, pilota.ValoreFinale, PunteggioFinale, pilota.NomeScuderia, pilota.Foto, Colore
                    FROM pilota JOIN scuderia ON pilota.NomeScuderia = scuderia.NomeScuderia
                    WHERE $numero = Numero";
        
        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        foreach($ris as $row){
            $nome = $row["NomePilota"];
            $cognome = $row['CognomePilota'];
            $nazione = $row["NazioneP"];
            $valoreI = $row["ValoreIniziale"];
            $valoreF = $row["ValoreFinale"];
            $punteggioF = $row["PunteggioFinale"];
            $scuderia = $row["NomeScuderia"];
            $foto = $row["Foto"];
            $colore = $row["Colore"];
        }

        echo "<div class = 'informazioni'>
                <div class='foto'>
                    <img src='$foto' alt='$nome $cognome'>
                </div>
                <div class = 'flex nome'>
                    <p class='bigtxt'>$nome $cognome $numero</p>
                </div>
                <div class='value'>
                    <p class='bigtxt'>Valore: $valoreF M</p>
                    <p class='bigtxt' style = 'transform: translateX(300px)'>Punteggio: $punteggioF</p>
                </div>
                <div class='block'>
                    <p class='normaltxt'>$nazione</p>
                    <a href='scuderia.php?nomescuderia=$scuderia' class = 'normaltxt'>$scuderia</a>
                </div>
            </div>";

    ?>


    <!------------------------------------------------- Tabelle ------------------------------------------------->
    <div class = 'mt3'></div>
    <div id="grafico1">
        <script>
           anychart.onDocumentReady(function () {

                var dataSet = anychart.data.set(getDataPunteggio());

                var seriesData = dataSet.mapAs({ x: 0, value: 1 });

                var chart = anychart.line();

                chart.title('Variazione di punteggio');

                var lineChart = chart.line(seriesData);
                lineChart
                    .stroke(<?php echo "'3 $colore'" ?>)

                chart.container('grafico1');

                chart.draw();

           }); 


            function getDataPunteggio(){
                return [
                    <?php
                        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
                        if($conn->connect_error){
                            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
                        }
    
                        $myquery = "SELECT gareggia.Data, Punteggio
                                    FROM gareggia
                                    WHERE $numero = Numero";
                        
                        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");
    
                        $data = array();
                        $punteggio = array();
    
                        foreach($ris as $row){
                            $data[] = $row["Data"];
                            $punteggio[] = $row["Punteggio"];
                        }

                        for ($temp=0; $temp < count($data); $temp++)
                        {
                            echo "['$data[$temp]', $punteggio[$temp]],";
                        }
                    ?>
                ];
            }
        </script>
    </div>

    <div class = 'mt3'></div>
    <div id="grafico2">
    <script>
           anychart.onDocumentReady(function () {

                var dataSet2 = anychart.data.set(getDataValore());

                var seriesData2 = dataSet2.mapAs({ x: 0, value: 1 });

                var chart2 = anychart.line();

                chart2.title('Variazione di valore');

                var lineChart2 = chart2.line(seriesData2);
                lineChart2
                    .stroke(<?php echo "'3 $colore'" ?>)

                chart2.container('grafico2');

                chart2.draw();

           }); 


            function getDataValore(){
                return [
                    <?php
                        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
                        if($conn->connect_error){
                            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
                        }
    
                        $myquery = "SELECT gareggia.Data, Varvalore
                                    FROM gareggia
                                    WHERE $numero = Numero";
                        
                        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");
    
                        $data = array();
                        $punteggio = array();
    
                        foreach($ris as $row){
                            $data[] = $row["Data"];
                            $valore[] = $row["Varvalore"];
                        }
                        $dataF = $data[count($data)-1];

                        echo "['$data[0]', $valoreI],";
                        for ($temp=1; $temp < count($data)-1; $temp++)
                        {
                            echo "['$data[$temp]', $valore[$temp]],";
                        }
                        echo "['$dataF', $valoreF],";
                    ?>
                ];
            }
        </script>
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