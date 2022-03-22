<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en">
<link rel="stylesheet" href="styles.css"/>
<head>
    <title>
        LOGIN
    </title>
</head>
<body>
    <ul>
        <li><a href="index.html">(Home)</a></li>
      </ul>
    <div id="rainbowImg">
        <img
          src="images/RainbowHeader.png"
          alt="A rainbow gradient with 
          black stripes."
        />
       
      </div>
    <div class="credentials" id="credentials">
        <h1>LOGIN</h1>
    <form method="POST">
        <label for="username"><b>Username: </b></label>
        <input type="text" name="username" id="username" required minlength="1" maxlength="250"><br>
        <label for="password"><b>Password: </b></label>
        <input style="position: relative; left: 2px;" type="password" name="password" id="password" required minlength="1" maxlength="16"><br>
        <button type="submit" href="homePageLoggedIn.html">LOGIN</button>
    </form>
      <?php
        require("./dbConnection.php");
        $doesUserExist = verifyUser($_POST['username'], $_POST['password']);
        
        if($doesUserExist){
          header("Location: ./homePageLoggedIn.html");
          exit;
        }
        else
          echo "Username or password is incorrect.";
      ?>
    </div>
</body>
</html>