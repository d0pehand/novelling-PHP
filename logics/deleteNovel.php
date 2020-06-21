<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php
$n_id = $_GET[n_id];
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");
$query = "delete from novel where n_id='$n_id'";
$result = $connect->query($query);
mysqli_close($connect);

if($result) {
    ?>      <script>
        //alert('ok');
        location.replace("../mypage.php");
    </script>

<?php   }
else{
?>              <script>

        alert("fail");
        location.replace("../mypage.php");
    </script>
<?php   }
mysqli_close($connect);
?>
</html>
