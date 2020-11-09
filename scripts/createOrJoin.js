// function allUser(x)
// {
//     $.post(
//         '/backend/friendList.php',
//         {list:x}, 
//         function(data, status)
//         {
//             console.log(JSON.parse(data));
//             var json = JSON.parse(data);

//             var d = document.getElementById('list');
            
//             for(var k in json)
//             {
//                 var c = document.createElement('div');
//                 c.classList.add('playerList');
//                 console.log(json[k]['username']);
                
//                 d.innerHTML += '<div class="displayName">'+json[k]['username']+'</div>';

//             }
//         });
// }



function createGameplay(x)
{
    //console.log(document.getElementById('gname').value);
    $.post(
        '/backend/gameplays.php',
        {jumpJack:x,gn:document.getElementById('gname').value,op:'create'},
        function(data,status){
            console.log(data);
            //window.location.href = 'lobby.php';
    });
}

