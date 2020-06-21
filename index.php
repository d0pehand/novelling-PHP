<?php require ('./files/head.php'); ?>

<br>

<div class="container">

    <hr>
    <header class="jumbotron my-4">
        <h1 class="display-3">광고 or 공지</h1>
        <p class="lead">내용</p>
    </header>

    <h2>장르별 랭킹</h2>
    <div class="row text-center">
        <?php
        $genres = array("전체","판타지","무협","현대","로맨스");
        foreach ($genres as $genre)
        {
            echo '<a class="col-lg-2 col-md-6 mb-4" style="text-decoration:none">';
            echo '<img src="./imgs/icons/'.$genre.'.png" width="auto" height="64">';
            echo '<br><strong>'.$genre.'</strong>';
            echo '</a>';
        }
        ?>
    </div>

    <h2>전체</h2>
    <div class="row text-center">
        <?php
        $connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die ("connect fail");

        if(!isset($_GET['genre'])) {
            $query = "SELECT * FROM novel order by n_id desc";
        }else{
            $genre=$_GET['genre'];
                    $query = "SELECT * FROM novel where n_genre = '$genre' order by n_id desc";
        }

        if(isset($_GET['search'])) {
            $search=$_GET['search'];
            $query = "SELECT * FROM novel where n_title like '%$search%' order by n_id desc";
        }
        $result = $connect->query($query);



        $num = mysqli_num_rows($result);
        $list = 8;
        $pageNum = ceil($num/$list); // 총 페이지
        $nowPage = 1;
        if(isset($_GET['page'])) {$nowPage = $_GET['page'];}
        $cnt = 0;
        while($data = mysqli_fetch_array($result)) {
            if(($list  * $nowPage - $list <= $cnt) && ($cnt < $list * $nowPage)) { //페이징 처리
                echo '<a href="novel.php?n_id=' . $data['n_id'] . '" class="col-lg-3 col-md-6 mb-4" style="text-decoration:none">';
                echo '<div class="card h-100">';
                echo '<img class="card-img-top" src="/imgs/covers/' . $data['n_image'] . '" width="auto" height="325">';
                //echo '<span class="badge badge-pill badge-dark" style="position: absolute; right: 5px; bottom: 100px;">new</span>';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">' . $data['n_title'] . '</h4>';
                echo '<p class="card-text">' . $data['n_detail'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }
            $cnt++;
        }
        ?>
    </div>
</div>
<!-- /.container -->
<div class="container">
    <div class="d-flex justify-content-center">
        <ul class="m-0 text-center pagination">
            <li class="page-item">
                <?php
                if (isset($_GET['genre'])){
                    echo '<a class="page-link" href="index.php?page=1&genre='.$_GET['genre'].'">&laquo;</a>';
                }else{
                    echo '<a class="page-link" href="index.php?page=1">&laquo;</a>';
                }
                ?>
            </li>
            <?php
            for ($i = 1; $i <= $pageNum; $i++){ //페이지 네이터
                if ($nowPage == $i){
                    echo '<li class="page-item active">';
                }else{
                    echo '<li class="page-item">';
                }
                if (isset($_GET['genre'])) {
                    echo '<a class="page-link" href="index.php?page='.$i.'&genre='.$_GET['genre'].'">'.$i.'</a>';
                }else{
                    echo '<a class="page-link" href="index.php?page='.$i.'">'.$i.'</a>';
                }
                echo '</li>';
            }
            ?>
            <li class="page-item">
                <?php
                if (isset($_GET['genre'])){
                    echo '<a class="page-link" href="index.php?page='.$pageNum.'&genre='.$_GET['genre'].'">&raquo;</a>';
                }else{
                    echo '<a class="page-link" href="index.php?page='.$pageNum.'">&raquo;</a>';
                }
                ?>
            </li>
        </ul>
    </div>
</div>

<!-- Footer -->
<?php require('./files/foot.php'); ?>