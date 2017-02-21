<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 08.09.15
// Version 3.0.5

include 'header.php';
include CORE.'Games.php';

access_member();

$view = game_info($_GET['id']);

?>
<article id="page_full">
    <section id="content">
    	<div style="width:100%;height:200px;position:relative;background-image:url(<?php echo $view->cover; ?>);">
    		<img src="<?php echo $view->thumb; ?>" alt="" style="width:150px;height:150px;position:absolute;left:30px;top:100px;border:4px solid #fff"/>
    	</div>
    	<div style="width:100%;height:60px;background:#fff">
    		<h1 style="float:left;font-size:22px;margin-left:200px;padding-top:20px"><?php echo $view->title; ?></h1>
    		<a href="<?php echo $domaine.'play/'.$view->id_game; ?>" title="" class="right btn btn_blue" style="margin-top:15px;margin-right:10px">Play Now</a>
    	</div>
    	<div style="width:100%;background:#fff;color:#999">
    		<p style="padding:10px;width:50%"><?php echo $view->description; ?></p>
    	</div>
	</section>
</article>
<?php

include 'footer.php';

?>