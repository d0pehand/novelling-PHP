<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");

$id = $_POST[id];
$title = $_POST[title];
$detail = $_POST[detail];

if(isset($_SESSION['userid'])) {
    $query = "insert into page (n_id, p_title , p_views , p_content , p_time) values ('$id','$title',0,'$detail',now())";
    $result = $connect->query($query);
}

if($result) {
    ?>      <script>
    //alert('ok');
    history.go(-2)
</script>

<?php   }
else{
?>              <script>

    alert("fail");
    history.go(-2)
</script>
<?php   }
mysqli_close($connect);
?>
</html>
