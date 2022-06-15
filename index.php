<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo.svg" />
    <title>Homepage</title>
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
        <a class="navi" href="#">Recipes</a>
        <a class="navi" href="/diary/index.php">Diary</a>
        <a class="navi-active" href="#">Home</a>
    </div>
    <div class="navbar-bg"></div>

    <!--Body-->
    <div class="homecontainer">
        <img class="shopping-cart"
            src="https://media.istockphoto.com/photos/shopping-cart-with-different-food-products-picture-id1306977521?k=20&amp;m=1306977521&amp;s=612x612&amp;w=0&amp;h=NJJ94GJUHayAjWSF86M3TaQZaCdkmy9WvtWIchsyQ1E=">
        <div class="text-box">
            <h1>Nutrition<br>
                <p>Tracking</p> Made <br>Easy!
            </h1>
        </div>
        <div class="circle"></div>
    </div>
    <!--Boxes-->
    <div class="boxes">
        <div class="firstbox"></div>
        <div class="secondbox"></div>
    </div>

    <!--Footer-->

    <div class="footer">
        <p>Food Diary</p>
        <p>Abschlussprojekt von Bianka Zieba</p>
        <p>ZLI 2021/2022</p>
    </div>
    <script src="assets/script.js"></script>
</body>

</html>