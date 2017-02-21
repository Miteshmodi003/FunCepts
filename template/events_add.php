<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
$(function() {
	$("#id_date").datepicker({minDate:0});
	$("#id_end").datepicker({minDate:0});
});
</script>
<article id="page_full">
	<section id="upload">
		<div id="content" class="form">
			<?php echo $add; ?>
			<div class="clear"></div>
		</div>
	</section>
</article>