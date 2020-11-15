<?php

    include_once('../classes/Lobby.class.php');

    $Gameplay = new Lobby();

    switch($_POST['op'])
    {
        case 'create':
           $myJson = json_encode($Gameplay->initialization($_POST['jumpJack'],$_POST['gn']));
           echo $myJson;
        break;
        case 'search':
            $lobbyJson = json_encode($Gameplay->allLobbies());
            echo $lobbyJson;
        break;
        // case 'delete':
        //     $Gameplay->deleteGameplay($_POST['jumpJack']);
        // break;
    }
    

?>