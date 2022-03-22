<?php
include ('dbconnection.php');

$username = $_POST['user'];
$password = $_POST['user'];

//Prevent sqlinjections
$username = stripclashes($username);
$password = stripclashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

$sql = "SELECT * FROM LOGIN WHERE USERNAME = '$username' and password = '$password'";
$result mysqli_query ($con, $sql);
$row mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if($count == 1)
{
    echo "<h1><center> Login Sucessful </center></h1>";

}
else
{
    echo "<h1> Login failed. Invalid username or password.</h1>";
}
?>