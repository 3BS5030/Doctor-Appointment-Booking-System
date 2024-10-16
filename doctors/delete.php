<?php
session_start();
include_once "../shared/config.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $image=$_GET['image'];
    unlink("./upload/ " . $image);
    $delete = "DELETE FROM doctors WHERE `id`='$id'";
    mysqli_query($conn, $delete);
    $_SESSION['deleted']=true;
    header("Location: index.php");
    exit();
}
?>