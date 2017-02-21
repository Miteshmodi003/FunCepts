<article id="page_full">
    <section id="content">
    	<div id="submenu">
    		<a href="<?php echo $domaine; ?>groups" title="" class="active"><?php echo $group->sokial('O04'); ?></a>
    		<a href="<?php echo $domaine; ?>user/group" title=""><?php echo $group->sokial('O05'); ?></a>
    		<a href="<?php echo $domaine; ?>add/group" title="" class="sk-bubble up" sokial="<?php echo $group->sokial('O11'); ?>"><i class="fa fa-plus-square-o"></i> <?php echo $group->sokial('O06'); ?></a>
    	</div>
		<?php echo $groups; ?>
		<div class="clear"></div>
		<?php echo $paginations; ?>
	</section>
</article>