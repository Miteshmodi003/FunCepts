<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 06.09.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

if($_POST['id']){
	$db = SokialDB::getInstance();
	$db->exec("DELETE FROM photos WHERE id_photo = '".$_POST['id']."' ");
	echo '<script type="text/javascript">window.setTimeout("location=(\''.$domaine.'user/photo\');",1.0) </script>';
}

?>