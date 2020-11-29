

function tagManufacture(tag, css)
{
    var svgElement = document.createElementNS(svgns,tag);

    for(var style in css)
    {
        svgElement.setAttribute(style, css[style]);
    }

    return svgElement;
}

