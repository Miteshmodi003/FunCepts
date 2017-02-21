<article id="page_full">
	<div id="submenu" style="width:750px;margin:0 auto;margin-bottom:10px">
        <a href="<?php echo $domaine; ?>groups" title=""><?php echo $group->sokial('O04'); ?></a>
        <a href="<?php echo $domaine; ?>user/group" title=""><?php echo $group->sokial('O05'); ?></a>
        <a href="<?php echo $domaine; ?>add/group" title="" class="sk-bubble up" sokial="<?php echo $group->sokial('O11'); ?>"><i class="fa fa-plus-square-o"></i> <?php echo $group->sokial('O06'); ?></a>
    </div>
	<section id="upload">
		<div id="content" class="form">
			<?php echo $add; ?>
			<div class="clear"></div>
		</div>
	</section>
</article>