


function aim(play){


    $('#grids').append(`<div class="aimWrap">
    <div class="word" id="msg">
    </div>
    <div class="aim">
         <input type="text" maxlength="250" id="messages" name="message" placeholder="Enter your message here...">
         <button class="btnSend" onclick="send('${play}');">Send</button>
    </div>
    </div>`);

    document.addEventListener("keyup",function(event){
        if(event.keyCode === 13)
        {
            send(play);
        }
    });

    //to delay the chat to avoid piling up the request's queue or breaking it rhytem

    //set to frequenting request the chat server to retreive all chat data. 
    setInterval(function()
    {
        if(window.localStorage.getItem('lab') != null)
        {

                $.post('/backend/chats.php',{luckyNum:window.localStorage.getItem('lab'),op:'read'},function(data, status){
                    
                    var json = JSON.parse(data);



                    console.log(data);
                    
                        $div = $('<div></div>');
                        
                        for(var k in json)
                        {
                            if( play == json[k].player)
                            {
                                $div.append('<div class="container"><a>'+json[k].player+'</a><p>'+json[k].msg+'</p></div>');
                                
                                
                            }
                            else
                            {
                                $div.append('<div class="container darker"><a>'+json[k].player+'</a><p>'+json[k].msg+'</p></div>');
                            }

                            
                            
                        }

                        document.getElementById('msg').innerHTML = $div.html();



                }).done();
        }


    }, 3000);
}

function send(x)
{
    $.post('/backend/chats.php',{jumpjack:x,msg:document.getElementById('messages').value,luckyNum:window.localStorage.getItem('lab'),op:'send'},
    function(data, status)
    {
        document.getElementById('messages').value = "";
        console.log(data);
    });

}

