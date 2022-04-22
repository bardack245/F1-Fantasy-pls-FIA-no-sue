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
    <title>Scuderia</title>
</head>
<body onscroll="black_band()">
    <?php require("header.php") ?>

    <div class = 'mt3'></div>
    <?php
        $scuderia = $_GET["nomescuderia"];

        $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
        if($conn->connect_error){
            die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
        }

        $myquery = "SELECT Nazione, ValoreBase, TPNome, TPCognome, Foto, Colore
                    FROM scuderia
                    WHERE '$scuderia' = NomeScuderia";
        
        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        foreach($ris as $row){
            $nome = $row["TPNome"];
            $cognome = $row['TPCognome'];
            $nazione = $row["Nazione"];
            $valore = $row["ValoreBase"];
            $foto = $row["Foto"];
            $colore = $row["Colore"];
        }

        $myquery = "SELECT PunteggioFinale
                    FROM pilota JOIN scuderia ON pilota.NomeScuderia = scuderia.NomeScuderia
                    WHERE '$scuderia' = scuderia.NomeScuderia";
        
        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

        $punteggio=array();
        foreach($ris as $row){
            $punteggio[]=$row["PunteggioFinale"];
        }

        $punteggioF = ($punteggio[0]+$punteggio[1])/2;



        echo "<div class = 'informazioni'>
                <div class='foto'>
                    <img src='$foto' alt='$scuderia'>
                </div>
                <div class = 'flex nome'>
                    <p class='bigtxt'>$scuderia</p>
                </div>
                <div class='value'>
                    <p class='bigtxt'>Valore: $valore M</p>
                    <p class='bigtxt' style = 'transform: translateX(300px)'>Punteggio: $punteggioF</p>
                </div>
                <div class='block'>
                    <p class='normaltxt'>$nazione</p>
                    <p class='normaltxt'>Team Principal: $nome $cognome</p>
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
                                    FROM gareggia JOIN pilota ON pilota.Numero = gareggia.Numero
                                    WHERE '$scuderia' = pilota.NomeScuderia";
                        
                        $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");
    
                        $data = array();
                        $punteggio = array();
                        $punti = array();
    
                        foreach($ris as $row){
                            $data[] = $row["Data"];
                            $punteggio[] = $row["Punteggio"];
                        }

                        for ($temp=0; $temp < count($data)/2; $temp++)
                        {
                            $punti[] = ($punteggio[$temp]+$punteggio[$temp+(count($data)/2)])/2;
                            echo "['$data[$temp]', $punti[$temp]],";
                        }
                    ?>
                ];
            }
        </script>
    </div>


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