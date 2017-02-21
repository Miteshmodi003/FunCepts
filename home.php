<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 21.09.15
// Version 3.0.5

include 'header.php';
require(CORE.'Feeds.php');

access_member();

$home = new Languages('home');
$video = new Languages('videos');
$music = new Languages('music');

$ads = advertising();

$items_per_group = 9;
$db = SokialDB::getInstance();
$mf = $db->query("SELECT COUNT(id_feed) as f_records FROM feeds");
$mf->execute();
$setf=$mf->fetch(PDO::FETCH_OBJ);
$total_groups = ceil($setf->f_records/$items_per_group);

include SK_VIEW.FILE;

include 'footer.php';

?>