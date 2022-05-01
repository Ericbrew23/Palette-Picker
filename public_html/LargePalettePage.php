<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Large Palette Page</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles.css" />
  
      <script>
        /*
        var queryString = location.search.substring(1);
        var a =queryString.split("|");
        var id = parseInt(a[0]);
        */
       // alert(id);

       function fillFromDB(palName, creator, hex1, hex2, hex3, hex4, hex5){
        document.getElementById("Colour1").style.backgroundColor=`#${hex1}`;
        document.getElementById("Colour2").style.backgroundColor=`#${hex2}`;
        document.getElementById("Colour3").style.backgroundColor=`#${hex3}`;
        document.getElementById("Colour4").style.backgroundColor=`#${hex4}`;
        document.getElementById("Colour5").style.backgroundColor=`#${hex5}`;

        let result = `<p>Palette Name: ${palName}\n</p>`;
        result += `<p>Hex Colors: ${hex1}, ${hex2},
          ${hex3}, ${hex4}, ${hex5}\n</p>`;
        result += `<a class="active" href="#creator">${creator}</a>`;

        document.getElementById("about").innerHTML = result;
       }
      </script>
</head>
<body >
<div class="topnav">
  <ul>
        <li><input type="text" placeholder="Search.."></li>
        <li><a class="active" href="#home">Alerts</a></li>
        <li><a class="active" href=#homePageLoggedIn.php>Profile</a></li>
      </ul>
      </div>

    <div id="container" style="margin:0 auto; width:100%; 
    display: flex; align-items: center; justify-content: center;
    padding-top: 25px; padding-bottom: 25px;">
      <div id="Colour1" 
        style="float:left;
        border: 1px solid black;
        text-align: center; 
        width: 300px;
        height: 500px;">
      </div>
      <div id="Colour2" 
        style="float:left;
        border: 1px solid black;
        text-align: center; 
        width: 300px;
        height: 500px;">
      </div>
      <div id="Colour3" 
        style="float:left;
        border: 1px solid black;
        text-align: center; 
        width: 300px;
        height: 500px;">
      </div>
      <div id="Colour4" 
        style="float:left;
        border: 1px solid black;
        text-align: center; 
        width: 300px;
        height: 500px;">
      </div> 
      <div id="Colour5" 
        style="float:left;
        border: 1px solid black;
        text-align: center; 
        width: 300px;
        height: 500px;">
      </div> 
      </div>
      <div class="about" id="about">
      </div>
      <br>
      <div id="button">
        <button type="button">Save to library</button>
      </div>
      <?php 
        require("./dbConnection.php");
        $search =$_GET['id'];
        //echo $search;

        $result = getPaletteInfo($search);
        //palette name, creator name, hex codes

        $numOfResults = $result->num_rows;
        //echo $numOfResults;

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()){ 
            $paletteName = $row["PALETTE_NAME"];
            $creator = $row["USER_NAME"];
            $hex1 = dechex($row["HEXCODE1"]);
            $hex2 = dechex($row["HEXCODE2"]);
            $hex3 = dechex($row["HEXCODE3"]);
            $hex4 = dechex($row["HEXCODE4"]);
            $hex5 = dechex($row["HEXCODE5"]);

            //echo $hex1;
            echo "<script>fillFromDB('" .
              $paletteName . "', '" .
              $creator . "', '" .
              $hex1 . "', '" .
              $hex2 . "', '" .
              $hex3 . "', '" .
              $hex4 . "', '" .
              $hex5 . "');</script>";

          }
        }      
    ?>
</body>

<style>
    .boxed {
   border: 1px solid black ;
   text-align: center; 
   width: 300px;
   height: 500px; 
   display: inline-block;
   background: rgb(250, 247, 247)
 }
 .about{
     text-align: left;
     padding-bottom: 5px;
     position:relative;
 }
  button {
  border: 1px solid black;
  color: white;
  background-color: rgb(92, 113, 134);
  padding: 16px;
  font-size: 16px;
  border-radius: 8px;
  /*margin: 50px 50%;*/
}
</style>
</html>