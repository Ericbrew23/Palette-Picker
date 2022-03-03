<?php declare(strict_types=1);

function connectToDB(){
    require("./systemData.php");
    $conn = new mysqli($SERVER, $DB_USER, $DB_PASSWORD, $DB_NAME);

    if($conn->connect_error){
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function closeDB($conn){
    $conn->close();
}

function getFromDB($sql) {
    $conn = connectToDB();
    $result = $conn->query($sql);  //mysqli_query($conn, $sql); 
    if($result == false){
        echo "false";
    }
    closeDB($conn);
    return $result;
}

function sendToDB($sql){
    $conn = connectToDB();
    $result = $conn->query($sql);
    closeDB($conn);
    return $result;
}

function verifyUser(){
    // $sql = SELECT //
}


//select data
function getUserID($username){
    $sql = "SELECT USER_ID FROM USER WHERE USER_NAME = '" . $username . "'";
    return getFromDB($sql);
}

function getUserFriends($id){
    $sql = "SELECT FRIEND_ID FROM FRIEND WHERE USER_ID = " . $id;
    return getFromDB($sql);
}

function getUserSavedPalettes(){

}

//insert data
function createUser($username, $password){
    //if(getuserID($username)) //if no user ids returned
    
}

//test