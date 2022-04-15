<?php
    if(isset($_POST["nickname"])) $nickname = $_POST["nickname"];  else $nickname = "";
    if(isset($_POST["password"])) $password = $_POST["password"];  else $password = "";
    if(isset($_POST["conferma"])) $conferma = $_POST["conferma"];  else $conferma = "";
    if(isset($_POST["nome"])) $nome = $_POST["nome"];  else $nome = "";
    if(isset($_POST["cognome"])) $cognome = $_POST["cognome"];  else $cognome = "";
    if(isset($_POST["email"])) $email = $_POST["email"];  else $email = "";
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
    <link rel="shortcut icon" href="../Media/LogoR.svg" type="image/x-icon">
    <!------------------------------------------------- Scrollreveal ------------------------------------------------->
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Login</title>
</head>

<body onscroll="black_band()">
    <!------------------------------------------------- Header ------------------------------------------------->
    <div class="header__container">
        <header>
            <div class="logo">
                <a href="../index.php">
                    <img src="../Media/Logo.svg " alt="logo image ">
                </a>
            </div>
            <ul class="menu introtxt"></ul>
            <div class="cta introtxt ">
                <a href="login.php" class="button">LOGIN</a>
            </div>
        </header>
    </div>

    <!------------------------------------------------- Register ------------------------------------------------->
    <div class="login">
        <h1 style="width: 20%; margin: auto;">Registrati</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="width: 75%; margin: auto;">
            <table class="tab_input" >
                <tr>
                    <td>Nickname:</td> <td><input type="text" name="nickname" value = "<?php echo $nickname; ?>" required></td>
                </tr>
                <tr>
                    <td>Password:</td> <td><input type="password" name="password" value = "<?php echo $password; ?>" required></td>
                </tr>
                <tr>
                    <td>Conferma PSW:</td> <td><input type="password" name="conferma" value = "<?php echo $conferma; ?>" required></td>
                </tr>
                <tr>
                    <td>Nome:</td> <td><input type="text" name="nome" value = "<?php echo $nome; ?>" required></td>
                </tr>
                <tr>
                    <td>Cognome:</td> <td><input type="text" name="cognome" value = "<?php echo $cognome; ?>" required></td>
                </tr>
                <tr>
                    <td>Email:</td> <td><input type="email" name="email" value = "<?php echo $email; ?>" required></td>
                </tr>
            </table>
            <p style="width: 20%; margin: auto;"><input type="submit" value="Registrati"></p>
        </form>
    </div>

    <?php
        if(isset($_POST["nickname"]) and isset($_POST["password"])) {
            if ($_POST["nickname"] == "" or $_POST["password"] == "") {
                echo "nickname e password non possono essere vuoti!";
            } elseif ($_POST["password"] != $_POST["conferma"]){
                echo "Le password inserite non corrispondono";
            } else {
                $conn = new mysqli("localhost","root","","f1_fantasy");
                if($conn->connect_error){
                    die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
                }
                
                $myquery = "SELECT Nick
                FROM utente 
                WHERE Nick = '". $_POST["nickname"] ."'";

                $ris = $conn->query($myquery) or die("<p>Query fallita! ".$conn->error."</p>");

                if($ris->num_rows != 0){
                    echo "<p>Questo nickname è già stato utilizzato";
                    $conn->close();
                }
                else {
                    $myquery = "INSERT INTO utente (Nick, PSW, Nome, Cognome, Email)
                                VALUES ('$nickname', '$password', '$nome', '$cognome', '$email')";
                    
                    if ($conn->query($myquery) === true) {
                        session_start();
                        $_SESSION["nickname"]=$nickname;
                                    
                        $conn->close();
        
                            echo "Registrazione effettuata con successo!<br>sarai ridirezionato alla home tra 2 secondi.";
                            header('Refresh: 2; URL=../index.php');
                        } else {
                                echo "Non è stato possibile effettuare la registrazione per il seguente motivo: " . $conn->error;
                        }

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