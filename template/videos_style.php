<article id="page_full">
	<div id="video_full">
		<div id="content_video">
			<div>
				<h1 class="titl"><?php echo $titl; ?></h1>
				<span><?php echo $video->sokial('V07').' '.$member->firstname.' '.$video->sokial('V08').' '.$cat->name; ?></span>
				<p class="desc"><?php echo $desc; ?></p>
			</div>
			<img src="<?php echo $info->thumb; ?>" title="" id="img"/>
			<img src="<?php echo SK_IMG; ?>back_video.png" title="" id="back"/>
			<img src="<?php echo SK_IMG; ?>play.png" title="" id="play"/>
		</div>
	</div>
	<section id="upload">
		<div id="content" class="form">
			<div id="style">
				<?php echo $style; ?>
				<div class="clear"></div>
			</div>
		</div>
	</section>
</article>