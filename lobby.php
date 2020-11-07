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
        <link rel="stylesheet" href="styles/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body onload="loaded();">
    <div id="chat">
        
    </div>
    <script>

        function loaded(){

            window.addEventListener('beforeunload',function(e){

            $.post(
                '/backend/sessions.php',
                {jumpJack:'<?php echo $_SESSION['jumpkey']; ?>',op:'delete'},
                function(data, status){
                    console.log(data);
                });
            });
        }
    </script>
    </body>
</html>