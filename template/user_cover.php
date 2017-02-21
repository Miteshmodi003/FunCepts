<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SK_JS; ?>jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#cover').live('change', function(){
		$("#preview_photo").html('<img src="../template/sokial/img/load.gif" alt="" style="padding:100px 300px;width:15px;height:15px"/>');
		$("#photo_user").ajaxForm({
			target: '#preview_photo'
		}).submit();
	});
});
</script>
<article id="page_full">
	<section id="upload">
			<div id="preview_photo">
				<img src="<?php echo $cover; ?>" alt=""/>
			</div>
			<form id="photo_user" method="post" enctype="multipart/form-data" action="">
				<input type="file" name="cover" id="cover"/>
				<div id="add_photo">
					<i class="fa fa-upload"></i>
					<input type="button" value="<?php echo $members->sokial('M17'); ?>" onclick="document.getElementById('cover').click();getFileName()"/>
				</div>
				<div class="clear"></div>
			</form>
	</section>
</article>