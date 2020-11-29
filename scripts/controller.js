function disableControl(x)
{
    var i = 0;

    while(i < x.length)
    {
        x[i].classList.add('disabled');
        i++;
    }
}

function enableControl(x)
{
    var i = 0;
    while(i < x.length)
    {
        x[i].classList.remove('disabled')
        i++;
    }
}

function displaySlot()
{
    
}