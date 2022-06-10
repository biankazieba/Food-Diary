<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo.svg" />
    <title>Diary</title>
</head>


<body>
    <!--Navbar-->
    <div id="navbar">
        <img id="logo" src="/assets/img/logo3.svg">
        <a class="navi" href="/login/index.php">Login</a>
        <a class="navi" href="#">Recipes</a>
        <a class="navi-active" href="#">Diary</a>
        <a class="navi" href="/index.php">Home</a>
    </div>
    <div class="navbar-bg"></div>

    <div class="box1">
        <h1 id="dayname"></h1>
        <h1 id="date"></h1>
    </div>
    <form autocomplete="off" id="form" action="index.php" method="GET">
        <input name="add" class="foodinput" type="text" placeholder="Track your Nutrition" />
        <button type="submit" class="add">ADD</button>
    </form>
    <div class="box2">
        <div class="kcalcircle"></div>
        <p class="calories">187</p>
        <p class="kcal">kcal</p>
        <h1 class="food-name">Pizza</h1>
        <div class="line"></div>
        <p class=""></p>

        <!--?php
        if (isset(($_REQUEST['add']))) {
            $url = 'https://trackapi.nutritionix.com/v2/natural/nutrients';
            $data = json_encode(array('query' => $_REQUEST['add']));

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/json\r\n" .
                        "x-app-id: 76e56102\r\n" .
                        "x-app-key: e9b44356bf92babee2a1b35ed581036b\r\n",
                    'method'  => 'POST',
                    'content' => $data
                )
            );

            $context  = stream_context_create($options);
            $result = json_decode(file_get_contents($url, false, $context), true);

            echo ('<h1 class="food-name">' . $result['foods'][0]['food_name'] . '</h1>');
        }
        ?-->
    </div>

    <div class="footer">
        <p>Food Diary</p>
        <p>Abschlussprojekt von Bianka Zieba</p>
        <p>ZLI 2021/2022</p>
    </div>
    <script src="script.js"></script>
</body>

</html>