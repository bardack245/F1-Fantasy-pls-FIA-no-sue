<?php
    session_start();
    require('../data/connessione_db.php');

    if(isset($_SESSION['nickname'])){
		header('location: home.php');
	}

	if(isset($_POST["nickname"])){
		$nickname = $_POST["nickname"];
	}
	else{
		$nickname = "";
	}
	
	if (isset($_POST["password"])){
		$password = $_POST["password"];
	}
	else {
		$password = "";
	}
?>




<!DOCTYPE html>
<html lang="it">

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
    <link rel="shortcut icon" href="./Media/LogoR.svg" type="image/x-icon">
    <!------------------------------------------------- Scrollreveal ------------------------------------------------->
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Login</title>
</head>

<body onscroll="black_band()">
    <!------------------------------------------------- Header ------------------------------------------------->
    <div class="header__container">
        <header>
            <div class="logo">
                <a href="index.php">
                    <img src="../Media/Logo.svg " alt="logo image ">
                </a>
            </div>
            <div class="cta introtxt ">
                <a href="register.php" class="button">REGISTRATI</a>
            </div>
        </header>
    </div>

    <!------------------------------------------------- Login ------------------------------------------------->
    <div class="login">
        <h1>Accedi</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <table class="tab_input" >
                <tr>
                    <td>Nickname:</td> <td><input type="text" name="nickname" value = "<?php echo $nickname; ?>" required></td>
                </tr>
                <tr>
                    <td>Password:</td> <td><input type="password" name="password" required></td>
                </tr>
            </table>
            <p><input type="submit" value="Accedi"></p>
        </form>
    </div>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if( empty($_POST["nickname"]) or empty($_POST["password"])) {
                echo "<p>Campi lasciati vuoti</p>";
            } else {
                $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
                if($conn->connect_error){
                    die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
                }
                
                
                $myquery = "SELECT Nick, PSW 
                FROM utente 
                WHERE Nick='$nickname'
                    AND PSW='$password'";

                $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

                if($ris->num_rows == 0){
                    echo "<p>Utente non trovato o password errata</p>";
                    $conn->close();
                }
                else {
                    $_SESSION["nickname"]=$nickname;
                                            
                    $conn->close();
                    header("location: home.php");

                }
            }
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

<script src="./CSS/function.js "></script>
<!--------------------------------------------------- Scrollreveal --------------------------------------------------->
<script>
    ScrollReveal().reveal('.reveal', {
        easing: 'cubic-bezier(.215,.61,.355,1)',
        duration: 1500,
        distance: '500px',
    })
</script>