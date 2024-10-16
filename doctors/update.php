
<?php
include_once "../shared/config.php";
include_once "../shared/head.php";
$id=$_GET['update'];
$editedSql="select * from doctors where id=$id";
$result=mysqli_query($conn,$editedSql);
$doctorOldData=mysqli_fetch_assoc($result);
$departments = mysqli_query($conn, "select * from department");


if (isset($_POST['update'])) {
  $new_image=$doctorOldData['image'];
  extract($_POST);
  if(!empty($_FILES['doctorImage']['tmp_name'])){
    unlink("./upload/ " . $new_image);
    echo $new_image;
    $tmp = $_FILES['doctorImage']['tmp_name'];
    $new_image = rand(1, 600) . $_FILES['doctorImage']['name'];
      $location = "./upload/ " . $new_image;
      move_uploaded_file($tmp, $location);
    }
    $update = "UPDATE doctors 
    SET `name` = '$name', 
        `time` = '$time', 
        `department_id` = '$department', 
        `image` = '$new_image' 
    WHERE `id` = '$id'";
  mysqli_query($conn, $update);
  header("Location: index.php");
}
?>
<div class="ms-5 my-5 ps-5 d-flex">
    <a href="index.php" class="btn btn-info back text-light"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
<h2 class="text-center title my-3">Edit DR\<?=$doctorOldData['name'] ?>'s Profile</h2>
<div class="doctor-photo">
  <img src="./upload/%20<?=$doctorOldData['image']?>" alt="">
</div>
<form class="add-docs-form" method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input required name="name" type="text" class="form-control" id="name" placeholder="Enter new doctor name" value="<?= $doctorOldData['name'] ?>">
  </div>

  <div class="form-group">
    <label for="department">department</label>
    <select class="form-control" id="department" name="department">
      <?php
      foreach ($departments as $department):
      ?>
        <option value="<?= $department['id'] ?>"><?= $department['department_name'] ?></option>
      <?php endforeach;
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="time">Work Time</label>
    <select class="form-control" id="time" name="time">
    <?php
    for ($i = 1; $i <= 24; $i++):
        $time = $i % 12 == 0 ? 12 : $i % 12;
        $ampm = $i < 12 || $i == 24 ? 'AM' : 'PM';
    ?>
        <option value="<?= $time . ' ' . $ampm  ?>"><?= $time . ' ' . $ampm ?></option>
    <?php endfor; ?>
</select>

  </div>

  <div class="form-group">
    <label for="image" class="btn btn-info">Select new image name:</label>
    <input id="image" class="form-control my-4" style="display: none;" name="doctorImage" accept="image/*" type="file" placeholder="Select a new image">
  </div>

  <button type="submit" class="btn btn-success" name="update"><i class="fa-solid fa-plus"></i> Update</button>
</form>

<?php
include_once "../shared/scripts.php";
?>