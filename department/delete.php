<?php
session_start();
include_once "../shared/config.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM department WHERE `id`='$id'";
    mysqli_query($conn, $delete);
    $_SESSION['deleted'] = true;
    header('Location: index.php');
    exit();
}
