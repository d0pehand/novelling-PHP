<?php require ('./files/head.php'); ?>

<?php
if(!isset($_SESSION['userid'])) {
    ?>
    <script>
        alert("로그인이 필요합니다");
        location.replace("index.php");
    </script>
    <?php
}
?>

<?php
if(isset($_GET['n_id'])) {
    $n_id=$_GET['n_id'];

    $connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die ("connect fail");
    $query = "SELECT * FROM novel where n_id = '$n_id'";
    $result = $connect->query($query);
    $row = mysqli_fetch_array($result);
    $u_Id = $row['u_id'];
    $n_title = $row['n_title'];
    $n_detail = $row['n_detail'];
    $n_image = $row['n_image'];

}
?>
<script>
    function deletenovel(n_id) {
        if(confirm('정말 작품을 삭제 하시겠습니까?')){
            location.replace("../logics/deleteNovel.php?n_id=" + n_id);
        }
    }

</script>

    <br>

    <div class="container">
        <hr>
        <form method = "post" action = "../logics/updateNovel.php" enctype="multipart/form-data">

            <div align="center">
                <div class="card border-primary" style="max-width: 60rem;">
                    <div class="card-header" style="user-select: auto;"><h4>작품 수정</h4></div>
                    <div class="card-body" style="user-select:auto; align:left;">
                        <div align="left">

                            <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>제목</h5></label>
                            <input class="form-control form-control-sm" type="text" placeholder="제목을 입력해 주세요." name="title" value="<?php echo $n_title; ?>" style="user-select: auto;">

                            <hr>
                            <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>내용</h5></label>
                            <input class="form-control form-control-sm" type="text" placeholder="내용을 입력해 주세요." name="detail" value="<?php echo $n_detail; ?>" style="user-select: auto;">

                            <hr>
                            <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>표지 이미지</h5></label>
                            <fieldset disabled="">
                            <input class="form-control form-control-sm" type="text" value="<?php echo $n_image; ?>">
                            </fieldset>
                            <input type="file" class="form-control form-control-sm" name="image" id="image">

                            <input type="hidden" name="id" value="<?php echo $n_id; ?>">
                        </div>

                        <button type="submit" class="btn-sm btn-primary" style="user-select: auto; margin: 15px">완료</button>
                    </div>
                </div>
            </div>

        </form>
        <div align="center">
            <button type="button" class="btn btn-danger" onclick="deletenovel(<?php echo $n_id ?>)" style="user-select: auto; margin: 15px">작품 삭제</button>
        </div>
    </div>

<?php require('./files/foot.php'); ?>