<style>
  .add-docs-form {
    width: 50%;
    margin: 0 auto;
    font-size: 2.2rem !important;

    button {
      font-size: 1.8rem;
      padding: 4px 18px;
      word-spacing: 2px;
      text-transform: uppercase;
    }
  }
</style>
<?php
session_start();
include_once "../shared/config.php";
include_once "../shared/head.php";
$department_id = $_SESSION['department_id'];
$doctor_id = $_GET['doctor_id'];
$doctorsTimes = "SELECT time,day FROM `doctors` where id ='$doctor_id'";
$doctors = mysqli_query($conn, $doctorsTimes);
if (isset($_POST['insert'])) {
  extract($_POST);
  $addBook = "insert into patient(`name`,`doctor_id`,`time`,`day`) values ('$name','$doctor_id','$Time','$day')";
  mysqli_query($conn, $addBook);
  $_SESSION['inserted'] = true;
  header("Location: index.php");
  exit();
}
?>
<h2 class="text-center title my-3">Book a Doctor</h2>
<form class="add-docs-form" method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input required name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
  </div>

  <div class="form-group">
    <label for="Time">Time :</label>
    <select class="form-control" id="Time" name="Time">
      <?php
      foreach ($doctors as $doctor):
      ?>
        <option value="<?= $doctor['time'] ?>"><?= $doctor['time'] ?></option>
      <?php
      endforeach;
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="day">day :</label>
    <select class="form-control" id="day" name="day">
      <?php
      foreach ($doctors as $doctor):
      ?>
        <option value="<?= $doctor['day'] ?>"><?= $doctor['day'] ?></option>
      <?php
      endforeach;
      ?>
    </select>
  </div>

  <div class="form-group">

  </div>

  <button type="submit" class="btn btn-success" name="insert"><i class="fa-solid fa-plus"></i> Add</button>
</form>

<?php
include_once "../shared/scripts.php";
?>