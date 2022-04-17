
var box1 = document.getElementById("Colour1");
var selectedBox = box1;


function setSelected(e) {
    selectedBox = e.srcElement;
}
function setColorBox(e) {

    var canvas = e.srcElement;
    var ctx = canvas.getContext('2d');


    var selectedColor = selectedBox;




    var x = e.layerX;
    var y = e.layerY;
    var pixel = ctx.getImageData(x, y, 1, 1);
    var data = pixel.data;


    const rgba = `rgba(${data[0]}, ${data[1]}, ${data[2]}, ${data[3] / 255})`;
    selectedColor.style.background = rgba;


    var readint = [data[0].toString(16), data[1].toString(16), data[2].toString(16)];
    for (let j = 0; j < readint.length; j++) {

        if (readint[j].length < 2) {
            readint[j] = "0" + readint[j];
        }

    }


    let saturated = Boolean(((data[0] > 200) || (data[1] > 200) || (data[2] > 200))
        && !((data[0] > 200) && (data[1] > 200)) && !((data[2] > 200) && (data[1] > 200)));

    if (data[0] + data[1] + data[2] <= 385 || saturated) {
        selectedColor.firstElementChild.style = "color:white;"
    }
    else {
        selectedColor.firstElementChild.style = "color:black;"
    }

    let rgbtext = `#${readint[0]}${readint[1]}${readint[2]}`;
    selectedColor.firstElementChild.innerHTML = rgbtext;

    return rgba;

}
function resetColor() {

    for (let i = 0; i < 5; i++) {
        let preBlock =
            document
                .getElementById("block" + i);
        preBlock
            .style.background =
            `rgb(${0},${0},${0},${1})`;
        console.log(":)");
        preBlock.firstElementChild.style = "color:white";
        preBlock.firstElementChild.innerHTML = "#000000";

    }
}
function updateGradient(e) {
    let value = e.srcElement.value;
    let colorSwitch;
    switch (Math.floor(value / 255)) {
        default:
        case 0:
            colorSwitch = {r:255,g: (value % 255),b:0};
            break;
        case 1:
            colorSwitch = {r:(255 - (value % 255)),g:255,b:0};
            break;
        case 2:
            colorSwitch = {r:0,g:255,b: (value % 255)};
            break;
        case 3:
            colorSwitch = {r:0,g:(255 - (value % 255)),b:255};
            break;
        case 4:
            colorSwitch = {r:(value % 255),g:0,b:255};
            break;
        case 5:
            colorSwitch = {r:255,g:0,b:(255 - (value % 255))};
    }

    let c = document.getElementById("TopColour");
    let ctx = c.getContext('2d');
    let imageData = ctx.createImageData(500, 250);

    for (let i = 0; i < 250; i ++) {
        for (let j = 0; j < 2000; j +=4) {
            let index = j + (i * 2000)

            let domR = 255-(Math.floor((255-colorSwitch.r)*j /2000));
            let domG = 255-(Math.floor((255-colorSwitch.g)*j /2000));
            let domB = 255-(Math.floor((255-colorSwitch.b)*j /2000));
            let sub = (Math.floor(255*i /250));
            

            // Modify pixel data
            imageData.data[index + 0] = domR-sub;    // R value
            imageData.data[index + 1] = domG-sub;    // G value
            imageData.data[index + 2] = domB-sub;    // B value
            imageData.data[index + 3] = 255;      // A value
        }
    }
    ctx.putImageData(imageData, 20, 20);
}



