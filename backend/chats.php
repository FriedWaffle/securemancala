<?php
    include_once('../classes/Chat.class.php');

    $Chat = new Chat();

    switch($_POST['op'])
    {
        case 'create':
            $Chat->create_chat($_POST['jumpjack']);
        break;
        case 'send':
            echo $Chat->send($_POST['jumpjack'], $_POST['msg'], $_POST['luckyNum']);
        break;
        case 'read':
            echo json_encode($Chat->read($_POST['luckyNum']));
        break;
    }
?>