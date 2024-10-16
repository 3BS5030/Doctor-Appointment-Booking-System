
<?php
include_once "../shared/config.php";
include_once "../shared/head.php";
session_start();
$departments = mysqli_query($conn, "select * from department");
$time = mysqli_query($conn, "select * from doctors");
if (isset($_POST['insert'])) {
  extract($_POST);
  $tmp = $_FILES['doctorImage']['tmp_name'];
  $new_image = rand(1, 600) . $_FILES['doctorImage']['name'];
  $location = "./upload/ " . $new_image;
  move_uploaded_file($tmp, $location);
  $insert = "INSERT INTO doctors (`name`, `department_id`,`time`, `image`,`day`) 
VALUES ('$name','$department','$time','$new_image','$day')";
  mysqli_query($conn, $insert);
  header(header: "Location: index.php");
  $_SESSION['inserted']=true;
  exit();
}
?>
<div class="ms-5 my-5 ps-5 d-flex">
    <a href="index.php" class="btn btn-info back text-light"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
<h2 class="text-center title my-3">insert a Doctor</h2>
<form class="add-docs-form" method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input  required name="name" type="text" class="form-control" id="name" placeholder="Enter doctor name">
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
    <label for="day">day</label>
    <select class="form-control" id="day" name="day">
    <option value="saturday">saturday</option>
    <option value="sunday">Sunday</option>
    <option value="monday">monday</option>
    <option value="tuesday">tuesday</option>
    <option value="wednesday">wednesday</option>
    <option value="thursday">thursday</option>
    <option value="friday">friday</option>
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
    <label for="image" class="btn btn-info">Select Image:</label>
    <input required id="image" class="form-control my-4" style="display: none;" name="doctorImage" accept="image/*" type="file" placeholder="Select an image">
  </div>

  <button type="submit" class="btn btn-success" name="insert"><i class="fa-solid fa-plus"></i> Add</button>
</form>

<?php
include_once "../shared/scripts.php";
?>