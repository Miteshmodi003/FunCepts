<article id="page_full">
	<?php if($last->id_video != ''){ ?>
	<div id="video_full">
		<div id="content_video">
			<div>
				<h1 class="titl"><?php echo $title; ?></h1>
				<span><?php echo $video->sokial('V07').' '.$member->firstname.' '.$video->sokial('V08').' '.$cat->name; ?></span>
				<p class="desc"><?php echo $description; ?></p>
			</div>
			<a href="<?php echo $domaine; ?>video/<?php echo $info->id_video; ?>" title="">
				<img src="<?php echo $info->thumb; ?>" title="" id="img"/>
				<img src="<?php echo SK_IMG; ?>back_video.png" title="" id="back"/>
				<img src="<?php echo SK_IMG; ?>play.png" title="" id="play"/>
			</a>
		</div>
	</div>
	<?php } ?>
    <section id="content">
		<div id="submenu">
    		<a href="<?php echo $domaine; ?>videos" title=""><?php echo $video->sokial('V17'); ?></a>
    		<a href="<?php echo $domaine; ?>user/video" title=""><?php echo $video->sokial('V02'); ?></a>
    		<a href="<?php echo $domaine; ?>video/viewed" title="" class="active"><?php echo $video->sokial('V18'); ?></a>
    		<a href="<?php echo $domaine; ?>video/popular" title=""><?php echo $video->sokial('V19'); ?></a>
    		<a href="<?php echo $domaine; ?>upload/video" title="" class="sk-bubble up" sokial="<?php echo $video->sokial('V20'); ?>"><i class="fa fa-arrow-circle-o-up"></i> <?php echo $video->sokial('V01'); ?></a>
    	</div>
		<div class="bloc_video">
			<div><?php echo $list_videos; ?></div>
		</div>
	</section>
</article>
