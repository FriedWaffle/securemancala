<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset='utf-8'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='/scripts/svgTagFactory.js'></script>
        <style>
            #mancala{

            }

            #imgOne{
                position:absolute;
                top:80px;
                right:60px;
            }

            .testing{

                fill:#DEB887;
                stroke:#DEB887;
                stroke-width: 3;
            }

            .st0{
                fill:#D5AE85;
            }
	        .st1{
                fill:#8B5E13;
            }

            .goal{
                fill:#8B5E13;
            }

            .st2{
                fill:transparent;
            }

            .slot:hover{
                fill:'white';
                opacity:.7;
            }
            

         
        </style>
        <script>

            var gameBoard = (function()
            {
                var svgns = "http://www.w3.org/2000/svg";
                function randomize(min, max){
                    max -= min;
                    return parseInt(Math.random() * max) + min;
                }

                function $$(tag) {
                    return document.getElementsByTagName(tag);
                }

                function $(id) {
                    return document.getElementById(id);
                }

                function $$$(aClass)
                {
                    return document.getElementsByClassName(aClass);
                }

                function makeCircle(x, y, index)
                {
                    let cir = document.createElementNS(svgns, 'circle');
                    cir.setAttributeNS(null, 'r', 99);
                    cir.setAttributeNS(null, 'cx', randomize(x-100, (x+100)));
                    cir.setAttributeNS(null, 'cy', randomize(y-100,(y+100)));
                    cir.setAttributeNS(null, 'fill', `rgb(${randomize(0,255)}, ${randomize(0,255)}, ${randomize(0,255)})`);
                    cir.setAttributeNS(null, 'opacity',1);
                    $$$('slot')[index].appendChild(cir);
                    console.log($$$('slot')[index]);

                }

                

                function setupClick(list)
                {
                    list.onclick = function click(e)
                    {
                        console.log(e.path[0].id);
                       
                        var currentIndex = e.path[0].id;
                        var test = $$$('slot')[e.path[0]];
                        var num = $$$('slot')[e.path[0].id].childNodes.length;
                        console.log(num);
                        $$$('slot')[e.path[0].id].innerHTML = '';


                        if($$$('slot')[e.path[0].id].childNodes.length == 0)
                        {
                            for(let i = 1; i <= num; i++)
                            {   
                                if(currentIndex < 11)
                                {
                                    currentIndex++;
                                }
                                else if(currentIndex == 11)
                                else
                                {
                                    currentIndex = 0;
                                }                         
                                
                                
                                makeCircle($(currentIndex).cx.baseVal.value, $(currentIndex).cy.baseVal.value,currentIndex);
                            }
                        }
                        
                    }
                }

                function moveStones()
                {

                }
                
                function init()
                {

                    var getClasses = document.getElementsByClassName('st1');
    
                    for(var k = 0; k < getClasses.length; k++)
                    {
                        var indexed = getClasses[k];
                        var slotted = $$$('st2')[k];
                        console.log(indexed.cy.baseVal.value);
                        for(var v = 0; v < 4; v++)
                        {
                            console.log('checking here');
                            makeCircle(indexed.cx.baseVal.value,indexed.cy.baseVal.value, k);
                        }

                        setupClick(slotted);
                    }
                }

                function getDimensions() {
                    win_width = window.innerWidth - 30; // `-30` accounts for scroll bar
                }

                return {
                    init: init,
                    getDimensions: getDimensions,
                    makeCircle:makeCircle
                };
    
            })();
    
        </script>
    </head>
    <body>
        <svg onload="gameBoard.init();" id="Layer_1" viewBox="0 0 4560 2560" width="60%">

	<path class="st0" d="M112.83,441.86l4327.82-9.64c32.9-0.07,59.64,26.54,59.71,59.44l3.26,1463.84
		c0.07,32.9-26.54,59.64-59.44,59.71l-4327.82,9.64c-32.9,0.07-59.64-26.54-59.71-59.44L53.38,501.57
		C53.31,468.67,79.92,441.94,112.83,441.86z"/>
        
		<ellipse class="st1" cx="1004.42" cy="1606.48" rx="224.09" ry="223.93"/>
        
		<ellipse class="st1" cx="1500.62" cy="1602.48" rx="224.09" ry="223.93"/>

        
		<ellipse  class="st1" cx="2001.83" cy="1604.48" rx="224.09" ry="223.93" />

		<ellipse  class="st1" cx="2516.03" cy="1605.48" rx="224.09" ry="223.93" />
 

		<ellipse  class="st1" cx="3034.26" cy="1605.48" rx="224.09" ry="223.93" />


		<ellipse  class="st1" cx="3543.47" cy="1605.48" rx="224.09" ry="223.93" />


		<ellipse  class="st1" cx="1009.42" cy="797.48" rx="224.09" ry="223.93"/>

        
		<ellipse  class="st1" cx="1505.62" cy="793.48" rx="224.09" ry="223.93" />

        
		<ellipse  class="st1" cx="2006.83" cy="795.48" rx="224.09" ry="223.93" />

        
		<ellipse  class="st1" cx="2521.03" cy="796.48" rx="224.09" ry="223.93"/>

        
		<ellipse  class="st1" cx="3039.26" cy="796.48" rx="224.09" ry="223.93"/>

		<ellipse  class="st1" cx="3548.47" cy="796.48" rx="224.09" ry="223.93" />

	<path class="goal" d="M642.85,1826H218.15c-56.97,0-103.15-46.18-103.15-103.15V673.15C115,616.18,161.18,570,218.15,570h424.69
		C699.82,570,746,616.18,746,673.15v1049.69C746,1779.82,699.82,1826,642.85,1826z"/>
	<path class="goal" d="M4355.85,1857h-424.69c-56.97,0-103.15-46.18-103.15-103.15V704.15c0-56.97,46.18-103.15,103.15-103.15h424.69
		c56.97,0,103.15,46.18,103.15,103.15v1049.69C4459,1810.82,4412.82,1857,4355.85,1857z"/>
<g id="marbles">
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
    <g class='slot'></g>
</g>
    <g id="first">
        
		<ellipse id='0' class="st2 left one" cx="1004.42" cy="1606.48" rx="224.09" ry="223.93"/>
        
		<ellipse id='1' class="st2 left two" cx="1500.62" cy="1602.48" rx="224.09" ry="223.93"/>

		<ellipse id='2' class="st2 left three" cx="2001.83" cy="1604.48" rx="224.09" ry="223.93" />

		<ellipse id='3'  class="st2 left four" cx="2516.03" cy="1605.48" rx="224.09" ry="223.93" />
 
		<ellipse id='4' class="st2 left five" cx="3034.26" cy="1605.48" rx="224.09" ry="223.93" />


		<ellipse id='5' class="st2 left six" cx="3543.47" cy="1605.48" rx="224.09" ry="223.93" />
    </g>

    <g id="second">

		<ellipse id='6' class="st2 right six" cx="1009.42" cy="797.48" rx="224.09" ry="223.93"/>

        
		<ellipse id='7' class="st2 right five" cx="1505.62" cy="793.48" rx="224.09" ry="223.93" />

        
		<ellipse id='8' class="st2 right four" cx="2006.83" cy="795.48" rx="224.09" ry="223.93" />

        
		<ellipse id='9' class="st2 right three" cx="2521.03" cy="796.48" rx="224.09" ry="223.93"/>

        
		<ellipse id='10' class="st2 right two" cx="3039.26" cy="796.48" rx="224.09" ry="223.93"/>

		<ellipse id='11'  class="st2 right one" cx="3548.47" cy="796.48" rx="224.09" ry="223.93" />
    </g>

</svg>
    </body>
    
</html>