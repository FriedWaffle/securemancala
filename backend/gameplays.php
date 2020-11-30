<?php

    include_once('../classes/Lobby.class.php');

    $Gameplay = new Lobby();

    switch($_POST['op'])
    {
        case 'create':
           $myJson = json_encode($Gameplay->initialization($_POST['jumpJack'],$_POST['gn'], $_POST['role']));
           echo $myJson;
        break;
        case 'search':
            $lobbyJson = json_encode($Gameplay->allLobbies());
            echo $lobbyJson;
        break;
        case 'join':
            $Gameplay->joinLobby($_POST['luckyNum'], $_POST['jumpjack'],$_POST['role']);
        break;
        case 'find':
            $Gameplay->quickSelect($_POST['luckyNum']);
        break;
        case 'players':
           $myJson = json_encode($Gameplay->findLobbyPlayers($_POST['luckyNum']));
           echo $myJson;
        break;
        case 'ready':
            $Gameplay->getReady($_POST['jumpjack'], $_POST['luckyNum'], $_POST['go']);
        break;
    }

?>