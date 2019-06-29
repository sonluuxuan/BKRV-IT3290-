<?php
function get_thumbnail($dir)
{
	//$path = "./images/";
	//$dir = "images/15";
	//$dir = $_GET['dir'];
	$allImages= scandir($dir);
	$thumbnail = $allImages[2];
	return $dir.'/'.$thumbnail;
}

function get_profile_pic($dir){
	$allImages= scandir($dir);
	$profile_pic = $allImages[2];
	return $dir.'/'.$profile_pic;
}
?>