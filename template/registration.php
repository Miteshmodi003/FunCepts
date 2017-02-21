<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SK_JS; ?>jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#avatar').live('change', function(){
		$("#preview").html('<img src="template/sokial/img/loader.gif" alt=""/>');
		$("#registrer_photo").ajaxForm({
			target: '#preview'
		}).submit();
	});
});
</script>

<article id="page_full">
	<section id="register">
		<div id="border_pic"></div>
		<div class="round_reg user_reg">
			<div id="preview">
				<img src="files/users/150x_nophoto.gif" alt=""/>
			</div>
		</div>
		<header>
			<form id="registrer_photo" method="post" enctype="multipart/form-data" action="">
				<input type="file" name="avatar" id="avatar"/>
				<input type="button" value="<?php echo $form->sokial('F16'); ?>" id="btn_pic" onclick="document.getElementById('avatar').click();getFileName()"/>
			</form>
		</header>
		<div id="content" class="form">
			<?php if(!empty($erreurs_inscription)){foreach($erreurs_inscription as $e){echo '<div class="mess mess_error"><span>&times;</span><p>'.$e.'</p></div>'."\n";}} echo $signup; ?>
			<div class="clear"></div>
		</div>
	</section>
</article>