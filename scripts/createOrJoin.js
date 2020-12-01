
function createGameplay(x)
{
    console.log(document.getElementById('gname').value);

    if(document.getElementById('gname').value != '')
    {
        $.post(
            '/backend/lobbies.php',
            {jumpJack:x,gn:document.getElementById('gname').value, role:'first',op:'create', cap:1},
            function(data, status)
            {
                console.log(data);
                window.location.href = 'lobby.php';
        });
    }
}

