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

	$files = file_photo($_SESSION['sk_id']);
	$path = upload_path($_SESSION['sk_id']);
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

					add_photo($_SESSION['sk_id'], $file);

					$pic = member_photo($_SESSION['sk_id']);
					feed_profil_photo($_SESSION['sk_id'], $pic->id_photo_profil);

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
$avatar = member_photo($user->id_user);

switch($avatar->file) {
	case '':
		$photo_profil = $domaine.'files/users/150x_nophoto.gif';
		break;
	default:
		$photo_profil = $domaine.$avatar->file;
		break;
}

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SK_JS; ?>jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#cover').live('change', function(){
		$("#preview_pic").html('<img src="../template/sokial/img/load.gif" alt="" style="padding:100px 300px;width:15px;height:15px"/>');
		$("#photo_user").ajaxForm({
			target: '#preview_pic'
		}).submit();
	});
});
</script>
<style type="text/css">
#preview_pic img{width:250;height:250px;margin:0;padding:0}
</style>
<article id="page_full">
	<section id="upload">
			<div id="preview_pic">
				<img src="<?php echo $photo_profil; ?>" alt=""/>
			</div>
			<form id="photo_user" method="post" enctype="multipart/form-data" action="">
				<input type="file" name="cover" id="cover"/>
				<div id="add_photo">
					<i class="fa fa-upload"></i>
					<input type="button" value="<?php echo $members->sokial('M17'); ?>" onclick="document.getElementById('cover').click();getFileName()"/>
				</div>
				<div class="clear"></div>
			</form>
	</section>
</article>
<?php

include 'footer.php';

?>