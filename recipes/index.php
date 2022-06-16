<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo.svg" />
    <title>Recipes</title>
</head>

<body>
    <!--Navbar-->
    <div id="navbar">
        <img id="logo" src="/assets/img/logo3.svg">
        <a class="navi" href="/login/index.php">
            <?php
            session_start();
            if (isset($_SESSION['login'])) {
                echo ('<a class="navi" href="/login/logout.php">Log out</a>');
            } else {
                echo ('<a class="navi" href="/login/index.php">Log in</a>');
            } ?>
        </a>
        <a class="navi-active" href="/recipes/index.php">Recipes</a>
        <a class="navi" href="/diary/index.php">Diary</a>
        <a class="navi" href="/index.php">Home</a>
    </div>
    <div class="navbar-bg"></div>

    <div class="recipes">
        <div class="recipe1"></div>
        <div class="recipe2"></div>
        <div class="recipe3"></div>
        <div class="recipe4"></div>
    </div>


    <div class="footer">
        <p>Food Diary</p>
        <p>Abschlussprojekt von Bianka Zieba</p>
        <p>ZLI 2021/2022</p>
    </div>
    <script src="script.js"></script>
</body>

</html>