<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en">
<link rel="stylesheet" href="styles.css"/>
<head>
    <title>
        Create Account
    </title>
</head>
<body>
    <ul>
        <li><a href="index.html">Home</a></li>
      </ul>
    <div id="imgHolder">
        <img id="rainbowImg"
          src="images/RainbowHeader.png"
          alt="A rainbow gradient with 
          black stripes."
        />
       
      </div>
    <div class="credentials" id="credentials">
        <h1>Create new account</h1>
    <form method="POST">
        <label for="username"><b>Username: </b></label>
        <input type="text" name="username" id="username" required minlength="1" maxlength="250"><br><br>
        <label for="password"><b>Password: </b></label>
        <input style="position: relative; left: 2px;" type="password" name="password" id="password" required minlength="1" maxlength="16"><br><br>
        <label for="confirmpass" style="position: relative; ;right: 32px;"><b>Confirm Password: </b></label>
        <input style="position: relative; right: 30px;" type="password" name="confirmPassword" id="confirmPassword" required minlength="1" maxlength="16"><br><br>
        <button name="submit" type="submit" href="homePageLoggedIn.html">Create Account</button>
    </form>
      <?php
      if(isset($_POST['submit']))
      {
        require("./dbConnection.php");
        $userDoesNotExist = verifyUsernameNotTaken($_POST['username']);
        if($_POST['password'] != $_POST['confirmPassword'])
        {
            echo "Passwords do not match";
            exit;
        }
        else if($userDoesNotExist){
          sendNewUserToDb($_POST['username'],$_POST['password']);
          echo "User Successfully Created";
          exit;
        }
        else if(!$userDoesNotExist)
        {
          echo "Username is already taken.";
        }
      }
     else
     {
       //Does nothing
     }
      ?>
    </div>
</body>
</html>