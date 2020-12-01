function createMancala(x)
{
    $.post('/backend/playMancala.php', {op:'create',jumpjack:x}, function(data, status)
    {
        console.log(data);
    });
}


function changeTurn(x)
{
    $.post('/backend/playMancala.php',{op:'turn',spinbottle:x}, function(data, status)
    {
        console.log(data);        
    });
}