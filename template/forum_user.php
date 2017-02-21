<article id="page_full">
	<section id="content">
		<div id="submenu">
    		<a href="<?php echo $domaine; ?>forum" title=""><?php echo $fofo->sokial('R04'); ?></a>
    		<a href="<?php echo $domaine; ?>user/topics" title="" class="active"><?php echo $fofo->sokial('R05'); ?></a>
    		<a href="<?php echo $domaine; ?>add/topic" title="" class="up"><i class="fa fa-plus-square-o"></i> <?php echo $fofo->sokial('R06'); ?></a>
    	</div>
		<table>
	        <thead>
	            <tr>
	                <td><?php echo $fofo->sokial('R05'); ?></td>
	                <td><?php echo $fofo->sokial('R12'); ?></td>
	                <td><?php echo $fofo->sokial('R13'); ?></td>
	                <td><?php echo $fofo->sokial('R09'); ?></td>
	            </tr>
	        </thead>
	        <tbody>
	            <?php echo $forum; ?>
	        </tbody>
	    </table>
	</section>
</article>