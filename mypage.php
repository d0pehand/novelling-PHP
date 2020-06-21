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

$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");

if(mysqli_connect_errno()){
    echo "연결실패! ".mysqli_connect_error();
}
?>

<br>

<div class="container">

    <hr>

    <div style="align-items:center">
        <div class="card border-primary mb-4" style="max-width: 80rem;">
            <div class="card-header"><h2>내 작품 관리</h2></div>
            <div class="card-body">
                <ul class="list-group">
                    <?php
                    $query = "SELECT * FROM novel where u_id = '$userId' order by n_id desc";
                    $result = $connect->query($query);
                        while($data = mysqli_fetch_array($result)) {
                            echo '<li class="list-group-item d-flex ">';
                            echo '<div class="col-md-8">';
                            echo '<h5>' . $data['n_title'] . '</h5>';
                            echo '<a href="novel.php?n_id='.$data['n_id'].'"><img src="./imgs/covers/'.$data['n_image'].'"'.' width=250></a>';
                            echo '</div>';
                            echo '<div class="col-md-4" style="text-align:right">';
                            echo '<a href="addPage.php?n_id='."{$data['n_id']}".'"><span class="badge badge-success" style="user-select: auto; margin-right:10px;">회차 추가</span></a>';
                            echo '<a href="updateNovel.php?n_id='."{$data['n_id']}".'"><span class="badge badge-info" style="user-select: auto; margin-right:10px;">작품 수정</span></a>';
                            echo '</div>';
                            echo '</li>';
                        }
                    ?>
                </ul>
                <div style="text-align:right"><button type="button" onclick="location.href='addNovel.php'" class="btn-sm btn-primary" style="user-select: auto; margin-right: 20px; margin-top: 10px">새 작품 쓰기</button></div>
            </div>
        </div>

        <div class="card border-primary mb-4" style="max-width: 80rem;">
            <div class="card-header"><h2>내 정보 관리</h2></div>
                <div class="card-body">

                    <h4 class="card-title">리뷰 관리</h4>

                    <hr>
                    
                    <?php
                    $query = "SELECT * FROM review where u_nick = '$userNickname' order by r_time desc";
                    $result = $connect->query($query);
                    while($data = mysqli_fetch_array($result)) {
                        $query2 = "SELECT * FROM novel where n_id = $data[n_id]";
                        $result2 = $connect->query($query2);
                        $row = mysqli_fetch_array($result2);
                        $novelTitle = $row['n_title'];

                        echo '<p><img src="/imgs/icons/book.png" width="16" height="16" style="margin-right: 10px">' . $novelTitle . '</p>';
                        echo '<p><img src="/imgs/icons/comment.png" width="16" height="16" style="margin-right: 10px">' . $data['r_content'] . '</p>';
                        echo '<p>' . $data['r_time'] . '</p>';
                        echo '<a href="./logics/deleteReview.php?r_id='."{$data['r_id']}".'"><span class="badge badge-success" style="user-select: auto; margin-right:10px;">리뷰 제거</span></a>';
                        echo '<hr>';
                    }
                    ?>

                    <h4 class="card-title">계정 정보</h4>
                    <p class="card-text">ID : <?php echo $userId; ?></p>
                    <p class="card-text">NickName : <?php echo $userNickname; ?></p>
                    <script>
                        function deleteUser() {
                            if(confirm('정말 계정을 삭제 하시겠습니까? 관련된 작품과 리뷰가 삭제됩니다.')){
                                location.replace("../logics/deleteUser.php?u_id=<?php echo $userId ?>");
                            }
                        }
                    </script>
                    <div style="text-align:right">
                        <button type="button" class="btn btn-danger" onclick="deleteUser()" style="user-select: auto; margin: 15px">회원 탈퇴</button>
                    </div>
                </div>
            </div>
    </div>

</div>

<?php mysqli_close($connect); ?>
<?php require('./files/foot.php'); ?>