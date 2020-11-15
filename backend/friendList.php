<?php

    include_once('../classes/Player.class.php');
    
    $Player = new Player();

    echo json_encode($Player->getAllPlayer($_POST['list']));

?>