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
        <button name="submit" type="submit" action="login.php">LOGIN</button>
    </form>

      <?php
      if(isset($_POST['submit'])){
        require("./dbConnection.php");
        $username =$_POST['username'];
        $doesUserExist = verifyUser($username, $_POST['password']);
        
        if($doesUserExist){
          // echo"User exists";  

          header("Location: homePageLoggedIn.php?user=$username");
          exit;
        }
        else
          echo "Username or password is incorrect.";
      }
      ?>
    </div>
</body>
</html>

