<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php
session_start();
$result = session_destroy();

if($result) {
    ?>
    <script>
        alert("로그아웃 되었습니다.");
        history.back();
    </script>
<?php   }
?>

</html>
