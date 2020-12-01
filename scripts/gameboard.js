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

                async function updateSlots()
                {
                var slots = $(`.slot`);
                // console.log(slots);

                    var slotArr = [];
                    var i = 0;

                    var right = 0;

                    var left = 11;

                    while(i < slots.length)
                    {
                        while(right < 6)
                        {
                            //console.log('Slot number: '+i+' Amount: '+slots[right].childNodes.length);
                            slotArr[i] = slots[right].childNodes.length;
                            right++;
                            i++;
                        }
                
                        while(left > 5)
                        {
                            // console.log('Slot number: '+i+' Amount: '+slots[left].childNodes.length);
                            
                            slotArr[i] = slots[left].childNodes.length;

                            left--;
                            i++;
                        }
                    }
                    

                    console.log('SEe if I got the tag: '+Id('lScore').innerHTML);
                    

                    await $.post('/backend/playMancala.php',{op:'update',slots:slotArr,luckyNum:window.localStorage.getItem('lab')}, function(data, status)
                    {
                            console.log(data);

                            score();

                    }); 
                }

                function score()
                {
                    var leftOrRight;
                    var score;
                    if(window.localStorage.getItem('jumpkey') == window.localStorage.getItem('playerOne'))
                    {
                        leftOrRight = 'right';
                        score = Id('rScore').innerHTML;
                    }
                    else
                    {
                        leftOrRight = 'left';
                        score = Id('lScore').innerHTML;
                    }

                    $.post('/backend/playMancala.php', {op:leftOrRight, luckyNum:window.localStorage.getItem('lab'), score:score},function(data, status){

                        console.log(data);
                    });
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

                async function checkSlots()
                {
                   
                       await $.post('/backend/playMancala.php',{op:'getSlots', luckyNum:window.localStorage.getItem('lab')}, function(data, status)
                        {
                            var json = JSON.parse(data);
                            
                            
                            //console.log(json);
    
                            var slots = $('.slot');
    
                            var i = 0;
                            var k = 0;

                            for(var j in json)
                            {
                                k = 0;
                                // while(right < 5)
                                // {
                                    
                                //     slots[right].innerHTML = '';
                                //     for(var k = 0; k < json[j]; k++)
                                //     {
                                //         if(json[j] != 0)
                                //         {
                                //             makeCircle(Id(right).cx.baseVal.value, Id(right).cy.baseVal.value, right);
                                //         }
                                //     }

                                //     right++;
                                // }

                                // while(left > 6)
                                // {
                                //     slots[right].innerHTML = '';
                                //     for(var k = 0; k < json[j]; k++)
                                //     {
                                //         if(json[j] != 0)
                                //         {
                                //             makeCircle(Id(left).cx.baseVal.value, Id(left).cy.baseVal.value, left);
                                //         }
                                //     }
                                //     left--;
                                // }

                               slots[i].innerHTML = '';
                                
                                while(k < json[j])
                                {
                                    
                                    makeCircle(Id(i).cx.baseVal.value, Id(i).cy.baseVal.value, i);
                                    k++;
                                }
                                console.log(json[j]);
                                i++;

                            }

                            checkScore();
                        });
                    
                }

                function checkScore()
                {
                    $.post('/backend/playMancala.php',{op:'checkScore',luckyNum:window.localStorage.getItem('lab')}, function(data, status){
                        var json = JSON.parse(data);
                        console.log(json);

                        Id('lScore').innerHTML = json['lScore'];
                        Id('rScore').innerHTML = json['rScore'];
                    });
                }
                
                function waitTurn()
                {
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
                            
                            checkSlots();
                        });
                    },1000);
                }
                

                function setupClick(list)
                {
                    list.onclick = function click(e)
                    {
                        var flag = true;
                       
                        let currentIndex = e.path[0].id;

                        var num = AClass('slot')[e.path[0].id].childNodes.length;

                        
                        AClass('slot')[e.path[0].id].innerHTML = '';

                            for(var i = 1; i <= num; i++)
                            {   
                               
                               if(currentIndex == 5)
                               {
                                   currentIndex = 11;
                                   

                                   if(turn == 'first')
                                   {
                                        rightScore++;
                                    
                                        Id('rScore').innerHTML = `${rightScore}`;
    
                                        console.log('Right Score: '+rightScore);
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
                                updateSlots();
                            }
                    }
                }
                
                function init()
                {
                    rightScore = 0;
                    leftScore = 0;

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
                    updateSlots();
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