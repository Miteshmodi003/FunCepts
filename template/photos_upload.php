<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SK_JS; ?>jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#avatar').live('change', function(){
		$("#preview").html('<img src="../template/sokial/img/load.gif" alt=""/>');
		$("#upload_photo").ajaxForm({
			target: '#preview'
		}).submit();
	});
});
</script>

<article id="page_full">
    <section id="content">
    	<div id="submenu">
    		<a href="<?php echo $domaine; ?>photos" title=""><?php echo $photo->sokial('P13'); ?></a>
    		<a href="<?php echo $domaine; ?>user/photo" title=""><?php echo $photo->sokial('P02'); ?></a>
    		<a href="<?php echo $domaine; ?>photo/viewed" title=""><?php echo $photo->sokial('P14'); ?></a>
    		<a href="<?php echo $domaine; ?>photo/popular" title=""><?php echo $photo->sokial('P15'); ?></a>
    	</div>
    	<div class="bloc">
    		<form id="upload_photo" method="post" enctype="multipart/form-data" action="">
				<input type="file" name="avatar" id="avatar"/>
				<input type="button" value="<?php echo $photo->sokial('P03'); ?>" id="btn_up" onclick="document.getElementById('avatar').click();getFileName()"/>
				<div id="preview">
					<div id="photo_preview"></div>
				</div>
			</form>
    	</div>
	</section>
</article>