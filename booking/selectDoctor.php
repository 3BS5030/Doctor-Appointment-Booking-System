
<?php
session_start();
include_once "../shared/config.php";
include_once "../shared/head.php";
$_SESSION['department_id'] = $_GET['department_id'];
$department_id = $_GET['department_id'];
$select_doctors = "select * from doctors where `department_id` = '$department_id'";
$doctors = mysqli_query($conn, $select_doctors);
?>
<div class="ms-5 my-5 ps-5 d-flex">
    <a href="selectdepartment.php" class="btn btn-info back text-light"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
<h2 class="text-center title my-5 py-5">Select a Doctor</h2>
<div class="container text-center my-5">
    <div class="row justify-content-evenly mx-0">
        <?php
        if ($doctors->num_rows > 0):
            foreach ($doctors as $doctor):
        ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="create.php?doctor_id=<?= $doctor['id'] ?>" class="btn choose-dep my-3">
                        <div class="d-flex flex-column">
                            <div class="doctor-image">
                                <img src="../doctors/upload/ <?= $doctor['image'] ?>" alt="">
                            </div>
                            <div class="department">
                                <h3><?= $doctor['name'] ?></h3>
                                <span class="dr-details"><?php echo($doctor['day']." ".$doctor['time']);?> </span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            endforeach;
        else:
            ?>
            <h3 class="text-center no-doctors">No Doctors Found On This Department</h3>
        <?php
        endif;
        ?>
    </div>
</div>
<?php
include_once "../shared/scripts.php";
?>