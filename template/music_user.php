<article id="page_full">
    <section id="content">
    	<div id="submenu">
    		<a href="<?php echo $domaine; ?>musics" title=""><?php echo $music->sokial('U09'); ?></a>
    		<a href="<?php echo $domaine; ?>user/music" title="" class="active"><?php echo $music->sokial('U02'); ?></a>
            <a href="<?php echo $domaine; ?>musik/listened" title=""><?php echo $music->sokial('U10'); ?></a>
            <a href="<?php echo $domaine; ?>musik/popular" title=""><?php echo $music->sokial('U11'); ?></a>
    		<a href="<?php echo $domaine; ?>upload/music" title="" class="sk-bubble up" sokial="<?php echo $music->sokial('U12'); ?>"><i class="fa fa-arrow-circle-o-up"></i> <?php echo $music->sokial('U01'); ?></a>
    	</div>
		<?php echo $musics; ?>
		<div class="clear"></div>
		<?php echo $paginations; ?>
	</section>
</article>