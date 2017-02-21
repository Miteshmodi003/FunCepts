<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 17.12.15
// Version 3.0.6

include 'header.php';

access_admin();

$id_group = $_GET['id'];
$user = new Languages('members');
$picture = new Languages('photos');
$group = new Languages('groups');
$view = group_info($id_group);
$cat = cat_group($view->cat_id);
$photo = photo_group($view->id_group);

switch($photo->file) {
	case '':
		$photo_profil = 'files/groups/profil/150x_nophoto.png';
		break;
	default:
		$photo_profil = $photo->file;
		break;
}

$time = duration($view->TimeGroup);

if($_POST['id_group']){
    $db = SokialDB::getInstance();
    $id_group = $_POST['id_group'];
    $db->exec("DELETE FROM groups WHERE id_group = $id_group");
    $success = $group->sokial('R10');
    echo '<meta http-equiv="refresh" content="1;URL=groups.php">';
}

include SK_VIEW.FILE;

include 'footer.php';

?>