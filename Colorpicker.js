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
    document.getElementById("preview").appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.

    const reader = new FileReader();
    reader.onload = await (function (aImg) { return function (e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(fileData);
    setTimeout(() => {

        setColors();

    }, 500)

}

function averageColor() {
    // Function to set the background
    // color of the second div as
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


    rgb0 = findPartition(imgData, 0, 0, height, width, width);
    rgb1 = findPartition(imgData, 0, 0, height / 2, width / 2 , width);
    rgb2 = findPartition(imgData, 0, width / 2, height / 2, width,width);
    rgb3 = findPartition(imgData, height / 2, 0, height, width / 2,width);
    rgb4 = findPartition(imgData, height / 2, width / 2, height, width,width);

    



    // Get the length of image data object
   
    
    var colors = [];
    colors.push(rgb0);
    colors.push(rgb1);
    colors.push(rgb2);
    colors.push(rgb3);
    colors.push(rgb4);

    return colors


}

function findPartition(imgData, startheight, startwidth, endheight, endwidth,imgwidth) {
    rgb = { r: 0, g: 0, b: 0 };
    count = 0;
   
    for (var i = startwidth ; i < endwidth ; i += 4) {

        for (var j = startheight ; j < endheight ; j += 4) {
            
            let index = i + (j*imgwidth);
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

function checkIncludes(color1, color2) {

    if (color1.r == color2.r &&
        color1.g == color2.g &&
        color1.b == color2.b) {

        return true;
    }
    else {
        return false;
    }
}




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
    console.log(rgb.length);
    console.log(rgb)
    for (var i =0; i<rgb.length; i++){
    document
        .getElementById("block" + i)
        .style.backgroundColor =
        'rgb(' + rgb[i].r + ','
        + rgb[i].g + ','
        + rgb[i].b + ')';
    }

}
setTimeout(() => {

    setColors();



}, 500)