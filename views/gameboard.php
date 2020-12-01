<?php

    session_start();
    
    if(!isset($_SESSION['jumpkey']))
    {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset='utf-8'/>
    <link href="/styles/game.css" rel="stylesheet">
    <link href='/styles/aim.css' rel='stylesheet'>
    <link href='/styles/style.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src='/scripts/gameStatus.js'></script>
    <script src='/scripts/gameboard.js'></script>
    <script src='/scripts/controller.js'></script>
    <script src='/scripts/interactiveboard.js'></script>
    
    <script src='/scripts/aim.js'></script>
    </head>
    <body onload="aim('<?php echo $_SESSION['jumpkey']; ?>');">
    <div id="grids" class="grid-container">

    </div>
    <script>
    $('#grids').append(interactiveboard());
    </script>

    </body>
    
</html>