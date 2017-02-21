<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 05.09.15
// Version 3.0.5

include_once 'core/Settings.php';
include_once 'core/Groups.php';
include_once 'core/Feeds.php';

access_member();

$id_group = $_GET['id'];

if(!empty($_FILES['cover'])){

	session_start();

	$files = group_file_profil($id_group);
	$path = group_upload_profil($id_group);
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
				$height=150;
				$resize=($length/$width)*$height;
				$cache=imagecreatetruecolor($height,$resize);
				imagecopyresampled($cache,$image,0,0,0,0,$height,$resize,$width,$length);

				$file = $path."150_".$title.".".$extension;

				imagejpeg($cache,$file,100);

				if(move_uploaded_file($tmp,$path.$actual_photo)){

					add_group_profil_photo($id_group, $file);

					$pic = group_photo($id_group);
					feed_add_photo_group($_SESSION['sk_id'], $pic->id_photo_profil);

					echo '<img src="../'.$path.$actual_photo.'" alt=""/>';
					echo '<meta http-equiv="refresh" content="1; URL='.$domaine.'group/'.$id_group.'">';

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

$group = new Languages('groups');
$members = new Languages('members');
$avatar = group_photo($id_group);

switch($avatar->file) {
	case '':
		$photo_profil = $domaine.'files/groups/profil/150x_nophoto.png';
		break;
	default:
		$photo_profil = $domaine.$avatar->file;
		break;
}

include SK_VIEW.FILE;

include 'footer.php';

?>