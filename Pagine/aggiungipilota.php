<?php
    session_start();
    require('../data/connessione_db.php');

    $nickname = $_SESSION["nickname"];
    $Numero = $_GET["numeropilota"];

    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);

    $myquery = "SELECT NomeSquadra
                FROM squadra
                WHERE Nick = '$nickname'";

    $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

    foreach($ris as $row){
        $NomeSquadra = $row["NomeSquadra"];
    }

    $AggiungiPilota = "UPDATE fantapartecipap
                            SET Numero = '$Numero'
                            WHERE Numero = NULL AND NomeSquadra = '$NomeSquadra'";

    if($conn->query($AggiungiPilota) === true) {
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("location: myteam.php")

?>