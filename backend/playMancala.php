<?php

    include_once("../classes/Mancala.class.php");

    $Mancala = new Mancala();

    switch($_POST['op'])
    {
        case 'create':
            $Mancala->create_mancala($_POST['jumpkey']);
        break;
        case 'turn':
            echo "sweet";
        break;
    }
?>