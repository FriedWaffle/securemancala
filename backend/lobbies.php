<?php

    include_once('../classes/Lobby.class.php');

    $Lobby = new Lobby();

    switch($_POST['op'])
    {
        case 'create':
           $myJson = json_encode($Lobby->initialization($_POST['jumpJack'],$_POST['gn'], $_POST['role'], $_POST['cap']));
           echo $myJson;
        break;
        case 'search':
            $lobbyJson = json_encode($Lobby->allLobbies());
            echo $lobbyJson;
        break;
        case 'join':
            $Lobby->joinLobby($_POST['luckyNum'], $_POST['jumpjack'],$_POST['role'], $_POST['cap']);
        break;
        case 'find':
            $Lobby->quickSelect($_POST['luckyNum']);
        break;
        case 'players':
           $myJson = json_encode($Lobby->findLobbyPlayers($_POST['luckyNum']));
           echo $myJson;
        break;
        case 'ready':
            $Lobby->getReady($_POST['jumpjack'], $_POST['luckyNum'], $_POST['go']);
        break;
        case 'status':
          $myJson = json_encode($Lobby->findLobbyPlayers($_POST['luckyNum']));
          echo $myJson;
        break;
    }

?>