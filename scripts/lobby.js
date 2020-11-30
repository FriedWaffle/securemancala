var playerOne = 'playerOne';
var playerTwo = 'playerTwo';

function lobby(play){

    $('#grids').append(`
    <div>
        <h1 id="one">${playerOne}</h1>
        <button class="button" onclick="ready('${play}');">Not Ready</button>
        <h1 id="two" >${playerTwo}</h1>
        <button class="button" onclick="ready('${play}');">Not Ready</button>
    </div> 
        <div class="wrap">
        <div class="word" id="msg">
        </div>
        <div class="aim">
             <input type="text" maxlength="250" id="messages" name="message" placeholder="Enter your message here...">
             <button class="btnSend" onclick="send('${play}');">Send</button>
        </div>
        </div>`);

        $.post('/backend/chats.php',{jumpjack:play, 
        op:'create'}, 
        function(data, status)
        {
            console.log(data);
            lab = data;
            getPlayers(lab, play);

        }).done( 
            console.log('it have arrive'),
            
        );

}


function getPlayers(x, player)
{
    $.post('/backend/gameplays.php',{luckyNum:x, op:'players'}, function(data, status){

        console.log('it here!');
        var json = JSON.parse(data);

        console.log(...json);

        

        window.localStorage.setItem('playerOne', json[0].username);
        window.localStorage.setItem('playerTwo',json[1].username);
        
        $('#one').html(window.localStorage.getItem('playerOne'));
        $('#two').html(window.localStorage.getItem('playerTwo'));

        console.log(document.getElementById('one').textContent);
        console.log(window.localStorage.getItem('playerOne'));

        if(document.getElementById('one').textContent != player)
        {
            document.getElementsByClassName('button')[0].disabled = true;
        }
        else if(document.getElementById('two').textContent != player)
        {
            document.getElementsByClassName('button')[1].disabled = true;
        }

        console.log(json);
    });
}

function ready(x)
{
    console.log(x);
    $.post('/backend/gameplays.php',{luckyNum:lab,op:'ready',jumpjack:x,go:1},
    function(data, status){
        console.log(data);
    });
}