<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Palette Picker Home Page (Logged In)</title>
    <meta charset="utf-a" />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <?php
    //$user = $_GET['username'];
    $user = $_GET['user'];
    //echo "username = " . $user;
    ?>
    
    <ul>
      <li><p id="list">Welcome, <?php echo $user ?></p></li>
      <!--<li><a href="homePageLoggedIn.html">(LogginHP)</a></li>-->
    </ul>

    <img
      src="images/RainbowHeader.png"
      alt="A rainbow gradient with 
        black stripes."
    />

    <div id="L_PCButton">
      <button type="button">Go to Palette Creator</button>
    </div>
  </body>
</html>
