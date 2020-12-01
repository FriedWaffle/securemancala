function disableControl(x)
{

    console.log(x);
    var i = 0;

    while(i < x.length)
    {
        x[i].classList.add('disabled');
        i++;
    }
}

function enableControl(x)
{
    console.log(x);
    var i = 0;
    while(i < x.length)
    {
        x[i].classList.remove('disabled')
        i++;
    }
}