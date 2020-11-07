<?php

    session_start();
    
    if(!isset($_SESSION['icecream']))
    {
        header("Location: index.php");
    }

?>

<html>
<head>
<link rel="stylesheet" href="styles/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/scripts/friendList.js"></script>
</head>
<body>
<script>
    allUser("<?php echo $_SESSION['jumpkey'];?>");
</script>
<?php echo '<button onClick="createSession(\''.$_SESSION['jumpkey'].'\');">Create</button><button>Join</button>';?>
<div class='playerList' id="list">
    <div class='onlineHeader'>Player Online</div>

</div>
</body>

</html>