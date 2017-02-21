<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 22.10.15
// Version 3.0.5

include_once 'core/Settings.php';
include_once 'core/Members.php';
include_once 'core/Feeds.php';

access_member();

if(!empty($_FILES['cover'])){

	session_start();

	$files = file_cover($_SESSION['sk_id']);
	$path = upload_path_cover($_SESSION['sk_id']);
	$name = $_FILES['cover']['name'];
	$size = $_FILES['cover']['size'];
	$title = strtotime(date("Y-m-d H:i:s"));
	$formats = array("jpg","png","gif","jpeg","JPG","PNG","GIF","JPEG");

	if(strlen($name)){
		list($txt, $extension) = explode(".", $name);
		if(in_array($extension,$formats)){
			if($size<(1024*1024)){
				$actual_photo = "original_".$title.".".$extension;
				$tmp = $_FILES['cover']['tmp_name'];

				if($extension=="jpg" || $extension=="jpeg" || $extension=="JPG" || $extension=="JPEG"){
					$image = ImageCreateFromJpeg($tmp);
				}else if($extension=="png" || $extension=="PNG"){
					$image = ImageCreateFromPng($tmp);
				}else if($extension=="gif" || $extension=="GIF"){
					$image = ImageCreateFromGif($tmp);
				}

				list($width,$length)=getimagesize($tmp);
				$height=550;
				$resize=($length/$width)*$height;
				$cache=imagecreatetruecolor($height,$resize);
				imagecopyresampled($cache,$image,0,0,0,0,$height,$resize,$width,$length);

				$file = $path."550_".$title.".".$extension;

				imagejpeg($cache,$file,100);

				if(move_uploaded_file($tmp,$path.$actual_photo)){

					add_cover($_SESSION['sk_id'], $file, $actual_photo);
					$cove = member_cover($_SESSION['sk_id']);
					feed_cover($_SESSION['sk_id'], $cove->id_cover);

					echo '<img src="../'.$path.$actual_photo.'" alt=""/>';

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

$members = new Languages('members');

$cover = member_cover($user->id_user);
$nb_cover = member_cover_number($user->id_user);

switch($nb_cover->n_cover) {
	case 0:
		$cover = $domaine.'files/cover/default.png';
		break;
	default:
		$cover = $domaine.$cover->file;
		break;
}

include SK_VIEW.FILE;

include 'footer.php';

?>