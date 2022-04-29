<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Search Page</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles.css" />

    <script>
      
      function getColors(hexnum, element){
        var c = document.getElementById(element);
        var ctx = c.getContext("2d");
        ctx.fillStyle = `#${hexnum}`;
        ctx.fillRect(2, 2, c.width, c.height);
      }
      
      function getRectangle(id, hex1, hex2, hex3, hex4, hex5){
        //alert("hh");
        //let colornum = 1;
        let result = document.getElementById("results").innerHTML + 
        `<div id="result${id}" style="float:left; padding: 50px;">`;

        result +=`<div id="Colour${id}-1" 
        style="width:50px; height:100px;float:left; 
        background-color:#${hex1};"></div>`;
        result +=`<div id="Colour${id}-2" 
        style="width:50px; height:100px; float:left;
        background-color:#${hex2};"></div>`;
        result +=`<div id="Colour${id}-3" 
        style="width:50px; height:100px; float:left;
        background-color:#${hex3};"></div>`;
        result +=`<div id="Colour${id}-4" 
        style="width:50px; height:100px; float:left;
        background-color:#${hex4};"></div>`;
        result +=`<div id="Colour${id}-5" 
        style="width:50px; height:100px; float:left;
        background-color:#${hex5};"></div>`;
        

        result+="</div>";
        //alert(result);

        document.getElementById("results").innerHTML = result;

        
      }
        
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
    
    <div id="results"></div>

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

            echo '<script>
            getRectangle("' . $id . '", "' . $hex1 . '", "' . $hex2 . '", "'
            . $hex3 . '", "' . $hex4 . '", "' . $hex5 . '");</script>';

            echo '<script>alert("' .  $hex1  . '");</script>';
            
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


<!--
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
    -->

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
