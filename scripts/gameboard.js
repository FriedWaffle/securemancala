var gameBoard = (function()
            {
                var leftScore = 0;
                var rightScore = 0;
                var turn = 'first';

                
                
                var svgns = "http://www.w3.org/2000/svg";
                function randomize(min, max){
                    max -= min;
                    return parseInt(Math.random() * max) + min;
                }

                function $(id) {
                    return document.getElementById(id);
                }

                function $$(tag) {
                    return document.getElementsByTagName(tag);
                }

                function $$$(aClass)
                {
                    return document.getElementsByClassName(aClass);
                }

                

                function makeCircle(x, y, index)
                {
                    let cir = document.createElementNS(svgns, 'circle');
                    cir.setAttributeNS(null, 'r', 99);
                    cir.setAttributeNS(null, 'cx', randomize(x-90, (x+90)));
                    cir.setAttributeNS(null, 'cy', randomize(y-90,(y+90)));
                    cir.setAttributeNS(null, 'fill', `rgb(${randomize(0,255)}, ${randomize(0,255)}, ${randomize(0,255)})`);
                    cir.setAttributeNS(null, 'opacity',1);
                    $$$('slot')[index].appendChild(cir);

                }

                function startOver()
                {
                    for(var s in $$$('slot'))
                    {
                        console.log($$$('slot')[s].innerHTML='');
                    }

                    init();
                }
                
                function waitTurn()
                {
                    var first = $('first').getElementsByClassName('st2');
                    var second = $('second').getElementsByClassName('st2');

                    if(turn == 'first')
                    {

                        disableControl(first);
                        enableControl(second);

                        return 'second';
                    }
                    else
                    {
                        disableControl(second);
                        enableControl(first);

                        return 'first';
                    }
                }

                function setupMouserOver(list)
                {
                    list.onmouseover = function(e){
                        console.log('ID: '+e.path[0].id);
                        console.log('Num of marbles: '+$$$('slot')[e.path[0].id].childNodes.length);
                    }
                }
                

                function setupClick(list)
                {
                    list.onclick = function click(e)
                    {
                        var flag = true;
                        //console.log(e.path[0].id);
                       
                        let currentIndex = e.path[0].id;
                        console.log(currentIndex);
                        var test = $$$('slot')[e.path[0]];
                        var num = $$$('slot')[e.path[0].id].childNodes.length;
                        console.log(num);
                        
                        $$$('slot')[e.path[0].id].innerHTML = '';

                            for(var i = 1; i <= num; i++)
                            {   

                                console.log(i+':'+num);
                               
                               if(currentIndex == 5)
                               {
                                   currentIndex = 11;
                                   

                                   if(turn == 'first')
                                   {
                                        rightScore++;
                                    
                                        $('rScore').innerHTML = `${rightScore}`;
    
                                        console.log('Right Score: '+rightScore);
                                   }

                                   console.log('index: '+ i +' length: '+num);
                                   if(i != num)
                                   {
                                    makeCircle($(currentIndex).cx.baseVal.value, $(currentIndex).cy.baseVal.value,currentIndex);
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
                                        $('lScore').innerHTML = `${leftScore}`;
    
                                        console.log('Left Score: '+leftScore);
                                   }
                                   

                                   if(i != num)
                                   {
                                        makeCircle($(currentIndex).cx.baseVal.value, $(currentIndex).cy.baseVal.value,currentIndex);
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
                                   makeCircle($(currentIndex).cx.baseVal.value, $(currentIndex).cy.baseVal.value,currentIndex);
                               }
                               else if(currentIndex > 6)
                               {
                                   currentIndex--;
                                   makeCircle($(currentIndex).cx.baseVal.value, $(currentIndex).cy.baseVal.value,currentIndex);
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
                    
                    
                    $('lScore').innerHTML = 0;
                    $('rScore').innerHTML = 0;

                    var getClasses = document.getElementsByClassName('st2');
    
                    for(var k = 0; k < getClasses.length; k++)
                    {
                        var indexed = getClasses[k];
                        var slotted = $$$('st2')[k];
                        //console.log(indexed.cy.baseVal.value);
                        for(var v = 0; v < 4; v++)
                        {
                            //console.log('checking here');
                            makeCircle(indexed.cx.baseVal.value,indexed.cy.baseVal.value, k);
                        }

                        setupClick(slotted);
                        setupMouserOver(slotted);
                    }
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