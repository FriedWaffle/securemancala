

function lobby(play){

    
    $('#grids').append(`
    <div>
        <h1 id="one">${playerOne}</h1>
        <button id="first" class="button" onclick="ready('${play}',event);">Not Ready</button>
        <h1 id="two" >${playerTwo}</h1>
        <button id="second" class="button" onclick="ready('${play}',event);">Not Ready</button>
    </div>`);

    


        $.post('/backend/chats.php',{jumpjack:play, 
        op:'create'}, 
        function(data, status)
        {
            console.log(data);
            lab = data;

            window.localStorage.setItem('lab',lab);
            
            aim(play);

        }).done( 
            
        );

        
        setInterval(async () =>{
            $.post('/backend/lobbies.php',{op:'status', luckyNum:window.localStorage.getItem('lab')}, function(data, status){
                

                getPlayers(window.localStorage.getItem('lab'), play);
                

                if(window.localStorage.getItem('playerOne') != null && window.localStorage.getItem('playerTwo') != null)
                {
                    var json = JSON.parse(data);
                    console.log(json);

                    for(var k in json)
                    {

                        if(json[k].ready ==1)
                        {
                            document.getElementById(`${json[k].role}`).innerHTML = 'Ready';
                            document.getElementById(`${json[k].role}`).style.backgroundColor = 'green';
                        }
                        else
                        {
                            document.getElementById(`${json[k].role}`).innerHTML = 'Not Ready';
                            document.getElementById(`${json[k].role}`).style.backgroundColor = 'red';
                        }
                    }
                }

                if(document.getElementById('first').textContent == 'Ready' && document.getElementById('second').textContent == 'Ready')
                {
                    window.location.href = 'gameboard.php';
                }
            });
        }, 3000);

}







function ready(x,e)
{
    var btn = e.path[0];


    if(btn.textContent == 'Not Ready')
    {
        btn.innerHTML = 'Ready';
        btn.style.backgroundColor = 'green';

        
        $.post('/backend/lobbies.php',{luckyNum:lab,op:'ready',jumpjack:x,go:1},
        function(data, status){
            console.log(data);
        });
    }else
    {
        btn.innerHTML = 'Not Ready';
        btn.style.backgroundColor = 'red';

        $.post('/backend/lobbies.php',{luckyNum:lab,op:'ready',jumpjack:x,go:0},
        function(data, status){
            console.log(data);
        });
    }
    
}

function getPlayers(x, player)
{ 

    console.log('hello');
      
    
    $.post('/backend/lobbies.php',{luckyNum:x, op:'players'}, function(data, status){

        console.log('it here!');
        var json = JSON.parse(data);

        console.log(...json);

        for(var k in json)
        {
            if(json[k].role == 'first')
            {
                window.localStorage.setItem('playerOne', json[k].username);
                $('#one').html(window.localStorage.getItem('playerOne'));
            }
            else
            {
                window.localStorage.setItem('playerTwo', json[k].username);
                $('#two').html(window.localStorage.getItem('playerTwo'));
            }
        }

        console.log(document.getElementById('one').textContent +' : '+player);

        if(document.getElementById('one').textContent != player)
        {
            document.getElementsByClassName('button')[0].disabled = true;
        }
        else if(document.getElementById('two').textContent != player)
        {
            document.getElementsByClassName('button')[1].disabled = true;
        }
        

    });

   
}
 //     
    //     

    //     console.log(document.getElementById('one').textContent);
    //     console.log(window.localStorage.getItem('playerOne'));

    //     if(document.getElementById('one').textContent != player)
    //     {
    //         document.getElementsByClassName('button')[0].disabled = true;
    //     }
    //     else if(document.getElementById('two').textContent != player)
    //     {
    //         document.getElementsByClassName('button')[1].disabled = true;
    //     }

    //     console.log(json);
    // });