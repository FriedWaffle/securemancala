<?php

    include_once("../classes/Mancala.class.php");

    $Mancala = new Mancala();

    switch($_POST['op'])
    {
        case 'create':
            $Mancala->create_mancala($_POST['luckyNum']);
        break;
        case 'turn':
            $Mancala->turn($_POST['spinbottle'], $_POST['luckyNum']);
        break;
        case 'turnStatus':
            $Mancala->turnStatus($_POST['luckyNum']);
        break;
        case 'update':
           // $Mancala->updateSlots($_POST['slots'],$_POST['luckyNum']);
           $Mancala->updateSlots($_POST['slots'],$_POST['luckyNum']);
        break;
        case 'getSlots':
            $json = json_encode($Mancala->getSlots($_POST['luckyNum']));

            echo $json;
        break;
        case 'left':
            $Mancala->leftScore($_POST['luckyNum'], $_POST['score']);
        break;
        case 'right':
            $Mancala->rightScore($_POST['luckyNum'], $_POST['score']);
        break;
        case 'checkScore':
            $json = json_encode($Mancala->getScores($_POST['luckyNum']));
            echo $json;
        break;
    }
?>