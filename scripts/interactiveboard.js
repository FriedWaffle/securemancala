function interactiveboard()
{
    return `<div><svg onload='gameBoard.init();' id='Layer_1' viewBox='0 0 4560 2560' width='70%'>
 
 
    <path class='st0' d='M112.83,441.86l4327.82-9.64c32.9-0.07,59.64,26.54,59.71,59.44l3.26,1463.84
        c0.07,32.9-26.54,59.64-59.44,59.71l-4327.82,9.64c-32.9,0.07-59.64-26.54-59.71-59.44L53.38,501.57
        C53.31,468.67,79.92,441.94,112.83,441.86z'/>
   
        <g id='marbles'>
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
   
        <g id='first'>
        
        <ellipse id='0' class='st2 left one' cx='1004.42' cy='1606.48' rx='224.09' ry='223.93'/>
        
        <ellipse id='1' class='st2 left two' cx='1500.62' cy='1602.48' rx='224.09' ry='223.93'/>
   
        <ellipse id='2' class='st2 left three' cx='2001.83' cy='1604.48' rx='224.09' ry='223.93' />
   
        <ellipse id='3'  class='st2 left four' cx='2516.03' cy='1605.48' rx='224.09' ry='223.93' />
   
        <ellipse id='4' class='st2 left five' cx='3034.26' cy='1605.48' rx='224.09' ry='223.93' />
   
   
        <ellipse id='5' class='st2 left six' cx='3543.47' cy='1605.48' rx='224.09' ry='223.93' />
    </g>
   
    <g id='second'>
   
        <ellipse id='6' class='st2 right six' cx='1009.42' cy='797.48' rx='224.09' ry='223.93'/>
   
        
        <ellipse id='7' class='st2 right five' cx='1505.62' cy='793.48' rx='224.09' ry='223.93' />
   
        
        <ellipse id='8' class='st2 right four' cx='2006.83' cy='795.48' rx='224.09' ry='223.93' />
   
        
        <ellipse id='9' class='st2 right three' cx='2521.03' cy='796.48' rx='224.09' ry='223.93'/>
   
        
        <ellipse id='10' class='st2 right two' cx='3039.26' cy='796.48' rx='224.09' ry='223.93'/>
   
        <ellipse id='11'  class='st2 right one' cx='3548.47' cy='796.48' rx='224.09' ry='223.93' />
    </g>
   
    <path class='left goal' d='M642.85,1826H218.15c-56.97,0-103.15-46.18-103.15-103.15V673.15C115,616.18,161.18,570,218.15,570h424.69
        C699.82,570,746,616.18,746,673.15v1049.69C746,1779.82,699.82,1826,642.85,1826z'/>
        
    <path class='right goal' d='M4355.85,1857h-424.69c-56.97,0-103.15-46.18-103.15-103.15V704.15c0-56.97,46.18-103.15,103.15-103.15h424.69
        c56.97,0,103.15,46.18,103.15,103.15v1049.69C4459,1810.82,4412.82,1857,4355.85,1857z'/>
   
    <rect x='292.44' y='992.04' class='rect' width='276.56' height='411.96'/>
    <text transform='matrix(1 0 0 1 215.4448 1347.0327)' id='lScore' class='st3 st4'>0</text>
    <rect x='4005.44' y='1018.04' class='rect' width='276.56' height='411.96'/>
    <text transform='matrix(1 0 0 1 3925.4448 1373.0327)' id='rScore' class='st3 st4'>0</text>
    <rect x='1465.19' y='136' class='rect' width='1884.12' height='434.58'/>
    <text transform="matrix(1 0 0 1 0 221.8269)" class='st3 st5'>Player Two</text>
    <text transform="matrix(1 0 0 1 53.3799 2482.8799)" class='st3 st5'>Player One</text>
   
    
   </svg>
   <div><h3 id="totalMarbles">Marbles: </h3>
   <button class="button" onclick="gameBoard.startOver();">Start Over</button>
   </div>
   </div>`;
}

{/* <g id='slotNumber'>
        <text id='slot-0' transform="matrix(1 0 0 1 982.8441 388.4091)" class="st6">4</text>
        <text id='slot-1' transform="matrix(1 0 0 1 982.8439 2189.3088)" class="st6">4</text>
        <text id='slot-2' transform="matrix(1 0 0 1 1465.1901 2189.3091)" class="st6">4</text>
        <text id='slot-3' transform="matrix(1 0 0 1 1980.5901 2189.3096)" class="st6">4</text>
        <text id='slot-4' transform="matrix(1 0 0 1 2516.0366 2189.3088)" class="st6">4</text>
        <text id='slot-5' transform="matrix(1 0 0 1 3039.2681 2189.3091)" class="st6">4</text>
        <text id='slot-6' transform="matrix(1 0 0 1 3548.479 2189.3101)" class="st6">4</text>
        <text id='slot-7' transform="matrix(1 0 0 1 1500.6235 388.4088)" class="st6">4</text>
        <text id='slot-8' transform="matrix(1 0 0 1 1980.59 388.4089)" class="st6">4</text>
        <text id='slot-9' transform="matrix(1 0 0 1 2516.0364 388.4093)" class="st6">4</text>
        <text id='slot-10' transform="matrix(1 0 0 1 3034.2678 388.4089)" class="st6">4</text>
        <text id='slot-11' transform="matrix(1 0 0 1 3543.479 388.4095)" class="st6">4</text>
    </g> */}