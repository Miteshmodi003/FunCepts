<article id="page">
    <section id="content">
    	<div id="submenu">
            <a href="<?php echo $domaine.'members'; ?>" title=""><?php echo $members->sokial('M27'); ?></a>
            <a href="<?php echo $domaine.'member/online'; ?>" title=""><?php echo $members->sokial('M28'); ?></a>
            <a href="<?php echo $domaine.'member/last'; ?>" title="" class="active"><?php echo $members->sokial('M29'); ?></a>
            <a href="<?php echo $domaine.'member/popular'; ?>" title=""><?php echo $members->sokial('M30'); ?></a>
            <a href="<?php echo $domaine.'friends'; ?>" title=""><?php echo $members->sokial('M31'); ?></a>
        </div>
        <div id="members">
			<?php echo $users; ?>
		</div>
		<?php echo $paginations; ?>
	</section>
</article>