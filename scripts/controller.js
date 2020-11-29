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

function displaySlot(slotNums, slots, selected)
{

    console.log(slotNums.length);
    while(selected < slotNums.length)
    {
        console.log(`Selected: ${selected} Index at: `+slots[selected].childNodes.length);

        console.log(`Checking for the ID: ${document.getElementById(`slot-${selected}`).innerHTML}`);

        //document.getElementById(`slot-${selected}`).innerHTML = slots[selected].childNodes.length;
        selected++;
    }
}