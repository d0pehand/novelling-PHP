<?php session_start(); ?>

    <!DOCTYPE html>
    <html lang="ko">
    <meta charset="utf-8">

<?php
$userId = $_GET['u_id'];
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");
$query = "delete from user where u_id='$userId'";
$result = $connect->query($query);
mysqli_close($connect);
$s_result = session_destroy();

if($result) {
    ?>      <script>
    //alert('ok');
    location.replace("../");
</script>

<?php   }
else{
?>              <script>

    alert("fail");
    location.replace("../");
</script>
<?php   }
mysqli_close($connect);
?>
</html>
