<?php require('./files/head.php'); ?>

<?php
$n_id=$_GET['n_id'];
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die ("connect fail");
$query = "SELECT * FROM novel where n_id = '$n_id'";
$result = $connect->query($query);
$row = mysqli_fetch_array($result);

$u_id = $row['u_id'];
$n_title = $row['n_title'];
$n_genre = $row['n_genre'];
$n_detail = $row['n_detail'];
$n_image = $row['n_image'];

$query = "SELECT * FROM user where u_id = '$u_id'";
$result = $connect->query($query);
$row = mysqli_fetch_array($result);

$u_nick = $row['u_nick'];

?>

<br>

<div class="container">

    <hr>
    <div class="row">
        <div class="col-lg-8">
            <!-- Title -->
            <h1 class="mt-4"><?php echo $n_title; ?></h1>
            <!-- Author -->
            <span class="badge badge-pill badge-secondary"><img src="/imgs/icons/writer.png" width="16" height="16"><?php echo $u_nick; ?></span>

            <hr>

            <!-- Book info -->
            <span class="badge badge-pill badge-secondary"><img src="/imgs/icons/book.png" width="16" height="16"><?php echo $n_genre; ?></span>
            <!-- <span class="badge badge-pill badge-secondary"><img src="/imgs/icons/view.png" width="16" height="16"> 10</span> -->
            <!-- <span class="badge badge-pill badge-secondary"><img src="/imgs/icons/comment.png" width="16" height="16"> 10</span> -->

            <hr>

            <!-- Book Cover -->
            <img class="img-fluid rounded" src="./imgs/covers/<?php echo $n_image; ?>" width="300" height="auto" style="text-align: center">

            <hr>

            <!-- Book Detail -->
            <h5><?php echo $n_detail; ?></h5>

            <ul class="list-group">

                <?php
                $query = "SELECT * FROM page where n_id = '$n_id' order by n_id desc";
                $result = $connect->query($query);
                while($data = mysqli_fetch_array($result)) {
                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    echo '<a href="page.php?p_id='.$data['p_id'].'">';
                    echo $data['p_title'];
                    echo '</a>';
                    echo '<div style="text-align: right"';
                    echo '<span class="badge badge-pill badge-secondary"><img src="/imgs/icons/view.png" width="16" height="16"><strong style="font-size:12px; margin-right: 15px">'.$data['p_views'].'</strong></span>';
                    if ($userNickname == $u_nick){
                        echo '<a href="./logics/deletePage.php?p_id='.$data['p_id'].'">';
                        echo '<span class="badge badge-danger">회차 삭제</span>';
                        echo '</a>';
                    }
                    echo '</div>';
                    echo '</li>';
                }
                ?>
            </ul>

            <?php
            if ($userNickname == $u_nick){
                echo '<div style="text-align:right"><button type="button" onclick="location.href=\'addPage.php?n_id='.$n_id.'\'" class="btn-sm btn-primary" style="user-select: auto; margin-right: 20px; margin-top: 10px">회차 추가</button></div>';
            }
            ?>

            <hr>

            <h1 class="mt-4">리뷰</h1> <br>

                <?php
                $isFirst = true;
                $query = "SELECT * FROM review where n_id = '$n_id' order by r_time desc";
                $result = $connect->query($query);
                while($data = mysqli_fetch_array($result)) {
                    echo '<div class=\'row\'>';
                    echo '<div class="media-body">';
                    echo '<h5 class="mt-0">'.$data['u_nick'].'</h5>';
                    if ($isFirst){
                        echo '<span class="badge badge-success">new</span>';
                        $isFirst = false;
                    }
                    echo '<strong>'.$data['r_content'].'</strong>';
                    echo '<p><small class="text-muted">'.$data['r_time'].'</small></p>';
                    if ($data['u_nick'] == $userNickname){
                        echo '<div style="text-align:right">';
                        echo '<a href="./logics/deleteReview.php?r_id='."{$data['r_id']}".'"><span class="badge badge-danger" style="user-select: auto; margin-right:10px;">댓글 삭제</span></a>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '<hr>';
                }
                ?>

                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">리뷰 남기기</h5>
                    <div class="card-body">
                        <form method='post' action="../logics/addReview.php">
                            <textarea class="form-control" name="r_content" rows="3" placeholder="댓글을 작성하려면 로그인 해주세요"></textarea>
                            <input type="hidden" name="u_nick" value="<?php echo $userNickname; ?>">
                            <input type="hidden" name="n_id" value="<?php echo $n_id; ?>">
                            <div style="text-align: right; margin-right:15px; margin-top:10px"><button type="submit" class="btn btn-outline-secondary btn-sm">submit</button></div>
                        </form>
                    </div>
                </div>

        </div>

        <!-- Sidebar -->
        <div class="col-md-4">

            <div class="card my-4">
                <h5 class="card-header">같은 장르의 다른 작품</h5>
                <div class="card-body">
                        <?php
                        $query = "SELECT * FROM novel where n_genre = '$n_genre' order by rand() limit 2";
                        $result = $connect->query($query);
                        while($data = mysqli_fetch_array($result)) {
                            echo '<div class="row">';
                            echo '<div class="col-md-6"><img src="./imgs/covers/'.$data['n_image'].'" width="auto" height="128"></div>';
                            echo '<div class="col-md-6"><h4>'.$data['n_title'].'</h4><p>'.$data['n_detail'].'</p></div>';
                            echo '</div>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<!-- Footer -->
<?php require('./files/foot.php'); ?>