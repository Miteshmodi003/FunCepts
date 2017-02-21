<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 13.08.15
// Version 3.0.5

session_start();
include_once 'core/Settings.php';
include_once 'core/Members.php';
include_once 'core/Photos.php';

access_member();

if(!empty($_FILES['avatar'])){

	$userp = member_info($_SESSION['sk_id']);

	$files = file_photos($userp->id_user);
	$path = upload_path_photos($userp->id_user);

	$name = $_FILES['avatar']['name'];
	$size = $_FILES['avatar']['size'];
	$title = strtotime(date("Y-m-d H:i:s"));
	$formats = array("jpg","png","gif","jpeg","JPG","PNG","GIF","JPEG");

	if(strlen($name)){
		list($txt, $extension) = explode(".", $name);
		if(in_array($extension,$formats)){
			if($size<(1024*1024)){
				$actual_photo = "original_".$title.".".$extension;
				$original = $path.$actual_photo;
				$tmp = $_FILES['avatar']['tmp_name'];

				if($extension=="jpg" || $extension=="jpeg" || $extension=="JPG" || $extension=="JPEG"){
					$image = ImageCreateFromJpeg($tmp);
				}else if($extension=="png" || $extension=="PNG"){
					$image = ImageCreateFromPng($tmp);
				}else if($extension=="gif" || $extension=="GIF"){
					$image = ImageCreateFromGif($tmp);
				}

				list($width,$length)=getimagesize($tmp);
				$height=300;
				$resize=($length/$width)*$height;
				$cache=imagecreatetruecolor($height,$resize);
				imagecopyresampled($cache,$image,0,0,0,0,$height,$resize,$width,$length);

				$file = $path."300_".$title.".".$extension;

				imagejpeg($cache,$file,100);

				if(move_uploaded_file($tmp,$path.$actual_photo)){

					$last = last_id_photo();
					$last_id = $last->id_photo+1;
					add_photos($userp->id_user, $file, $original, $size, $length, $width);
					feed_add_photo($userp->id_user, $last_id);

					echo '<img src="'.$domaine.$file.'" alt=""/>';
					echo '<meta http-equiv="refresh" content="1; URL='.$domaine.'photos_style.php?id='.$last_id.'">';

				}else{
					echo 'Erreur impossible de télécharger la photo';
				}
			}else{
				echo 'Votre photo est trop grande'; 
			}
		}else{
			echo 'Extensions autorisés : jpg, png et gif'; 
		}
	}else{
		echo 'Erreur';	
	}
	exit;
}

include 'header.php';

$photo = new Languages('photos');

include SK_VIEW.FILE;

include 'footer.php';

?>