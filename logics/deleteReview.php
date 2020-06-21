<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php
$r_id = $_GET[r_id];
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");
$query = "delete from review where r_id='$r_id'";
$result = $connect->query($query);
mysqli_close($connect);

if($result) {
    ?>      <script>
    //alert('ok');
    history.go(-1)
</script>

<?php   }
else{
?>              <script>

    alert("fail");
    history.go(-1)
</script>
<?php   }
mysqli_close($connect);
?>
</html>
