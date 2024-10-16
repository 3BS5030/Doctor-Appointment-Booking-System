<?php
include_once "../shared/config.php";
include_once "../shared/head.php";

$department_id = $_GET['update'];
$editedSql = "select * from department where id='$department_id'";
$result = mysqli_query($conn, $editedSql);
$department = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
  extract($_POST);
  $update = "UPDATE department 
           SET `department_name`='$name'WHERE `id`=$department_id";
  mysqli_query($conn, $update);
  header("Location: index.php");
  exit();
}

?>
<div class="ms-5 my-5 ps-5 d-flex">
  <a href="index.php" class="btn btn-info back text-light"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>

<h2 class="text-center title my-3 title-dr-edit">Edit Department \<?= $department['department_name'] ?></h2>

<form class="add-docs-form" method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Department Name</label>
    <input required name="name" type="text" class="form-control" id="name" placeholder="Enter new department name" value="<?= $department['department_name'] ?>">
  </div>
  <button type="submit" class="btn btn-success" name="update"><i class="fa-solid fa-pen"></i> Update</button>
</form>

<?php
include_once "../shared/scripts.php";
?>