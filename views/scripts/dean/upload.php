<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
$title = UPLOAD;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body>
    <form action="/GradProject/views/scripts/dean/upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html> 

<?php
$uploadPath = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/';

$allowedExts = array("xls", "xlsx");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
echo '<br>'.$_FILES["file"]["type"].'<br>';

if ((($_FILES["file"]["type"] == "application/vnd.ms-excel")
//|| ($_FILES["file"]["type"] == "")
|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
&& ($_FILES["file"]["size"] < 5000000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    if (file_exists("upload/" . $_FILES["file"]["name"])) {
      echo $_FILES["file"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $uploadPath . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    }
  }
} else {
  echo "Invalid file";
}

include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';