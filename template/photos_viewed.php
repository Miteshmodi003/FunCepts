<article id="page_full">
    <section id="photos">
    	<div id="submenu">
    		<a href="<?php echo $domaine; ?>photos" title=""><?php echo $photo->sokial('P13'); ?></a>
    		<a href="<?php echo $domaine; ?>user/photo" title=""><?php echo $photo->sokial('P02'); ?></a>
    		<a href="<?php echo $domaine; ?>photo/viewed" title="" class="active"><?php echo $photo->sokial('P14'); ?></a>
    		<a href="<?php echo $domaine; ?>photo/popular" title=""><?php echo $photo->sokial('P15'); ?></a>
    		<a href="<?php echo $domaine; ?>upload/photo" title="" class="sk-bubble up" sokial="<?php echo $photo->sokial('P16'); ?>"><i class="fa fa-arrow-circle-o-up"></i> <?php echo $photo->sokial('P01'); ?></a>
    	</div>
		<div id="columns">
			<?php echo $photos; ?>
		</div>
		<div class="clear"></div>
		<?php echo $paginations; ?>
	</section>
</article>