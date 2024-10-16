
<?php
session_start();
include_once "../shared/config.php";
include_once "../shared/head.php";
$select_booking = "select * from booking ";
$bookings = mysqli_query($conn, $select_booking);
function searchRecord($search, $conn)
{
    $searchsql = "SELECT * FROM booking 
                WHERE `patient_id` LIKE '%$search%' 
                OR `patient_name` LIKE '%$search%' 
                OR `doctor_name` LIKE '%$search%' 
                OR `day` LIKE '%$search%' 
                OR `time` LIKE '%$search%' 
                OR `department_name` LIKE '%$search%'";

    $bookings = mysqli_query($conn, $searchsql);

    return $bookings; 
}

if (isset($_GET['search'])) {
    extract($_GET);
    $bookings = searchRecord($searched, $conn);
}

?>
<h2 class="text-center title my-5 py-5">booking Details</h2>
<div class="insert-btn">
    <a href="./selectdepartment.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Book a doctor</a>
</div>
<div>
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
    <table class="table">
        <thead class="table-head">
            <tr>
                <th>#ID</th>
                <th>Patient Name</th>
                <th>Dr.Name</th>
                <th>Department Name</th>
                <th>Day</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if (($bookings->num_rows > 0)):
                foreach ($bookings as $book):
            ?>
                    <tr>
                        <td><?= $book['patient_id'] ?></td>
                        <td><?= $book['patient_name'] ?></td>
                        <td><?= $book['doctor_name'] ?></td>
                        <td><?= $book['department_name'] ?></td>
                        <td><?= $book['day'] ?></td>
                        <td><?= $book['time'] ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <h3 class="text-center py-5"> No booking recorded <?php 
                        if(isset($_GET['search'])): echo("for \"". $_GET['searched']."\"");
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