<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo SK_JS; ?>map.js"></script>
<article id="page_full">
    <section id="content">
    	<div id="submenu">
    		<a href="<?php echo $domaine; ?>events" title=""<?php echo $ep1; ?>><?php echo $event->sokial('E20'); ?></a>
    		<a href="<?php echo $domaine; ?>user/event" title=""<?php echo $ep2; ?>><?php echo $event->sokial('E08'); ?></a>
    		<a href="<?php echo $domaine; ?>add/event" title="" class="up"><i class="fa fa-plus-square-o"></i> <?php echo $event->sokial('E07'); ?></a>
    	</div>
		<?php echo $events; ?>
		<div class="clear"></div>
		<?php echo $paginations; ?>
	</section>
</article>