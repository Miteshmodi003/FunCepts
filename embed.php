<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 28.08.15
// Version 3.0.5

include_once 'core/Settings.php';

$video = new Languages('videos');
$feeds = new Languages('feeds');

$view = video_info($_GET['id']);
up_view_video($_GET['id']);

?>
<style type="text/css">
body{margin:0 auto;padding:0}
</style>
<?php echo $view->embed; ?>