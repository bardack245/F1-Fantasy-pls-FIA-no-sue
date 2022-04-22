<?php
    session_start();
    require('data/connessione_db.php');
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
    <link rel="stylesheet" href="./CSS/style.css">
    <!------------------------------------------------- favicon ------------------------------------------------->
    <link rel="shortcut icon" href="./Media/LogoR.svg" type="image/x-icon">
    <!------------------------------------------------- Scrollreveal ------------------------------------------------->
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>F1 Fantasy</title>
</head>

<body onscroll="black_band()">
<?php
        if(!isset($_SESSION["nickname"]))
        {
            echo "<div class='header__container'>
                    <header>
                        <div class='logo'>
                            <a href='index.php'>
                                <img src='Media/Logo.svg ' alt='logo image '>
                            </a>
                        </div>
                        <ul class='menu introtxt'>
                            <li>
                                <a href='Pagine/market.php'>Market</a>
                            </li>
                        </ul>
                        <div class='cta introtxt '>
                            <a href='Pagine/login.php' class='button' >LOGIN</a>
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
                            <a href='index.php'>
                                <img src='Media/Logo.svg ' alt='logo image '>
                            </a>
                        </div>
                        <ul class='menu introtxt'>
                            <li>
                                <a href='Pagine/myteam.php '>My Team</a>
                            </li>
                            <li>
                                <a href='Pagine/market.php'>Market</a>
                            </li>
                        </ul>
                        <div class='cta introtxt'>
                            <a href='Pagine/account.php' class='button' >
                                $nickname
                            </a>
                        </div>
                        <div class='cta introtxt '>
                            <a href='Pagine/logout.php' class='button' >LOGOUT</a>
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

    

    
    <?php include("Pagine/footer.php") ?>



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