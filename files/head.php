<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="utf-8">

    <title>모두의 소설공간 - Novelling</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

</head>

<body>

<!-- 최상단 바 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">모두의 소설 공간 - novelLing</a>

        <div class="collapse navbar-collapse" id="navbarResponsive">

            <?php
            $userId =  $_SESSION['userid'];
            $connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die ("connect fail");
            $query = "SELECT * FROM user where u_id = '$userId'";
            $result = $connect->query($query);
            $row = mysqli_fetch_array($result);
            $userNickname = $row['u_nick'];
            mysqli_close($connect);

            if(isset($_SESSION['userid'])) {
                ?>
                <div style = "padding: 0px 10px 0px 0px;">
                <a href="./mypage.php"><button type="button" class="btn btn-primary btn-sm"><?php echo $userNickname.'님'; ?></button></a>
                </div>
                <a href="./logics/logout.php"><button type="button" class="btn btn-primary btn-sm">LogOut</button></a>
                <?php
            }
            else {
                ?>
                <a href="./login.php"><button type="button" class="btn btn-primary btn-sm">Login</button></a>
                <a href="./signUp.php"><button type="button" class="btn btn-primary btn-sm">SignUp</button></a>
            <?php   }
            ?>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/?genre=판타지">판타지
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/?genre=무협">무협
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/?genre=현대">현대
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/?genre=로맨스">로맨스
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>

        <form method='get' action="/" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search">
            <button class="btn btn-primary btn-sm" type="submit">검색</button>
        </form>

    </div>
</nav>