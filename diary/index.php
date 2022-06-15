<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo.svg" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Diary</title>
</head>


<body>
    <!--Navbar-->
    <div id="navbar">
        <img id="logo" src="/assets/img/logo3.svg">
        <?php
        session_start();
        if (isset($_SESSION['login'])) {
            echo ('<a class="navi" href="/login/logout.php">Log out</a>');
        } else {
            echo ('<a class="navi" href="/login/index.php">Log in</a>');
        } ?>
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
        <?php
        if (!isset($_SESSION['login'])) {
            header("location:../login/index.php");
        }

        $jsonFile = file_get_contents("../login/users.json");
        $json = json_decode($jsonFile, true);

        // if (isset(($_REQUEST['add']))) {
        //     $url = 'https://trackapi.nutritionix.com/v2/natural/nutrients';
        //     $data = json_encode(array('query' => $_REQUEST['add']));

        //     $options = array(
        //         'http' => array(
        //             'header'  => "Content-type: application/json\r\n" .
        //                 "x-app-id: 76e56102\r\n" .
        //                 "x-app-key: e9b44356bf92babee2a1b35ed581036b\r\n",
        //             'method'  => 'POST',
        //             'content' => $data
        //         )
        //     );

        //     $context  = stream_context_create($options);
        //     $result = json_decode(file_get_contents($url, false, $context), true);

        //     echo ('<p class="kcal">kcal</p>');
        //     echo ('<div class="kcalcircle">');
        //     echo ('<p class="calories">' . round($result['foods'][0]['nf_calories'], 0) . '</p>');
        //     echo ('</div>');
        //     echo ('<h1 class="food-name">' . $result['foods'][0]['food_name'] . '</h1>');
        //     echo ('<div class="line"></div>');
        //     echo ('<div class="nutinfos">');
        //     echo ('<p class="fett">F: ' . $result['foods'][0]['nf_total_fat'] . '</p>');
        //     echo ('<p class="hydrate">H: ' . $result['foods'][0]['nf_total_carbohydrate'] . '</p>');
        //     echo ('<p class="sugar">S: ' . $result['foods'][0]['nf_sugars'] . '</p>');
        //     echo ('<p class="protein">P: ' . $result['foods'][0]['nf_protein'] . '</p>');
        //     echo ('</div>');
        // }

        echo ('<p class="kcal">kcal</p>');
        echo ('<div class="kcalcircle">');
        echo ('<p class="calories">200</p>');
        echo ('</div>');
        echo ('<h1 class="food-name">Pipi</h1>');
        echo ('<div class="line"></div>');
        echo ('<div class="nutinfos">');
        echo ('<p class="fett">F: 187</p>');
        echo ('<p class="hydrate">H: 420</p>');
        echo ('<p class="sugar">S: 69</p>');
        echo ('<p class="protein">P: 1337</p>');
        echo ('</div>');
        echo ('<p class="ervnutrition">SJVNKDNV</p>');
        echo ('<div class="evrbox">');
        echo ('<div class="evrline"></div>');
        echo ('</div>');

        // user aus array nehmen
        $user = null;
        foreach ($json['users'] as $struct) {
            if ($_SESSION["login"] == $struct['username']) {
                $user = $struct;
                break;
            }
        }

        echo ('<div class="ate">ATE TODAY:</div>');
        echo ('<div class="slideline"></div>');

        // user id nehmen
        $id = array_search($user, $json);

        // nutrition von heute
        $datum = date("d-m-Y");
        $foods = $json["users"][$id]["nutritions"][$datum];

        echo ('<div class="slides">');
        foreach ($foods as $food) {
            echo ('<div class="slide" id="slidename">' . $food["name"] . ' <span class="material-symbols-outlined">delete</span></div>');
        }
        echo ('</div>');

        ?>

    </div>

    <div class="footer">
        <p>Food Diary</p>
        <p>Abschlussprojekt von Bianka Zieba</p>
        <p>ZLI 2021/2022</p>
    </div>
    <script src="script.js"></script>
</body>

</html>