<!DOCTYPE html>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="make_marble.js"></script>
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

            .st1:hover{
                opacity:.8;
            }

            .goal{
                fill:#8B5E13;
            }

        </style>
        <script>
        
            const gameBoard = (function()
            {
                
                function init()
                {
                    getDimensions();
                    console.log('it works!');
    
                    var getClasses = document.getElementsByClassName('st1');
    
                    for(k in getClasses)
                    {
                        getClasses[k].onclick = function click(e)
                        {
                            //$(`${document.getElementsByClassName($(e.target).attr('class'))}`)[0].css({'fill':'red'});
                            $(e.target).css({'fill':'red'});

                            var marble = marbles();
                            
                            //clk[0].style.fill = 'red';
                            $element = $(e.target);
                            $element[0].append(marble);
                           // $('#mancala').append($(`<img id="cheese" src="marble.svg" width="60px;" height="60px;" cx="${e.clientX}" cy="${e.clientY}">`));
                            // $clk.css({'cx':e.clientX,'cy':e.clientY});
                            //$('#imgOne').css({'cy':$element.attr('cy'),'cx':$element.attr('cx')});
                            console.log($(e.target)[0]);
                        }
                    }
                }

                function getDimensions() {
                    win_width = window.innerWidth - 30; // `-30` accounts for scroll bar
                }

                return {
                    init: init,
                    getDimensions: getDimensions
                };
    
            })();
    
        </script>
    </head>
    <body onload="gameBoard.init();" onresize="gameBoard.getDimensions();">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 4560 2560" style="enable-background:new 0 0 4560 2560;" xml:space="preserve">
<g id="mancala">
	<path class="st0" d="M112.83,441.86l4327.82-9.64c32.9-0.07,59.64,26.54,59.71,59.44l3.26,1463.84
		c0.07,32.9-26.54,59.64-59.44,59.71l-4327.82,9.64c-32.9,0.07-59.64-26.54-59.71-59.44L53.38,501.57
		C53.31,468.67,79.92,441.94,112.83,441.86z"/>
        <g id="first">
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -3.5679 2.2362)" class="st1 left one" cx="1004.42" cy="1606.48" rx="224.09" ry="223.93"/>
        
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -3.5577 3.339)" class="st1 left two" cx="1500.62" cy="1602.48" rx="224.09" ry="223.93" />
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -3.5609 4.453)" class="st1 left three" cx="2001.83" cy="1604.48" rx="224.09" ry="223.93" />
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -3.5619 5.5958)" class="st1 left four" cx="2516.03" cy="1605.48" rx="224.09" ry="223.93" />
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -3.5606 6.7475)" class="st1 left five" cx="3034.26" cy="1605.48" rx="224.09" ry="223.93" />
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -3.5594 7.8792)" class="st1 left six" cx="3543.47" cy="1605.48" rx="224.09" ry="223.93" />
        </g>
        <g id="second">
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -1.7699 2.2454)" class="st1 right six" cx="1009.42" cy="797.48" rx="224.09" ry="223.93"/>
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -1.7598 3.3481)" class="st1 right five" cx="1505.62" cy="793.48" rx="224.09" ry="223.93" />
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -1.763 4.4621)" class="st1 right four" cx="2006.83" cy="795.48" rx="224.09" ry="223.93" />
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -1.7639 5.6049)" class="st1 right three" cx="2521.03" cy="796.48" rx="224.09" ry="223.93"/>
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -1.7626 6.7566)" class="st1 right two" cx="3039.26" cy="796.48" rx="224.09" ry="223.93"/>
	
		<ellipse transform="matrix(1 -2.222462e-03 2.222462e-03 1 -1.7614 7.8883)" class="st1 right one" cx="3548.47" cy="796.48" rx="224.09" ry="223.93" />
        </g>
	<path class="goal" d="M642.85,1826H218.15c-56.97,0-103.15-46.18-103.15-103.15V673.15C115,616.18,161.18,570,218.15,570h424.69
		C699.82,570,746,616.18,746,673.15v1049.69C746,1779.82,699.82,1826,642.85,1826z"/>
	<path class="goal" d="M4355.85,1857h-424.69c-56.97,0-103.15-46.18-103.15-103.15V704.15c0-56.97,46.18-103.15,103.15-103.15h424.69
		c56.97,0,103.15,46.18,103.15,103.15v1049.69C4459,1810.82,4412.82,1857,4355.85,1857z"/>
</g>


<img id="imgOne" src="marble.svg" width="60px;" height="60px;">
<img id="imgTwo" src="marble.svg" width="60px;" height="60px;">
</svg>
    </body>
    
</html>