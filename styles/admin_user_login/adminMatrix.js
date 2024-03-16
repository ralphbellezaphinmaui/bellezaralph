var c = document.getElementById("c");
var ctx = c.getContext("2d");

//chinese characters - taken from the unicode charset
var matrix = "01001000 01100101 01101100 01101100 01101111 00100000 01110000 01100001 01101110 01100101 01101100 01101001 01110011 01110100 01110011 00101100 00100000 01001001 00100000 01100011 01101111 01110000 01101001 01100101 01100100 00100000 01110100 01101000 01101001 01110011 00100000 01101101 01100001 01110100 01110010 01101001 01111000 00100000 01110010 01100001 01101001 01101110 00100000 01100001 01101110 01101001 01101101 01100001 01110100 01101001 01101111 01101110 00100000 01100011 01101111 01100100 01100101 00100000 01100110 01110010 01101111 01101101 00100000 01100001 00100000 01100111 01101001 01110100 01101000 01110101 01100010 00100000 01110010 01100101 01110000 01101111 01110011 01101001 01110100 01101111 01110010 01111001 00100000 01100001 01101110 01100100 00100000 01101101 01101111 01100100 01101001 01100110 01111001 00100000 01101001 01110100 00100000 01110101 01110011 01101001 01101110 01100111 00100000 01100011 01101111 01110000 01101001 01101100 01101111 01110100";
//converting the string into an array of single characters
matrix = matrix.split("");

var font_size = 10;
var columns; //number of columns for the rain
//an array of drops - one per column
var drops = [];

// Update the canvas size and recalculate the number of columns
function updateSize() {
  c.height = window.innerHeight;
  c.width = window.innerWidth;
  columns = c.width/font_size;
  drops = [];
  for(var x = 0; x < columns; x++)
    drops[x] = 1


}

// Call updateSize initially and when the window is resized
updateSize();
window.addEventListener('resize', updateSize);

//drawing the characters
function draw()
{
    //Black BG for the canvas
    //translucent BG to show trail
    ctx.fillStyle = "rgba(0, 0, 0, 0.04)";
    ctx.fillRect(0, 0, c.width, c.height);

    ctx.fillStyle = "#00ff00";//green text
    ctx.font = font_size + "px arial";
    //looping over drops
    for(var i = 0; i < drops.length; i++)
    {
        //a random character to print
        var text = matrix[Math.floor(Math.random()*matrix.length)];
        //x = i*font_size, y = value of drops[i]*font_size
        ctx.fillText(text, i*font_size, drops[i]*font_size);

        //sending the drop back to the top randomly after it has crossed the screen
        //adding a randomness to the reset to make the drops scattered on the Y axis
        if(drops[i]*font_size > c.height && Math.random() > 0.975)
            drops[i] = 0;

        //incrementing Y coordinate
        drops[i]++;
    }
}

setInterval(draw, 30);
