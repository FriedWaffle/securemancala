<?php

    include_once("../classes/Mancala.class.php");

    $Mancala = new Mancala();

    switch($_POST['op'])
    {
        case 'create':
            $Mancala->create_mancala($_POST['jumpjack']);
        break;
        case 'turn':
            $Mancala->turn($_POST['spinbottle'], $_POST['luckyNum']);
        break;
        case 'turnStatus':
            $Mancala->turnStatus($_POST['luckyNum']);
        break;
    }
?>