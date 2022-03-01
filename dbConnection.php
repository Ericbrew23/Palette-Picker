<?php
require("./systemData.php");


function connectToDB(){
    $conn = new mysqli($SERVER, $DB_USER, $DB_PASSWORD);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error());
    }
}

function closeDB(){
    $conn->close();
}

function verifyUser(){
    connectToDB();
    $sql = SELECT
}

function getUserID(){

}

function getUserFriends($id){
    connectToDB();
    $sql = SELECT FR FROM
}

function getUserSavedPalettes(){

}



?>