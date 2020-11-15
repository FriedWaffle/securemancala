
function createGameplay(x)
{
    console.log(document.getElementById('gname').value);
    $.post(
        '/backend/gameplays.php',
        {jumpJack:x,gn:document.getElementById('gname').value, role:'first',op:'create'},
        function(data, status)
        {
            console.log(data);
            window.location.href = 'lobby.php';
    });
}

