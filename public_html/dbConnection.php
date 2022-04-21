<?php 

function connectToDB(){
    require("../systemData.php");
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

//verification functions:

function verifyUser($username, $password){
    $sql = "SELECT COUNT(*) AS TOTAL FROM user WHERE USER_NAME = '" . $username . "' AND 
    USER_PASSWORD = '" . $password . "'";
    $result = getFromDB($sql);
    $data = mysqli_fetch_assoc($result);    

    $count = $data['TOTAL'];

    //echo "verifyUser(): count = $count\n";
    //echo "value = ". ($count == 1?'t':'f') . "\n";
    return $count == 1;
}

function verifyUsernameNotTaken($username){
    $sql = "SELECT COUNT(*) AS TOTAL FROM user WHERE USER_NAME = '" . $username . "'";
    $result = getFromDB($sql);
    $data = mysqli_fetch_assoc($result);

    //returns true if username is NOT taken
    return $data['TOTAL'] == 0;
}

//select data functions:

function getUserID($username){
    $sql = "SELECT USER_ID FROM user WHERE USER_NAME = '" . $username . "'";
    return getFromDB($sql);
}

function getUserFriends($id){
    $sql = "SELECT FRIEND_ID FROM friend WHERE USER_ID = " . $id;
    return getFromDB($sql);
}

function getUserSavedPaletteIDs($userID){
    $sql = "SELECT PALETTE_ID FROM saved_palette WHERE USER_ID = " . $userID;
    return getFromDB($sql);
}

function getPaletteInfo($paletteID){
    $sql = "SELECT PALETTE_NAME, USER_NAME, HEXCODE1, HEXCODE2, HEXCODE3, 
    HEXCODE4, HEXCODE5 FROM (palette INNER JOIN user ON palette.USER_ID =
    user.USER_ID)";
    return getFromDB($sql);
}

//functions specifically to get search information:
    function findPaletteByColor($searchString){
        $sql = "SELECT PALETTE_ID FROM palette 
        WHERE HEXCODE1 = '" . $searchString . "'
        OR HEXCODE2 = '" . $searchString . "'
        OR HEXCODE3 = '" . $searchString . "'
        OR HEXCODE4 = '" . $searchString . "'
        OR HEXCODE5 = '" . $searchString . "'";
        return getFromDB($sql);
    }

    function findPaletteByCreatorUsername($searchString){
        $sql = "SELECT PALETTE_ID FROM (palette INNER JOIN user 
        ON palette.USER_ID = user.USER_ID) 
        WHERE USER_NAME = '" . $searchString . "'";
        return getFromDB($sql);
    }

    function findPaletteByTitle($searchString){
        $sql = "SELECT PALETTE_ID, HEXCODE1, HEXCODE2, HEXCODE3, HEXCODE4, HEXCODE5 FROM palette WHERE 
        PALETTE_NAME = '" . $searchString . "'";
        return getFromDB($sql);
    }

//insert data functions:

function sendNewUserToDb($username, $password){
    //assuming username has already been checked to make sure it has not been taken
    $sql = "INSERT INTO user (USER_NAME, USER_PASSWORD) VALUES ('". $username . "', '"
    . $password . "')";
    return sendToDB($sql);
    
}

function sendNewPaletteToDb($userID, $paletteName, $hex1, $hex2, $hex3, $hex4, $hex5){
    $sql = "INSERT INTO palette (USER_ID, PALETTE_NAME, HEXCODE1, HEXCODE2, 
    HEXCODE3, HEXCODE4, HEXCODE5, DATE_CREATED, NUM_VIEWS) VALUES ('" . $userID . "', '"
    . $paletteName . "', '" . $hex1 . "', '" . $hex2 . "', '" . $hex3 . "', '" . $hex4 . 
    "', '" . $hex5 . "', now(), '0')";
    return sendToDB($sql);
}

function getUserHashedPasswordFromDB($searchString)
{
    $sql = "SELECT USER_PASSWORD FROM user WHERE
            USER_NAME = '" . $searchString . "'";
            return getFromDB($sql);
    
}

?>