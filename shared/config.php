<?php
$host="localhost";
$user="root";
$pass="";
$dbname="hospital_db";
$conn = mysqli_connect($host, $user, $pass, $dbname);

function reset_sessions(){
    session_unset();
    session_destroy();
}
?>