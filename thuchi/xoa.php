<?php
$servername = "localhost";
$username = "nguogxaj_chualongtho";
$password = "j?%0e#Yy=Zy+";
$dbname = "nguogxaj_chualongtho";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['id'])){
    $sqlxoa="DELETE FROM `thuchi` WHERE id = ".$_POST['id'];
    $result = $conn->query($sqlxoa);
    if ($result == true) {
       return "true";
    } else {
        return "false";
    }
}