<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 12.10.15
// Version 3.0.5

include_once 'core/Settings.php';
include_once 'core/Members.php';

if(!empty($_FILES['avatar'])){

	$last = last_id();
	$last_id = $last->id_user+1;
	$files = file_photo($last_id);
	$path = upload_path($last_id);
	$name = $_FILES['avatar']['name'];
	$size = $_FILES['avatar']['size'];
	$title = strtotime(date("Y-m-d H:i:s"));
	$formats = array("jpg","png","gif","jpeg","JPG","PNG","GIF","JPEG");

	if(strlen($name)){
		list($txt, $extension) = explode(".", $name);
		if(in_array($extension,$formats)){
			if($size<(1024*1024)){
				$actual_photo = "original_".$title.".".$extension;
				$tmp = $_FILES['avatar']['tmp_name'];

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

					add_photo($last_id, $file);

					echo '<img src="'.$file.'" alt=""/>';

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

include_once 'header.php';

require(CORE.'Feeds.php');

$form = new Languages('form');

$y = SokialDB::getInstance();

$signup = new Form('signup', 'POST');

$signup->action('');
$signup->add('Text', 'firtsname')
		->label(''.$form->sokial('F08').'')
		->required();
$signup->add('Text', 'lastname')
		->label(''.$form->sokial('F07').'')
		->required();
$signup->add('Email', 'email')
		->label(''.$form->sokial('F01').'')
		->required();
$signup->add('Password', 'password')
		->label(''.$form->sokial('F02').'')
		->required();
$signup->add('Select', 'sex')
		->choices(array(
           '1' => $form->sokial('F10'),
           '2' => $form->sokial('F11')
         ))
		->value('1')
		->label(''.$form->sokial('F09').'');
$country = array();
foreach($y->query("SELECT code,name_country FROM country ORDER BY name_country ASC") as $cnt) {
	$country[$cnt['code']] = $cnt['name_country'];
}
$signup->add('Select', 'country')
		->choices($country)
		->value('BZH')
		->label(''.$form->sokial('F12').'');
$signup->add('Submit', 'submit')
		->value(''.$form->sokial('F13').'')
		->add_class('btn btn_green');
$signup->bound($_POST);

// 
// ENVOI FORMULAIRE
// 

$erreurs_inscription = array();

if($signup->is_valid($_POST)) {

	if(empty($erreurs_inscription)) {

		list($firtsname, $lastname, $sex, $password, $email, $country) =
			$signup->get_cleaned_data('firtsname', 'lastname', 'sex', 'password', 'email', 'country');

		$id_user = add_member($firtsname, $lastname, $sex, $password, $email, $country);

		if(ctype_digit($id_user)) {

			$id_user = (int) $id_user;

			$message_mail = '<html><head></head><body>
			<p>Merci de vous être inscrit sur '.SK_NAMESITE.' !</p>
			<p>Veuillez cliquer sur <a href="">ce lien</a> pour activer votre compte !</p>
			</body></html>';
			
			$headers_mail  = 'MIME-Version: 1.0'."\r\n";
			$headers_mail .= 'Content-type: text/html; charset=utf-8'."\r\n";
			$headers_mail .= 'From: '.SK_NAMESITE.' <'.SK_MAILSITE.'>'."\r\n";

			mail($signup->get_cleaned_data('email'), 'Inscription sur '.SK_NAMESITE, $message_mail, $headers_mail);
			feed_registration($id_user);
			add_sessions($id_user);

			$_SESSION['sk_id'] = $id_user;
			echo '<script>location.replace("home.php");</script>';

		} else {

			$error =& $id_user;

			if(23000 == $error[0]) {

				preg_match("`Duplicate entry '(.+)' for key \d+`is", $error[2], $valeur_probleme);
				$valeur_probleme = $valeur_probleme[1];
				
				if($firtsname == $valeur_probleme) {
				
					$erreurs_inscription[] = "Ce nom de famille est déjà utilisé.";
				
				}else if($email == $valeur_probleme) {
				
					$erreurs_inscription[] = "Cette adresse électronique est déjà utilisée.";
				
				}else {
				
					$erreurs_inscription[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
				}
			
			}else {
			
				$erreurs_inscription[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $error[0]);
			}

		}
	}

}

include SK_VIEW.FILE;

include 'footer.php';

?>