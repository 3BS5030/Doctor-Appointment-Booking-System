<?php
session_start();
include_once "../shared/config.php";
include_once "../shared/head.php";
$departments = mysqli_query($conn, "select * from department");
if (isset($_POST['insert'])) {
  extract($_POST);
  $insert = "INSERT INTO department(`department_name`) values ('$name')";
  mysqli_query($conn, $insert);
  $_SESSION['inserted'] = true;
  header("Location: index.php");
  exit();
}
?>
<div class="ms-5 my-5 ps-5 d-flex">
  <a href="index.php" class="btn btn-info back text-light"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
<h2 class="text-center title my-3">insert a Department</h2>
<form class="add-docs-form" method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Department Name</label>
    <input required name="name" type="text" class="form-control" id="name" placeholder="Enter department name">
  </div>

  <button type="submit" class="btn btn-success" name="insert"><i class="fa-solid fa-plus"></i> Add department</button>
</form>

<?php
include_once "../shared/scripts.php";
?>