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

<br>

<div class="container">
    <hr>
    <form method = "post" action = "../logics/addNovel.php" enctype="multipart/form-data">

        <div align="center">
            <div class="card border-primary" style="max-width: 60rem;">
                <div class="card-header" style="user-select: auto;"><h4>작품 추가</h4></div>
                <div class="card-body" style="user-select:auto; align:left;">
                    <div align="left">

                        <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>장르</h5></label><br>
                        <input type="radio" name="genre" value="판타지" checked="checked">판타지 <br>
                        <input type="radio" name="genre" value="무협">무협 <br>
                        <input type="radio" name="genre" value="현대">현대 <br>
                        <input type="radio" name="genre" value="로맨스">로맨스 <br>

                        <hr>
                        <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>제목</h5></label>
                        <input class="form-control form-control-sm" type="text" placeholder="제목을 입력해 주세요." name="title" style="user-select: auto;">

                        <hr>
                        <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>내용</h5></label>
                        <input class="form-control form-control-sm" type="text" placeholder="내용을 입력해 주세요." name="detail" style="user-select: auto;">

                        <hr>
                        <label class="col-form-label col-form-label" for="inputSmall" style="user-select: auto;"><h5>표지 이미지</h5></label>
                        <input type="file" class="form-control form-control-sm" name="image" id="image">
                    </div>
                    
                    <button type="submit" class="btn-sm btn-primary" style="user-select: auto; margin: 15px">완료</button>
                </div>
            </div>
        </div>

    </form>
</div>

<?php require('./files/foot.php'); ?>