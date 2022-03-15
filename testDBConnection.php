<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Database Test</title>
    <meta charset="utf-8" />

  </head>
  <body>
        <h1>DB Test</h1>

        <p>Test getUserID</p>
        <?php
        require("./dbConnection.php");

        $res = getUserID("exampleUser");

        if ($res->num_rows > 0) {
          while($row = $res->fetch_assoc())     
            echo "exampleUser ID: " . $row["USER_ID"];
        }    

        ?>
        <p>Test verifyUser</P>
        <?php
        //require("./dbConnection.php");
        $res = verifyUser("exampleUser", "password");

        if($res == true)
          echo "User is verified.";
        else
          echo "User is not verified.";


        $res2 = verifyUser("exampleUser", "pwd");
        if($res2 == true)
          echo "User is verified.";
        else
          echo "User is not verified.";

        ?>

  </body>
</html>