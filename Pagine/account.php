<?php
    session_start();
    require('../data/connessione_db.php');

    if(!isset($_SESSION["nickname"]))
    {
        header("location: ../index.php");
    };

    $nickname = $_SESSION["nickname"];

    $strmodifica = "Modifica";
	$strconferma = "Conferma";

    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
	
    $myquery = "SELECT utente.Nome, utente.Cognome, utente.PSW, utente.Email
                FROM utente
                WHERE  Nick = '".$nickname."'";

    $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");
    
    foreach($ris as $row){
        $nome = $row["Nome"];
        $cognome = $row["Cognome"];
        $password = $row["PSW"];
        $email = $row["Email"];
    }
    
    
    
    
    
    
    $modifica = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pulsante_modifica"])) {
		if($_POST["pulsante_modifica"] == $strmodifica){
			$modifica = true;
		} else {
			$modifica = false;
		}

		if ($modifica == false){
			$sql = "UPDATE utente
					SET utente.PSW = '".$_POST["password"]."', utente.Nome = '".$_POST["nome"]."', utente.Cognome = '".$_POST["cognome"]."', utente.Email = '".$_POST["email"]."' 
					WHERE Nick = '".$nickname."'";
			if($conn->query($sql) === true) {
			} else {
				echo "Error updating record: " . $conn->error;
			}
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
    <?php require("header.php") ?>

    <div class="login">
        <h1 style="text-align:center;">Dati</h1>
        <div class="mt1"></div>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="width: 75%; margin: auto;">
            <table class="tab_input" >
                <tr>
                    <td class='tdlog'>Nickname:</td> <td><input type="text" name="nickname" value = "<?php echo $nickname; ?>" disabled="disabled"></td>
                </tr>
                <tr>
                    <td class='tdlog'>Password:</td> <td><input type="text" name="password" value = "<?php echo $password; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
                <tr>
                    <td class='tdlog'>Nome:</td> <td><input type="text" name="nome" value = "<?php echo $nome; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
                <tr>
                    <td class='tdlog'>Cognome:</td> <td><input type="text" name="cognome" value = "<?php echo $cognome; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
                <tr>
                    <td class='tdlog'>Email:</td> <td><input type="email" name="email" value = "<?php echo $email; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
            </table>
            <div class="mt1"></div>
            <p style="margin: auto; width: 25%">
                <input type="submit" name="pulsante_modifica" value="<?php if($modifica==false) echo $strmodifica; else echo $strconferma; ?>" class="button">
            </p>
        </form>
    </div>

    
    <?php include("footer.php") ?>


</body>
</html>

<script src="../CSS/function.js "></script>
<!--------------------------------------------------- Scrollreveal --------------------------------------------------->
<script>
    ScrollReveal().reveal('.reveal', {
        easing: 'cubic-bezier(.215,.61,.355,1)',
        duration: 1500,
        distance: '500px',
    })
</script>

<!--Fatto da Varisco e Germanò-->


    