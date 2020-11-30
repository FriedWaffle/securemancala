var lab;
var status = [];


function aim(play){

    lobby(play);
    document.addEventListener("keyup",function(event){
        if(event.keyCode === 13)
        {
            send(play);
        }
    });

    //to delay the chat to avoid piling up the request's queue or breaking it rhytem
    const delayChat = deplayMs => new Promise((resolve) =>{
        setTimeout(resolve, deplayMs);
    });

    //set to frequenting request the chat server to retreive all chat data. 
    setInterval(async () =>
    {
        if(lab != null)
        {
                $.post('/backend/chats.php',{luckyNum:lab,op:'read'},function(data, status){
                    
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

                });
        }

     await delayChat(2000);
    }, 1000);
}




function send(x)
{
    $.post('/backend/chats.php',{jumpjack:x,msg:document.getElementById('messages').value,luckyNum:lab,op:'send'},
    function(data, status)
    {
        document.getElementById('messages').value = "";
        console.log(data);
    });

}

