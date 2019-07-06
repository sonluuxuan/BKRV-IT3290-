<?php
session_start();
$id = $_SESSION["userid"];
// get review id for forder name //
// $query = "SELECT MAX(id) as maxId FROM Review WHERE id >= ALL(SELECT id FROM Review)";
$path = "profile_pics/".$id; // relative path //
$result = array();
$result["message"] = $path;
echo json_encode($result);
$files = glob($path."/*"); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
if (!file_exists($path)) {
    mkdir($path, 0777, true);
} // create folder //

// upload and move file to destination folder //
for($i=0;$i<count($_FILES["upload_profile_pic"]["name"]);$i++)
{
 $uploadfile=$_FILES["upload_profile_pic"]["tmp_name"][$i];
 move_uploaded_file($_FILES["upload_profile_pic"]["tmp_name"][$i], "$path"."/".$_FILES["upload_profile_pic"]["name"][$i]);
}
exit();

// handle the remaining queries here //

//

?>