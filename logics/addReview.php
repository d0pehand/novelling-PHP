<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php

$u_nick = $_POST['u_nick'];
$n_id = $_POST['n_id'];
$r_content = $_POST['r_content'];

$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");

$query = "SELECT * FROM user where u_nick = '$u_nick'";
$result = $connect->query($query);
$row = mysqli_fetch_array($result);
$u_id = $row['u_id'];

if(isset($_SESSION['userid'])) {
    $query = "insert into review (u_nick , n_id , r_content , r_time) values ('$u_nick','$n_id','$r_content',now())";
    $result = $connect->query($query);
}
if($result) {
    ?>      <script>
    //alert('ok');
    location.replace("../novel.php?n_id=<?php echo $n_id; ?>");
</script>

<?php   }
else{
?>              <script>

    alert("fail");
    alert("<?php echo $n_id; ?>");
    location.replace("../novel.php?n_id=<?php echo $n_id; ?>");
</script>
<?php   }
mysqli_close($connect);
?>
</html>