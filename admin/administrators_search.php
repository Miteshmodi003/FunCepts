<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 19.12.15
// Version 3.0.6

include_once 'core/Settings.php';

if (isset($_POST['partialState'])) {
	$admin = list_admin_search($_POST['partialState']);
	echo $admin;
}

?>