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
        <a class="navi" href="/recipes/index.php">Recipes</a>
        <a class="navi-active" href="/diary/index.php">Diary</a>
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

        $user = null;
        foreach ($json['users'] as $struct) {
            if ($_SESSION["login"] == $struct['username']) {
                $user = $struct;
            }
        }

        // ID zuteilen
        $id = array_search($user, $json);

        $datum = date("d-m-Y");
        $foods = $json["users"][$id]["nutritions"][$datum];

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

            // API in result speichern
            $context  = stream_context_create($options);
            $result = json_decode(file_get_contents($url, false, $context), true);

            echo ('<p class="kcal">kcal</p>');
            echo ('<div class="kcalcircle">');
            echo ('<p class="calories">' . round($result['foods'][0]['nf_calories'], 0) . '</p>');
            echo ('</div>');
            echo ('<h1 class="food-name">' . $result['foods'][0]['food_name'] . '</h1>');
            echo ('<div class="line"></div>');
            echo ('<div class="nutinfos">');
            echo ('<p class="fett">F: ' . $result['foods'][0]['nf_total_fat'] . '</p>');
            echo ('<p class="hydrate">H: ' . $result['foods'][0]['nf_total_carbohydrate'] . '</p>');
            echo ('<p class="sugar">S: ' . $result['foods'][0]['nf_sugars'] . '</p>');
            echo ('<p class="protein">P: ' . $result['foods'][0]['nf_protein'] . '</p>');
            echo ('</div>');

            $currentFood = array(
                "name" => $result['foods'][0]['food_name'],
                "calories" => round($result['foods'][0]['nf_calories'], 0),
                "fat" => $result['foods'][0]['nf_total_fat'],
                "carbohydrates" => $result['foods'][0]['nf_total_carbohydrate'],
                "sugars" => $result['foods'][0]['nf_sugars'],
                "protein" => $result['foods'][0]['nf_protein']
            );
            array_push($foods, $currentFood);

            $json["users"][$id]["nutritions"][$datum] = $foods;
        } else {
            echo ('<p class="kcal">kcal</p>');
            echo ('<div class="kcalcircle">');
            echo ('<p class="calories"> 0</p>');
            echo ('</div>');
            echo ('<h1 class="food-name">add nutrition</h1>');
            echo ('<div class="line"></div>');
            echo ('<div class="nutinfos">');
            echo ('<p class="fett">F: 0</p>');
            echo ('<p class="hydrate">H: 0</p>');
            echo ('<p class="sugar">S: 0</p>');
            echo ('<p class="protein">P: 0</p>');
            echo ('</div>');
        }

        if (isset(($_REQUEST['delete']))) {
            $data = json_encode(array('query' => $_REQUEST['delete']));
            $foods = array_splice($foods, 1, 1);
            $json["users"][$id]["nutritions"][$datum] = $foods;
        }

        file_put_contents("../login/users.json", json_encode($json));

        echo ('<div class="ate">ATE TODAY:</div>');
        echo ('<div class="slideline"></div>');

        echo ('<div class="slides">');
        $calories = 0;
        $fat = 0;
        $carbohydrates = 0;
        $sugars = 0;
        $proteins = 0;
        $index = 0;
        foreach ($foods as $food) {
            $index += 1;
            echo ('<form autocomplete="off" id="form" action="index.php" method="GET">');
            echo ('<div class="slide" id="slidename">' . $food["name"] . ' <button type="submit" name="delete" value="' . $index . '" class="material-symbols-outlined delete">delete</button></div>');
            echo ('</form>');
            $calories += $food["calories"];
            $fat += $food["fat"];
            $carbohydrates += $food["carbohydrates"];
            $sugars += $food["sugars"];
            $proteins += $food["protein"];
        }
        echo ('</div>');

        echo ('<p class="ervnutrition">SUMMARY:</p>');
        echo ('<div class="evrbox">');
        echo ('<div class="evrtext">CALORIES</div>');
        echo ('<div class="evrtext">FAT</div>');
        echo ('<div class="evrtext">CARBOHYDRATES</div>');
        echo ('<div class="evrtext">SUGARS</div>');
        echo ('<div class="evrtext">PROTEINS</div>');
        echo ('<div class="evrline"></div>');
        echo ('<div class="evrnumber">' . $calories . '</div>');
        echo ('<div class="evrnumber">' . $fat . '</div>');
        echo ('<div class="evrnumber">' . $carbohydrates . '</div>');
        echo ('<div class="evrnumber">' . $sugars . '</div>');
        echo ('<div class="evrnumber">' . $proteins . '</div>');
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