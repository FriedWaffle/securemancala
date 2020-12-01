<?php

    require_once "classes/Player.class.php";

    session_start();

    $player = new Player();

        if(isset($_POST['user']) && isset($_POST['pass']))
        {
            if($player->checkLogIn($_POST['user'], $_POST['pass']))
            {
                $_SESSION['icecream'] = $player->hashPass($_POST['user'] +""+$_POST['pass']);
                  
                $_SESSION['jumpkey'] = $_POST['user'];

                if(isset($_SESSION['icecream']))
                {
                  header("Location: views/createOrJoin.php");
                }
            }
        }
?>

<!DOCTYPE html>
<html>
<head>
<link href="/styles/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/scripts/register.js"></script>
<script>
window.localStorage.clear();
</script>
</head>
<body>
  <h1 class="title">Mancala</h1>
  <div class="wrap">
<form class="theForm" action="index.php" method="post">
<label for="user">Username:</label><br>
  <input type="text" id="user" name="user"><br>
<label for="pass">Password:</label><br>
  <input type="text" id="pass" name="pass"><br>
  <input class="button" type="submit" value="Log In">
</form>
<button id="signUp" onclick="signUp();">Sign Up</button>
  </div>
</body>
</html>