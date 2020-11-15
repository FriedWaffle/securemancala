
function createGameplay(x)
{
    console.log(document.getElementById('gname').value);
    $.post(
        '/backend/gameplays.php',
        {jumpJack:x,gn:document.getElementById('gname').value,op:'create'},
        function(data, status)
        {
            console.log(data);
            window.location.href = 'lobby.php';
    });
    //window.location.href = 'lobby.php';
}

