<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 16.12.15
// Version 3.0.6

include_once 'core/Settings.php';

if (isset($_POST['partialState'])) {
	$blogs = list_blogs_search($_POST['partialState']);
	echo $blogs;
}

?>