<?php
session_start();
include_once "../shared/config.php";
include_once "../shared/head.php";
$select_departments = "SELECT * FROM department";
$departments = mysqli_query($conn, $select_departments);
function searchRecord($search, $conn)
{
    $searchsql = "SELECT * FROM department 
                WHERE `id` LIKE '%$search%' 
                OR `department_name` LIKE '%$search%'";

    $departments = mysqli_query($conn, $searchsql);

    return $departments; // Assuming you want to return the result set for further processing
}

if (isset($_GET['search'])) {
    extract($_GET);
    $departments = searchRecord($searched, $conn);
}
?>

<h2 class="text-center title my-5 py-5">Departments Details</h2>
<div class="insert-btn">
    <a href="./create.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> add a Department</a>
</div>
<?php
if (isset($_SESSION['inserted'])):
?>
    <div class="alert alert-success" role="alert" id="alertSuccess">
        Department inserted successfully
    </div>
<?php
    reset_sessions();
endif;
?>
<?php
if (isset($_SESSION['deleted'])):
?>
    <div class="alert alert-danger" role="alert" id="alertSuccess">
        Department removed successfully
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
                <th class="text-center">#ID</th>
                <th class="text-center">Department Name</th>
                <th class="text-center" colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($departments->num_rows > 0): ?>
                <?php foreach ($departments as $department): ?>
                    <tr>
                        <td class="text-center"><?= $department['id'] ?></td>
                        <td class="text-center"><?= $department['department_name'] ?></td>
                        <td class="text-center"><a href="update.php?update=<?= $department['id'] ?>" class="btn btn-primary">edit</a></td>
                        <td class="text-center"><a href="delete.php?delete=<?= $department['id'] ?>" class="btn btn-danger">delete</a></td>
                        <td class="text-center"><a href="doctorWithDepartment.php?department_id=<?= $department['id'] ?>" class="btn btn-info">View Doctors</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <h3 class="text-center py-5"> No Departments recorded <?php
                                                                                if (isset($_GET['search'])): echo ("for \"" . $_GET['searched'] . "\"");
                                                                                endif; ?></h3>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    if (isset($_GET['search'])):
    ?>

        <div class="show-all">
            <a href="index.php?" class="text-center mx-auto w-75 btn btn-dark mb-4">show all table</a>
        </div>
    <?php
    endif;
    ?>
</div>

<!-- Bootstrap 5.0.2 JS and dependencies (Popper.js included) -->
<script src="/backend-tasks/task-5/css/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

</div>
<?php
include_once "../shared/scripts.php";
?>