<article id="page_full">
	<section id="upload">
		<div id="menu_user">
			<a href="<?php echo $domaine; ?>user/account" title="" class="select"><?php echo $general->sokial('G01'); ?></a>
			<a href="<?php echo $domaine; ?>user/privacy" title=""><?php echo $general->sokial('G02'); ?></a>
			<a href="<?php echo $domaine; ?>user/security" title=""><?php echo $general->sokial('G03'); ?></a>
		</div>
		<div id="content" class="form">
			<?php if(isset($success)) echo '<div class="mess mess_success"><span>&#8730;</span><p>'.$success.'</p></div>' ?>
			<?php echo $account; ?>
			<div class="clear"></div>
		</div>
	</section>
</article>