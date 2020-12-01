var gameBoard = (function()
            {
                var leftScore = 0;
                var rightScore = 0;
                var turn = 'first';


                

                function Id(id) {
                    return document.getElementById(id);
                }
                
                function Tag(tag) {
                    return document.getElementsByTagName(tag);
                }
                
                function AClass(aClass)
                {
                    return document.getElementsByClassName(aClass);
                }
                
                var svgns = "http://www.w3.org/2000/svg";
                function randomize(min, max){
                    max -= min;
                    return parseInt(Math.random() * max) + min;
                }
                
                function makeCircle(x, y, index)
                {
                    let cir = document.createElementNS(svgns, 'circle');
                    cir.setAttributeNS(null, 'r', 99);
                    cir.setAttributeNS(null, 'cx', randomize(x-90, (x+90)));
                    cir.setAttributeNS(null, 'cy', randomize(y-90,(y+90)));
                    cir.setAttributeNS(null, 'fill', `rgb(${randomize(0,255)}, ${randomize(0,255)}, ${randomize(0,255)})`);
                    cir.setAttributeNS(null, 'opacity',1);
                    AClass('slot')[index].appendChild(cir);

                }

                function startOver()
                {
                    for(var s in AClass('slot'))
                    {
                        //to remove the marbles and starting from fresh
                        AClass('slot')[s].innerHTML='';

                    }

                    enableControl(Id('first').getElementsByClassName('st2'));
                    

                    init();
                }
                
                function waitTurn()
                {

                    console.log('Checking turn from status: '+turn);
                    if(turn == 'first')
                    {

                        changeTurn('second');
                        return 'second';  
                    }
                    else
                    {
                        changeTurn('first');
                        return 'first';
                    }
                }

                


                function setupMouserOver(list)
                {
                    list.onmouseover = function(e){
                        console.log('ID: '+e.path[0].id);
                        console.log('Num of marbles: '+AClass('slot')[e.path[0].id].childNodes.length);
                        Id('totalMarbles').innerHTML = 'Marbles: '+AClass('slot')[e.path[0].id].childNodes.length;
                    }
                }

                function turnStatus()
                {
                               
                    var first = Id('first').getElementsByClassName('st2');
                    var second = Id('second').getElementsByClassName('st2');

                    setInterval(()=>{
                        $.post('/backend/playMancala.php',{op:'turnStatus', luckyNum:window.localStorage.getItem('lab')},function(data, status)
                        {
                            
                            console.log(window.localStorage.getItem('jumpkey') +' : '+window.localStorage.getItem('playerOne'));
                            console.log(window.localStorage.getItem('jumpkey') + ' : '+window.localStorage.getItem('playerTwo'));
                            if(data == 'second')
                            {
                                
                                disableControl(first);

                                if(window.localStorage.getItem('jumpkey') == window.localStorage.getItem('playerTwo'))
                                {
                                    enableControl(second);
                                }
                            }
                            else
                            {
                                disableControl(second);
                                if(window.localStorage.getItem('jumpkey') == window.localStorage.getItem('playerOne'))
                                {
                                    enableControl(first);
                                }
                            }
                        });
                    },1000);
                }
                

                function setupClick(list)
                {
                    list.onclick = function click(e)
                    {
                        var flag = true;
                        //console.log(e.path[0].id);
                       
                        let currentIndex = e.path[0].id;
                        //console.log(currentIndex);
                        // console.log('Selected: '+currentIndex);
                        var num = AClass('slot')[e.path[0].id].childNodes.length;
                        //console.log(num);
                        
                        AClass('slot')[e.path[0].id].innerHTML = '';

                            for(var i = 1; i <= num; i++)
                            {   

                                console.log(i+':'+num);
                               
                               if(currentIndex == 5)
                               {
                                   currentIndex = 11;
                                   

                                   if(turn == 'first')
                                   {
                                        rightScore++;
                                    
                                        Id('rScore').innerHTML = `${rightScore}`;
    
                                        console.log('Right Score: '+rightScore);
                                   }

                                   //console.log('index: '+ i +' length: '+num);
                                   if(i != num)
                                   {
                                    makeCircle(Id(currentIndex).cx.baseVal.value, Id(currentIndex).cy.baseVal.value,currentIndex);
                                    i++;
                                   }
                                   else if(i == num)
                                   {
                                       flag = false;
                                       break;
                                   }
                                   
                                   
                               }
                               else if(currentIndex == 6)
                               {
                                   currentIndex = 0;
                                   

                                   if(turn == 'second')
                                   {
                                        leftScore++;
                                        Id('lScore').innerHTML = `${leftScore}`;
    
                                        console.log('Left Score: '+leftScore);
                                   }
                                   

                                   if(i != num)
                                   {
                                        makeCircle(Id(currentIndex).cx.baseVal.value, Id(currentIndex).cy.baseVal.value,currentIndex);
                                        i++;
                                   }
                                   else if(i == num)
                                   {
                                       flag = false;
                                       break;
                                   }
                               }
                               else if(currentIndex < 5)
                               {
                                   currentIndex++;
                                   makeCircle(Id(currentIndex).cx.baseVal.value, Id(currentIndex).cy.baseVal.value,currentIndex);
                               }
                               else if(currentIndex > 6)
                               {
                                   currentIndex--;
                                   makeCircle(Id(currentIndex).cx.baseVal.value, Id(currentIndex).cy.baseVal.value,currentIndex);
                               }
                            }

                            if(flag)
                            {   
                                
                                turn = waitTurn();
                                console.log(turn);
                            }
                    }
                }
                
                function init()
                {
                    rightScore = 0;
                    leftScore = 0;
                    

                    console.log(first);

                    changeTurn('first');

                    
                    Id('pyOne').innerHTML = window.localStorage.getItem('playerOne');
                    Id('pyTwo').innerHTML = window.localStorage.getItem('playerTwo');

                    if(window.localStorage.getItem('jumpkey') != window.localStorage.getItem('playerOne'))
                    {
                        disableControl(Id('first').getElementsByClassName('st2'));
                    }

                    
                    console.log(window.localStorage.getItem('jumpkey'));
                    if(window.localStorage.getItem('jumpkey') != null)
                    {
                        createMancala(window.localStorage.getItem('jumpkey'));
                    }
                    
                    disableControl(Id('second').getElementsByClassName('st2'));
                    
                    Id('lScore').innerHTML = 0;
                    Id('rScore').innerHTML = 0;

                    var getClasses = document.getElementsByClassName('st2');
    
                    for(var k = 0; k < getClasses.length; k++)
                    {
                        var indexed = getClasses[k];
                        var slotted = AClass('st2')[k];
                        
                        for(var v = 0; v < 4; v++)
                        {

                            makeCircle(indexed.cx.baseVal.value,indexed.cy.baseVal.value, k);
                        }

                        setupClick(slotted);
                        setupMouserOver(slotted);
                    }

                    turnStatus();
                }

                function getDimensions() {
                    win_width = window.innerWidth - 30; // `-30` accounts for scroll bar
                }

                return {
                    init: init,
                    getDimensions: getDimensions,
                    makeCircle:makeCircle,
                    startOver:startOver
                };
    
            })();