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
    <body>
    <!-- <script>

        function loaded(){

            window.addEventListener('beforeunload',function(e){

            $.post(
                '/backend/gameplays.php',
                {jumpJack:'<?php echo $_SESSION['jumpkey']; ?>',op:'delete'},
                function(data, status){
                    console.log(data);
                });
            });
        }
    </script> -->
    <?php 
    
    echo "<div class='theForm chat'>
    <div class='message'>
    </div>
    <div class='aim'>
    <input type='text' maxlength='250' id='messages' name='message' placeholder='Enter your message here...'>
    <button>Send</button>
    </div>
    </div>";
    
    ?>
    
    </body>
</html>