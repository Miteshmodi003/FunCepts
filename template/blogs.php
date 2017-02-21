<article id="page_full">
    <section id="content">
    	<div id="submenu">
    		<a href="<?php echo $domaine; ?>blogs" title="" class="active"><?php echo $blog->sokial('B11'); ?></a>
    		<a href="<?php echo $domaine; ?>user/blog" title=""><?php echo $blog->sokial('B02'); ?></a>
    		<a href="<?php echo $domaine; ?>upload/blog" title="" class="sk-bubble up" sokial="<?php echo $blog->sokial('B12'); ?>"><i class="fa fa-plus-square-o"></i> <?php echo $blog->sokial('B01'); ?></a>
    	</div>
		<?php echo $blogs; ?>
		<div class="clear"></div>
		<?php echo $paginations; ?>
	</section>
</article>