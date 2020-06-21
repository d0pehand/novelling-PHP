<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">

<?php
$id = $_POST[id];
$title = $_POST[title];
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

$connect = mysqli_connect('localhost', 'root', '1234', 'novelling') or die ("connect fail");
    if ($imgurl == "")
        $query = "UPDATE novel SET n_title = '$title', n_detail = '$detail' where n_id = $id";
    else
        $query = "UPDATE novel SET n_title = '$title', n_detail = '$detail', n_image = '$imgurl' where n_id = $id";
$result = $connect->query($query);

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