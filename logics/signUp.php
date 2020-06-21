<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">
<?php

$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");

$id=$_GET[id];
$pw=$_GET[pw];
$nickname=$_GET[nickname];

$queryid = "select * from user where u_id='$id'";
$resultid = $connect->query($queryid);

$querynick = "select * from user where u_nick='$nickname'";
$resultnick = $connect->query($querynick);

if($resultid==0 && $resultnick==0) {
    //입력받은 데이터를 DB에 저장
    $query = "insert into user (u_id, u_pw, u_nick) values ('$id','$pw','$nickname')";
    $result = $connect->query($query);


//저장이 됬다면 (result = true) 가입 완료
if($result) {
    ?>
    <script>
        alert('회원가입이 정상적으로 되었습니다.');
        location.replace("../login.php");
    </script>

<?php   }
else{
    ?>
    <script>
        alert("fail");
        location.replace("../login.php");
    </script>
<?php   }
}
else{
    ?>
    <script>
    alert('중복된 아이디나 닉네임이 존재합니다.');
    location.replace("../signUp.php");
    </script>
<?php
}
mysqli_close($connect);
?>
</html>
