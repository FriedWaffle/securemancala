const delayCall = deplayMs => new Promise((resolve) =>{
    setTimeout(resolve, deplayMs);
});

var lab;
var playerOne = 'playerOne';
var playerTwo = 'playerTwo';
window.localStorage.clear();