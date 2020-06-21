<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php
$p_id = $_GET[p_id];
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");
$query = "delete from page where p_id='$p_id'";
$result = $connect->query($query);
mysqli_close($connect);

if($result) {
    ?>      <script>
    //alert('ok');
    history.back()
</script>

<?php   }
else{
?>              <script>

    alert("fail");
    history.back()
</script>
<?php   }
mysqli_close($connect);
?>
</html>
