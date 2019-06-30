<?php
include 'connection.php';
// get review id for forder name //
$query = "SELECT id FROM Review WHERE id >= ALL(SELECT id FROM Review)";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$path = "images/".$id; // relative path //
if (!file_exists($path)) {
    mkdir($path, 0777, true);
} // create folder //

// upload and move file to destination folder //
for($i=0;$i<count($_FILES["upload_file"]["name"]);$i++)
{
 $uploadfile=$_FILES["upload_file"]["tmp_name"][$i];
 move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], "$path"."/".$_FILES["upload_file"]["name"][$i]);
}
exit();

// handle the remaining queries here //

//

mysqli_close($conn);
?>