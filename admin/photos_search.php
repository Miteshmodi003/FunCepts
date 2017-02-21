<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 14.12.15
// Version 3.0.6

include_once 'core/Settings.php';

if (isset($_POST['partialState'])) {
	$photos = list_photos_search($_POST['partialState']);
	echo $photos;
}

?>