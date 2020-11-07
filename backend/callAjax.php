<?php

    session_start();
    
    require "PDO.DB.class.php";
    
    $DB = new DB();

    

    

    switch($_POST['session'])
    {
        case 'create':
            $_SESSION['session_id'] = $DB->initialize($_POST['player']);
            
            echo $_SESSION['session_id'];
        break;
        case 'join':
            $_POST['session_id'] = $DB->JoinSession($_POST['player'],$_POST['join']);
            
        break;
        case 'id':
            $_POST['savedId'] = $DB->getPlayer($_POST['playerId']);
            echo $_POST['savedId'];
        break;
        case 'turn':

            $DB->turn($_POST['waitTurn'], $_POST['session_id']);
            while(true)
            {
               $checkId = $DB->checkTurn($_POST['session_id']);
                if($_POST['savedId'] == $checkId)
                {
                    echo $checkId;
                    break;
                }
            }

        break;
    }

?>