
<?php
session_start();
include_once "../shared/config.php";
include_once "../shared/head.php";
$select_doctors = "select * from doctors_and_departments";
$doctors = mysqli_query($conn, $select_doctors);

function searchRecord($search, $conn)
{
    $searchsql = "SELECT * FROM doctors_and_departments
                WHERE `id` LIKE '%$search%' 
                OR `name` LIKE '%$search%'
                OR `department_name` LIKE '%$search%'
                OR `time` LIKE '%$search%'
                OR `day` LIKE '%$search%'
                ";

    $doctors = mysqli_query($conn, $searchsql);

    return $doctors; // Assuming you want to return the result set for further processing
}

if (isset($_GET['search'])) {
    extract($_GET);
    $doctors = searchRecord($searched, $conn);
}

?>
<h2 class="text-center title my-5 py-5">Doctors Details</h2>
<div class="insert-btn">
    <a href="./create.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add a doctor</a>
</div>
<?php
if (isset($_SESSION['inserted'])):
?>
    <div class="alert alert-success" role="alert" id="alertSuccess">
        Doctor inserted successfully
    </div>
<?php
    reset_sessions();
endif;
?>
<?php
if (isset($_SESSION['deleted'])):
?>
    <div class="alert alert-danger" role="alert" id="alertSuccess">
        Doctor removed successfully
    </div>
<?php
    reset_sessions();
endif;
?>
    <form class="mt-5 mb-3 d-flex gap-2 w-50 mx-auto align-items-center search-form">
        <label class="form-label"><b>Search:</b></label>
        <input name="searched" type="text" class="form-control" required />
        <button name="search" type="submit" class="btn btn-warning text-light rounded-pill"><b><i class="fa-solid fa-magnifying-glass"></i></b></button>
    </form>
<div>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th>#ID</th>
                <th>name</th>
                <th>Department</th>
                <th>Day</th>
                <th>Time</th>
                <th>Image</th>
                <th colspan="2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (($doctors->num_rows > 0)):
                foreach ($doctors as $doctor):
            ?>
                    <tr>
                        <td><?= $doctor['doctor_id'] ?></td>
                        <td><?= $doctor['name'] ?></td>
                        <td><?= $doctor['department_name'] ?></td>
                        <td><?= $doctor['day'] ?></td>
                        <td><?= $doctor['time'] ?></td>
                        <td><img class="record-img" src="upload/ <?= $doctor['doctor_image'] ?>" /></td>
                        <td class="text-center"><a href="update.php?update=<?= $doctor['id'] ?>" class="btn btn-primary">edit</a></td>
                        <td class="text-center"><a href="delete.php?delete=<?= $doctor['id'] ?>&doctor_image=<?= $doctor['image'] ?>" class="btn btn-danger">delete</a></td>
                    </tr>
                <?php
                endforeach;
                ?>
            <?php else: ?>
                <tr>
                <td colspan="7" class="text-center">
                        <h3 class="text-center py-5"> No Doctors recorded <?php 
                        if(isset($_GET['search'])): echo("like \"". $_GET['searched']."\"");
                        endif;?></h3>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    if(isset($_GET['search'])):
?>

    <div class="show-all">
        <a href="index.php?" class="text-center mx-auto w-75 btn btn-dark mb-4">show all table</a>
    </div>
        <?php
endif; 
    ?>
</div>
<?php
include_once "../shared/scripts.php";
?>