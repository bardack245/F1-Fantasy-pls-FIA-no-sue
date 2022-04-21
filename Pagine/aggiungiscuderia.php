<?php
    session_start();
    require('../data/connessione_db.php');

    $nickname = $_SESSION["nickname"];
    $NomeScuderia = $_GET["nomescuderia"];

    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);

    $myquery = "SELECT NomeSquadra
                FROM squadra
                WHERE Nick = '$nickname'";

    $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

    foreach($ris as $row){
        $NomeSquadra = $row["NomeSquadra"];
    }

    $AggiungiScuderia = "UPDATE fantapartecipas
                            SET NomeScuderia = '$NomeScuderia'
                            WHERE NomeSquadra = '$NomeSquadra'";

    if($conn->query($AggiungiScuderia) === true) {
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("location: myteam.php")

?>