<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php
$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die("fail");

$user = $_SESSION['userid'];

$title = $_POST[title];
$genre = $_POST[genre];
$detail = $_POST[detail];
$image = $_POST[image];
$imgurl = $_FILES["image"]["name"];


$target_dir = "../imgs/covers/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "<script>alert(\"The file ". basename( $_FILES["image"]["name"]). " has been uploaded.\");</script>";
    } else {
        //echo "<script>alert(\"Sorry, there was an error uploading your file.\");</script>";
    }
}
?>



<?php
if(isset($_SESSION['userid'])) {
    $query = "insert into novel (u_id, n_title , n_genre , n_detail , n_image) values ('$user','$title','$genre','$detail','$imgurl')";
    $result = $connect->query($query);
}

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
