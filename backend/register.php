<?php

include_once('../classes/Player.class.php');
    
    $Player = new Player();

    switch($_POST['operation'])
    {
        case 'register':
            $Player->addPlayer($_POST['user'], $_POST['pass']);
        break;
        case 'verify':
        break;
    }
?>