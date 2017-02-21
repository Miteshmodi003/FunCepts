<article id="page_full">
	<section id="upload">
		<div id="menu_user">
			<a href="<?php echo $domaine; ?>user/account" title=""><?php echo $general->sokial('G01'); ?></a>
			<a href="<?php echo $domaine; ?>user/privacy" title=""><?php echo $general->sokial('G02'); ?></a>
			<a href="<?php echo $domaine; ?>user/security" title="" class="select"><?php echo $general->sokial('G03'); ?></a>
		</div>
		<div id="content" class="form">
			<p><?php echo $general->sokial('G10'); ?> : <span class="right"><?php echo $user->date_registration; ?></span></p>
			<p><?php echo $general->sokial('G11'); ?> : <span class="right"><?php echo $user->ip_registration; ?></span></p>
			<p><?php echo $general->sokial('G12'); ?> : <span class="right"><?php echo $user->browser.' '.$general->sokial('G18').' '.$user->os_name; ?></span></p>
			<p><?php echo $general->sokial('G13'); ?> : <span class="right">BZH-<?php echo $user->id_user; ?></span></p>
			<div id="session">
				<h3 class="bold"><?php echo $general->sokial('G14'); ?></h3>
				<?php echo $sessions; ?>
			</div>
		</div>
	</section>
</article>