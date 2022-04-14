<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Search Page</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <ul>
      <li><a class="active" href="index.html">Home</a></li>
      <form method="POST">
      <li><input name="search" type="text" placeholder="Search.."></li>
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

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()){ 
            $hex1 = dechex($row["HEXCODE1"]);
            $hex2 = dechex($row["HEXCODE2"]);
            $hex3 = dechex($row["HEXCODE3"]);
            $hex4 = dechex($row["HEXCODE4"]);
            $hex5 = dechex($row["HEXCODE5"]);
          }
        }  else
        echo "No results";
      }

  ?>

<div id="result1" name="result1">
  <canvas id="Colour1" width="100" Height="200">
        <script>
            var c = document.getElementById("Colour1");
            var ctx = c.getContext("2d");
            ctx.fillStyle = "<?php echo $hex1 ?>";
            ctx.fillRect(10, 10, 150, 80);
        </script>
    </canvas>
  </div>

  <div id="results" name="results"></div>

  </body>
</html>
