



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
            colorSwitch = { r: 255, g: (value % 255), b: 0 };
            break;
        case 1:
            colorSwitch = { r: (255 - (value % 255)), g: 255, b: 0 };
            break;
        case 2:
            colorSwitch = { r: 0, g: 255, b: (value % 255) };
            break;
        case 3:
            colorSwitch = { r: 0, g: (255 - (value % 255)), b: 255 };
            break;
        case 4:
            colorSwitch = { r: (value % 255), g: 0, b: 255 };
            break;
        case 5:
            colorSwitch = { r: 255, g: 0, b: (255 - (value % 255)) };
    }

    let c = document.getElementById("TopColour");
    let ctx = c.getContext('2d');
    const gridwidth = 600;
    const gridheight = 300;
    let imageData = ctx.createImageData(gridwidth, gridheight);

    for (let i = 0; i < gridheight; i++) {
        for (let j = 0; j < (gridwidth * 4); j += 4) {
            let index = j + (i * gridwidth * 4)

            let domR = 255 - (Math.floor((255 - colorSwitch.r) * j / (gridwidth * 4)));
            let domG = 255 - (Math.floor((255 - colorSwitch.g) * j / (gridwidth * 4)));
            let domB = 255 - (Math.floor((255 - colorSwitch.b) * j / (gridwidth * 4)));
            let sub = (Math.floor(255 * i / gridheight));


            // Modify pixel data
            imageData.data[index + 0] = domR - sub;    // R value
            imageData.data[index + 1] = domG - sub;    // G value
            imageData.data[index + 2] = domB - sub;    // B value
            imageData.data[index + 3] = 255;      // A value
        }
    }
    ctx.putImageData(imageData, 20, 20);
}

function save() {

    var myWindow = window.open("", "MsgWindow", "width=300,height=130");

    /* const xmlhttp = new XMLHttpRequest();
 
     xmlhttp.open("GET", "public_html/dbConnection.php");
 
     console.log (xmlhttp);*/
    myWindow.document.write("<p>Are you sure you want to save?</p> <input id='nameField' value='Name' type='text'> <div><button id='save'>Save</button> <button id='nsave'>Don't Save</button></div>");

    myWindow.document.getElementById("nsave").onclick = (() => { myWindow.close(); });
    myWindow.document.getElementById("save").onclick = (() => {
        console.log(document.getElementById("block0").firstElementChild.innerHTML);
        jQuery.ajax({
            type: "POST",
            url: './public_html/dbConnection.php',
            data: {
                functionname: 'sendNewPaletteToDb', arguments: [
                    1, myWindow.document.getElementById("save").value,
                    document.getElementById("block0").firstElementChild.innerHTML,
                    document.getElementById("block1").firstElementChild.innerHTML,
                    document.getElementById("block2").firstElementChild.innerHTML,
                    document.getElementById("block3").firstElementChild.innerHTML,
                    document.getElementById("block4").firstElementChild.innerHTML]
            },
            success: function (obj, textstatus) {
                if( !('error' in obj) ) {
                    console.log("succeses?~?!");
                    yourVariable = obj.result;
                }
                else {
                    console.log(obj.error);
                }
          }
        });
        myWindow.close();
    });






}



