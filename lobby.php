<?php

    session_start();
    
    if(!isset($_SESSION['icecream']))
    {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/styles/aim.css">
        <link rel="stylesheet" href="/styles/lobby.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="scripts/globalVariables.js"></script>
        
        <!-- <script type='text/javascript' src='scripts/fixedAim.js'></script> -->
        <script type="text/javascript" src="scripts/aim.js"></script>
        <script type="text/javascript" src="scripts/lobby.js"></script>
    </head>
    <body>

    <div id="grids" class="grid-container">
    
    </div>
    
    <script>
    lobby('<?php echo $_SESSION['jumpkey'];?>')
    </script>
    </body>
</html>