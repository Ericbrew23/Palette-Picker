
//Uses javascript file API to allow the user to select an image of their computer
//Loads it into the canvas to be used for algorithm 
async function openFile() {
    let [file] = await window.showOpenFilePicker({
        types: [
            {
                description: 'Image File',
                accept: {
                    'image/*': ['.png', '.jpg']
                }
            },
        ],
        multiple: false,
        excludeAcceptAllOption: true
    });
    let fileData = await file.getFile();


    const img = document.getElementById("img");
    img.classList.add("obj");
    img.file = file;
    document.getElementById("preview").appendChild(img); 

    const reader = new FileReader();
    reader.onload = await (function (aImg) { return function (e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(fileData);
    setTimeout(() => {

        setColors();

    }, 500)

}

//test function to get around SSL restrictions
//loads a preselected image into the canvas to be algorithmed
function setCanvas(e){
    imageElement = document.getElementById('img');
    imageElement.src = e.srcElement.src;
    setColors();
}

function averageColor() {
    // Function to set the background color of the second div as
    // calculated average color of image

    // Create the canvas element


    imageElement = document.getElementById('img')



    canvas = document.getElementById('canvas');

    // Get the 2D context of the canvas

    context = canvas.getContext('2d');



    // Set the height and width equal
    // to that of the canvas and the image
    height = canvas.height =
        imageElement.naturalHeight ||
        imageElement.offsetHeight ||
        imageElement.height;
    width = canvas.width =
        imageElement.naturalWidth ||
        imageElement.offsetWidth ||
        imageElement.width;


    // Draw the image to the canvas
    context.drawImage(imageElement, 0, 0);
    imgData = context.getImageData(0, 0, width, height);


    let midheight = Math.ceil(height / 2);
    let midwidth = Math.ceil(width / 2);
    rgb0 = findPartition(imgData, 0, 0, height, width, width);

    console.log("!!!First Partition (top left)!!!-------------------------------------------");
    rgb1 = findPartition(imgData, 0, 0, midheight, midwidth, width);

    console.log("!!!Second Partition (top right)!!!-------------------------------------------");
    rgb2 = findPartition(imgData, 0, midwidth, midheight, width, width);

    console.log("!!!Third Partition (bottom left)!!!-------------------------------------------");
    rgb3 = findPartition(imgData, midheight, 0, height, midwidth, width);

    console.log("!!!Fourth Partition (bottom right)!!!-------------------------------------------");
    rgb4 = findPartition(imgData, midheight, midwidth, height, width, width);






    var colors = [];
    colors.push(rgb0);
    colors.push(rgb1);
    colors.push(rgb2);
    colors.push(rgb3);
    colors.push(rgb4);

    return colors


}

//Algorithm for finding average color per partition
function findPartition(imgData, startheight, startwidth, endheight, endwidth, imgwidth) {
    rgb = { r: 0, g: 0, b: 0 };
    count = 0;

    for (var i = startheight; i < endheight; i += 4) {

        for (var j = startwidth; j < endwidth; j += 4) {

            let index = j + (i * (imgwidth) * 4);



            // Sum total for each colour
            rgb.r += imgData.data[index];

            rgb.g += imgData.data[index + 1];

            rgb.b += imgData.data[index + 2];

            count++;


        }
    }

    // Find the average for each color
    rgb.r
        = Math.floor(rgb.r / count);

    rgb.g
        = Math.floor(rgb.g / count);

    rgb.b
        = Math.floor(rgb.b / count);


    return rgb;


}





//Unused code to find the compliment of a color
function compliment(rgb) {
    rgb.r = 255 - rgb.r;
    rgb.g = 255 - rgb.g;
    rgb.b = 255 - rgb.b;
    return rgb;
}


function setColors() {
    rgb = averageColor();

    // Select the element and set its
    // background color

    for (var i = 0; i < rgb.length; i++) {
        var readint = [rgb[i].r.toString(16), rgb[i].g.toString(16), rgb[i].b.toString(16)];
        document
            .getElementById("block" + i)
            .style.backgroundColor =
            'rgb(' + rgb[i].r + ','
            + rgb[i].g + ','
            + rgb[i].b + ')';


        for (let j = 0; j < readint.length; j++) {

            if (readint[j].length < 2) {
                readint[j] = "0" + readint[j];
            }

        }

        //Based on how dark the color is. and how saturated the color is, 
        //changes the text to black or white to be more readable
        let saturated = Boolean(((rgb[i].r > 200) || (rgb[i].g > 200) || (rgb[i].b > 200))
            && !((rgb[i].r > 200) && (rgb[i].g > 200)) && !((rgb[i].b > 200) && (rgb[i].g > 200)));

        console.log("Bool?:" + saturated);

        if (rgb[i].r + rgb[i].g + rgb[i].b <= 385 || saturated) {
            document.getElementById("title" + i).style = "color:white;"
        }
        else {
            document.getElementById("title" + i).style = "color:black;"
        }
        document
            .getElementById("title" + i)
            .innerHTML = "#" + readint[0] + readint[1] + readint[2];

    }

}


//Opens a new window allowing a user to name and save their palettes
function save() {

    var myWindow = window.open("", "MsgWindow", "width=300,height=130");

   
    myWindow.document.write("<p>Are you sure you want to save?</p> <input id='nameField' value='Name' type='text'> <div><button id='save'>Save</button> <button id='nsave'>Don't Save</button></div>");

    myWindow.document.getElementById("nsave").onclick = (() => { myWindow.close(); });
    myWindow.document.getElementById("save").onclick = (() => {
        console.log(document.getElementById("block0").firstElementChild.innerHTML);
        //this code does not work, Ajax was not stronger than all of grease
        jQuery.ajax({
            type: "POST",
            url: './dbConnection.php',
            dataType: 'json',
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
setTimeout(() => {

    setColors();



}, 500)