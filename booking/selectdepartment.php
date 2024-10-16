<?php
include_once "../shared/config.php";
include_once "../shared/head.php";
$select_departments = "select * from department ";
$departments = mysqli_query($conn, $select_departments);
?>
<div class="ms-5 my-5 ps-5 d-flex">
    <a href="index.php" class="btn btn-info back text-light"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
<h2 class="text-center title my-5 py-5">Select a Department</h2>
<div class="container text-center my-5">
    <div class="row justify-content-evenly mx-0">
        <?php
        if ($departments->num_rows > 0):
            foreach ($departments as $department):
        ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="selectDoctor.php?department_id=<?= $department['id'] ?>" class="btn choose-dep my-3">
                        <div class="d-flex flex-column">
                            <div class="symbol">
                                <i class="fa-solid fa-notes-medical"></i>
                            </div>
                            <div class="department">
                                <h3><?= $department['department_name'] ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            endforeach;
        else:
            ?>
            <h3 class="text-center no-doctors">No Departments Found For Book</h3>
        <?php
        endif;
        ?>
        ?>
    </div>
</div>
<?php
include_once "../shared/scripts.php";
?>