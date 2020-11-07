<?php

    include_once('../classes/Session.class.php');

    $Session = new Session();

    switch($_POST['op'])
    {
        case 'create':
            $Session->initialization($_POST['jumpJack']);
        break;
        case 'delete':
            $Session->deleteSession($_POST['jumpJack']);
        break;
    }
    

?>