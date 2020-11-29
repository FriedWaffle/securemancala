<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset='utf-8'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='/scripts/controller.js'></script>
    <script src='/scripts/gameboard.js'></script>
    <script src='/scripts/interactiveboard.js'></script>
    
    <style type="text/css">

            #imgOne{
                position:absolute;
                top:80px;
                right:60px;
            }

            .disabled{
                pointer-events:none;
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
                opacity:.4;
            }

            .rect{fill:none;}
	        .st3{font-family:'MyriadPro-Regular';}
	        .st4{font-size:500px;}
	        .st5{font-size:300px;}

            .goal{
                fill:#8B5E13;
                opacity:.4;
            }

            .st2{
                fill:#8B5E13;
                opacity:.4;
            }

            .st2:hover{
                fill:'white';
                opacity:.7;
            }
            
        </style>
        <script>

            
    
        </script>
    </head>
    <body>
    <script>
    document.body.innerHTML = interactiveboard();
    </script>
<button onclick="gameBoard.startOver();">Start Over</button>
    </body>
    
</html>