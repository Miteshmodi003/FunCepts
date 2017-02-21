<?php

// Copyright FunCepts
// Created by Mitesh Modi
// Last Modification => 23.10.15
// Version 3.0.5

session_start();

include_once 'core/Settings.php';

$members = new Languages('members');

$message_id = $_GET['id'];

$replies = list_messages($message_id);

$rep = reply_info($message_id);

switch($rep->sender) {
	case $_SESSION['sk_id']:
		$pid = $rep->receiver;
		break;
	default:
		$pid = $rep->sender;
		break;
}

?>
<script type="text/javascript">
$(document).ready(function(){
    $("div#reply").scrollTop(10000);
});

//Add comment
$(document).ready(function(){
	$(".com_rep").click(function(){
		var element = $(this);
		var Id = element.attr("id");
		var test = $("#textrep"+Id).val();
		var rep = $("#id_message").val();
		var dataString = 'textcontent='+ test + '&com_id=' + Id + '&rep_id=' + rep;
		if(test==''){
			alert("Please Enter Some Text");
		}else{
			$("#lade"+Id).show();
			$("#lade"+Id).fadeIn(400).html('');
			$.ajax({
				type:"POST",
				url:"messages_reply_add.php",
				data:dataString,
				cache:false,
				success:function(html){
					$("#loadrep"+Id).append(html);
					document.getElementById('textrep'+Id).value='';
					document.getElementById('textrep'+Id).focus();
					$("#lade"+Id).hide();
				}
			});
		}
		return false;
	});
});
</script>
<div id="reply">
	<?php echo $replies; ?>
	<div id="loadrep<?php echo $pid; ?>"></div>
	<div id="lade<?php echo $pid; ?>"></div>
	<div id="comment<?php echo $pid; ?>" class="comment_reply">
        <form action="" method="post" name="<?php echo $pid; ?>">
            <textarea placeholder="<?php echo $members->sokial('M18'); ?>" id="textrep<?php echo $pid; ?>"></textarea>
            <input type="hidden" id="id_message" value="<?php echo $message_id; ?>"/>
            <button id="<?php echo $pid; ?>" class="com_rep"><i class="fa fa-angle-right"></i></button>
        </form>
        <div class="clear"></div>
    </div>
</div>