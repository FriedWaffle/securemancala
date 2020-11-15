var status = [];
status[0] = "create";
status[1] = "join";

function send(x)
{
    $.post('/backend/chats.php',{jumpjack:x,msg:document.getElementById('messages').value,luckyNum:lab,op:'send'},
    function(data, status)
    {
        document.getElementById('messages').value = "";
        console.log(data);
    });

}