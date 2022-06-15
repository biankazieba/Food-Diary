<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo.svg" />
    <title>Login</title>
</head>


<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="index.php" method="post">
                <h1>Sign up</h1>
                <span>to check your food diary</span>
                <input name="username" type="text" placeholder="Username" />
                <input name="password" type="password" placeholder="Password" />
                <input name="passwordConfirm" type="password" placeholder="Confirm Password" />
                <button type="submit" name="signUp">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="index.php" method="post">
                <h1>Sign in</h1>
                <span>or use your account</span>
                <input name="username" type="text" placeholder="Username" />
                <input name="password" type="password" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <button type="submit" name="signIn">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>We missed you</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello!</h1>
                    <p>Enter your personal details and start tracking your Nutrition</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    session_start();
    if (isset($_SESSION['login'])) {
        header('location:../diary');
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset(($_POST['signUp']))) {
        if (empty($_POST['username'])) {
            echo "<script>alert('No username found!');</script>";
        } else if (empty($_POST['password']) or empty($_POST['passwordConfirm'])) {
            echo "<script>alert('No password found!');</script>";
        } else if ($_POST['password'] != $_POST['passwordConfirm']) {
            echo "<script>alert('Passwords do not match!');</script>";
        } else {
            $jsonFile = file_get_contents("./users.json");
            $json = json_decode($jsonFile, true);

            if (in_array($_POST['username'], array_column($json['users'], "username"))) {
                echo "<script>alert('User already exists!');</script>";
            } else {
                $json['users'][] = ["username" => $_POST['username'], "password" => password_hash($_POST['password'], PASSWORD_DEFAULT)];
                $jsonString = json_encode($json);
                file_put_contents("./users.json", $jsonString);
                header("location:../index.php");
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset(($_POST['signIn']))) {
        if (empty($_POST['username'])) {
            echo "<script>alert('No username found!');</script>";
        } else if (empty($_POST['password'])) {
            echo "<script>alert('No password found!');</script>";
        } else {
            $jsonFile = file_get_contents("./users.json");
            $json = json_decode($jsonFile, true);

            if (!in_array($_POST['username'], array_column($json['users'], "username"))) {
                echo "<script>alert('User not found, please sign up!');</script>";
            }

            // user aus array nehmen
            $user = null;
            foreach ($json['users'] as $struct) {
                if ($_POST['username'] == $struct['username']) {
                    $user = $struct;
                    break;
                }
            }

            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['login'] = $user['username'];
                header("location:../diary");
            }
        }
    }

    ?>

    <script src="script.js"></script>
</body>

</html>