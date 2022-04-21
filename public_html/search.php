<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Search Page</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles.css" />

    <script>
      let resultNum=1;

      function getColors(hexnum, element){
        var c = document.getElementById(element);
        var ctx = c.getContext("2d");
        ctx.fillStyle = `#${hexnum}`;
        ctx.fillRect(10, 10, 50, 80);
      }
      /*
      function getCanvas(resElem){
        resultNum++;
        document.getElementById(resElem).innerHTML = 
        `<canvas id="${resElem}-Colour1" width="50" Height="100">
                getColors("<?php echo $hex1 ?>", "${resElem}-Colour1");
        </canvas>
        <canvas id="${resElem}-Colour2" width="50" Height="100">
                getColors("<?php echo $hex2 ?>", "${resElem}-Colour2");
        </canvas>
        <canvas id="${resElem}-Colour3" width="50" Height="100">
            getColors("<?php echo $hex3 ?>", "${resElem}-Colour3");
        </canvas>
        <canvas id="${resElem}-Colour4" width="50" Height="100">
              getColors("<?php echo $hex4 ?>", "${resElem}-Colour4");
        </canvas>
        <canvas id="${resElem}-Colour5" width="50" Height="100">
              getColors("<?php echo $hex5 ?>", "${resElem}-Colour5");
        </canvas>`
      }
      */
      /*
      function getColors(hexnum, index){
        alert("here2");
        var c = document.getElementById("Colour" + index);
        var ctx = c.getContext("2d");
        ctx.fillStyle = `#${hexnum}`;
        ctx.fillRect(10, 10, 50, 80);;
      }
      function getCanvas(id, hex1, hex2, hex3, hex4, hex5){
        alert("hh");
        let colornum = 1;
        let result = `<div id="result${resultNum}">\n<canvas id="Colour${colornum}" width="50" Height="100">`;

        result+= getColors(hex1, colornum);
        colornum++;

        result+="</canvas></div>";

        document.getElementById("results").innerhtml = result;
        resultNum++;
        */
    </script>
  </head>
  <body>
    <ul>
      <li><a class="active" href="index.html">Home</a></li>
      <form method="POST">
      <li><input name="search" type="text" placeholder="Search.."></li>
      <li>
        <select name="searchType" id="searchType">
          <option value="title">Title</option>
          <option value="color">Color</option>
          <option value="creator">Creator</option>
      </select>

      </li>
      <li><input type="submit" name="submit"></li>
</form>
    </ul>

    <div id="imgHolder">
    <img id="rainbowImg"
      src="images/RainbowHeader.png"
      alt="A rainbow gradient with 
        black stripes."
    />
    </div>    

  <?php
      if(isset($_POST['submit'])){
        require("./dbConnection.php");
        $search =$_POST['search'];

        $hex1; $hex2; $hex3; $hex4; $hex5;

        $result = findPaletteByTitle($search);

        $numOfResults = $result->num_rows;

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()){ 
            $id = $row["PALETTE_ID"];
            $hex1 = dechex($row["HEXCODE1"]);
            $hex2 = dechex($row["HEXCODE2"]);
            $hex3 = dechex($row["HEXCODE3"]);
            $hex4 = dechex($row["HEXCODE4"]);
            $hex5 = dechex($row["HEXCODE5"]);

            //echo `<script> getCanvas("result" + <?php echo $index ;


            /*
            echo `<script>
            getColors("<?php echo $hex1 ?>", "Colour1");
            getColors("<?php echo $hex2 ?>", "Colour2");
            getColors("<?php echo $hex3 ?>", "Colour3");
            getColors("<?php echo $hex4 ?>", "Colour4");
            getColors("<?php echo $hex5 ?>", "Colour5");
            </script>`;
            */
            //$row = $result->fetch_assoc();
            /*
            echo `<script type="text/javascript">getCanvas("' . $id . '", 
            "' . $hex1 . '", "' . $hex2 . '", "' . $hex3 . '", "' . $hex4 . '", 
            "' . $hex5 . '");</script>`;
            */
          }
        }  else
        echo "No results";
      }  

  ?>



<div id="result1" name="result1">
  <canvas id="Colour1" width="50" Height="100">
  <script>
           getColors("<?php echo $hex1 ?>", "Colour1");
        </script>
    </canvas>
    <canvas id="Colour2" width="50" Height="100">
    <script>
           getColors("<?php echo $hex2 ?>", "Colour2");
        </script>
    </canvas>
    <canvas id="Colour3" width="50" Height="100">
      <script>
          getColors("<?php echo $hex3 ?>", "Colour3");
      </script>
    </canvas>
    <canvas id="Colour4" width="50" Height="100">
    <script>
           getColors("<?php echo $hex4 ?>", "Colour4");
        </script>
    </canvas>
    <canvas id="Colour5" width="50" Height="100">
        <script>
           getColors("<?php echo $hex5 ?>", "Colour5");
        </script>
    </canvas>
  </div>
  

    <!--
  <div id="result2"></div>
  <div id="result3"></div>
  <div id="result4"></div>
  <div id="result5"></div>
  <div id="result6"></div>
  <div id="result7"></div>
  <div id="result8"></div>
    -->
<!--
<div>
<canvas id="Colour5" width="50" Height="100" action="javascript:getColors(hex5, 5)">
    </canvas>
    
</div>
    -->
  </body>
</html>
