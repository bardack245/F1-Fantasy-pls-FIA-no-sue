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
    <?php

        echo "<div class='header__container'>
                <header>
                    <div class='logo'>
                        <a href='../index.php'>
                            <img src='../Media/Logo.svg ' alt='logo image '>
                        </a>
                    </div>
                    <ul class='menu introtxt'>
                        <li>
                            <a href='Pagine/myteam.php '>My Team</a>
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
            </div>
            <div class = 'mt3'></div>";


        $sql = "SELECT Nick, PSW, Nome, Cognome, Email
                FROM utente
                WHERE Nick = '".$nickname."'";

        $ris = $conn->query($sql) or die("<p>Query fallita!</p>");
        
        $row = $ris->fetch_assoc();

    ?>

    <div class="login">
        <h1 style="width: 20%; margin: auto;">Dati</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="width: 75%; margin: auto;">
            <table class="tab_input" >
                <tr>
                    <td>Nickname:</td> <td><input type="text" name="nickname" value = "<?php echo $row["Nick"]; ?>" disabled="disabled"></td>
                </tr>
                <tr>
                    <td>Password:</td> <td><input type="text" name="password" value = "<?php echo $row["PSW"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
                <tr>
                    <td>Nome:</td> <td><input type="text" name="nome" value = "<?php echo $row["Nome"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
                <tr>
                    <td>Cognome:</td> <td><input type="text" name="cognome" value = "<?php echo $row["Cognome"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
                <tr>
                    <td>Email:</td> <td><input type="email" name="email" value = "<?php echo $row["Email"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
                </tr>
            </table>
            <p style="width: 20%; margin: auto;">
                <input type="submit" name="pulsante_modifica" value="<?php if($modifica==false) echo $strmodifica; else echo $strconferma; ?>">
            </p>
        </form>
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


    