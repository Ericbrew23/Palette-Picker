<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Database Test</title>
    <meta charset="utf-8" />

  </head>
  <body>
        <h1>DB Test</h1>
        <?php
        require("./dbConnection.php");

        $res = getUserID("exampleUser");//->fetch_assoc();

        if ($res->num_rows > 0) {
          while($row = $res->fetch_assoc())     
            echo "exampleUser ID: " . $row["USER_ID"];
        }    

        ?>
  </body>
</html>