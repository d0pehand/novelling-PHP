<?php require ('./files/head.php'); ?>

<?php
$n_id = $_GET['n_id'];
if(!(isset($_SESSION['userid'])||isset($_GET['n_id']))) {
    ?>
    <script>
        alert("로그인이 필요합니다");
        location.replace("index.php");
    </script>
    <?php
}
?>

    <br>

    <div class="container">
        <hr>
        <form method = "post" action = "../logics/addPage.php" enctype="multipart/form-data">

            <div align="center">
                <div class="card border-primary" style="max-width: 60rem;">
                    <div class="card-header" style="user-select: auto;"><h4>회차 추가</h4></div>
                    <div class="card-body" style="user-select:auto; align:left;">
                        <div align="left">

                            <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>제목</h5></label>
                            <input class="form-control form-control-sm" type="text" placeholder="제목을 입력해 주세요." name="title" style="user-select: auto;">

                            <hr>

                            <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>내용</h5></label>
                            <textarea class="form-control" placeholder="내용을 입력해 주세요." name="detail" rows="10" style="user-select: auto;"></textarea>

                            <input class="form-control form-control-sm" type="hidden" name="id" value="<?php echo $n_id ?>" style="user-select: auto;">

                        </div>

                        <button type="submit" class="btn-sm btn-primary" style="user-select: auto; margin: 15px">완료</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

<?php require('./files/foot.php'); ?>