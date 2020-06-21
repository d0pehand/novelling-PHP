<?php require('./files/head.php'); ?>

<?php
$p_id=$_GET['p_id'];
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die ("connect fail");
$query = "SELECT * FROM page where p_id = '$p_id'";
$result = $connect->query($query);
$row = mysqli_fetch_array($result);

$n_id = $row['n_id'];
$p_title = $row['p_title'];
$p_views = $row['p_views'];
$p_content = $row['p_content'];
$p_time = $row['p_time'];

$query = "UPDATE page SET p_views = $p_views + 1 where p_id = $p_id";
$result = $connect->query($query);

?>

    <br>

    <div class="container">

        <hr>
        <div class="row">
            <div class="col-lg-8">
                <!-- Title -->
                <h1 class="mt-4"><?php echo $p_title; ?></h1>

                <hr>

                <span class="badge badge-pill badge-secondary"><img src="/imgs/icons/view.png" width="16" height="16"><?php echo $p_views + 1; ?></span>
                <span class="badge badge-pill badge-secondary"><img src="/imgs/icons/time.png" width="16" height="16"><?php echo $p_time; ?></span>

                <hr>

                <div class="card border-secondary mb-3" style="max-width: 60rem;">
                    <div class="card-body">
                        <p class="card-text"><?php echo $p_content; ?></p>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-md-4">

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- Footer -->
<?php require('./files/foot.php'); ?>