<script type="text/javascript">
//Add reply
$(document).ready(function(){
    $(".btn_reply_topic").click(function(){
        var element = $(this);
        var Id = element.attr("id");
        var cat_id = $("#cat_id"+Id).val();
        var test = $("#textreply"+Id).val();
        var dataString = 'textcontent='+ test + '&com_id=' + Id + '&cat_id=' + cat_id;
        if(test==''){
            alert("Please Enter Some Text");
        }else{
            $("#lade"+Id).show();
            $("#lade"+Id).fadeIn(400).html('<img src="../template/sokial/img/load.gif" alt=""/>');
            $.ajax({
                type:"POST",
                url:"../forum_add_reply.php",
                data:dataString,
                cache:false,
                success:function(html){
                    $("#loadcom"+Id).append(html);
                    document.getElementById('textreply'+Id).value='';
                    document.getElementById('textreply'+Id).focus();
                    $("#lade"+Id).hide();
                }
            });
        }
        return false;
    });
});
</script>
<article id="page_full">
	<section id="content">
		<div id="submenu">
    		<a href="<?php echo $domaine; ?>forum" title="" class="active"><?php echo $fofo->sokial('R04'); ?></a>
    		<a href="<?php echo $domaine; ?>user/topics" title=""><?php echo $fofo->sokial('R05'); ?></a>
    		<a href="<?php echo $domaine; ?>add/topic" title="" class="up"><i class="fa fa-plus-square-o"></i> <?php echo $fofo->sokial('R06'); ?></a>
    	</div>
    	<div id="topic">
			<h1><?php echo $topic->title; ?> <span>- <?php echo $time; ?></span></h1>
			<div id="topic_user">
				<a href="<?php echo $domaine; ?>profil/<?php echo $member->id_user; ?>" title=""><img src="<?php echo $photo_profil; ?>" alt=""/></a>
				<a href="<?php echo $domaine; ?>profil/<?php echo $member->id_user; ?>" title=""><span class="capital"><?php echo $member->firstname.' '.$member->lastname; ?></span></a>
				<p><?php echo $topics_user; ?><br/><?php echo $replies_user; ?></p>
			</div>
			<p><?php echo $description; ?></p>
			<div class="clear"></div>
		</div>
		<div id="replies">
	        <?php echo $replies; ?>
	    </div>
		<div id="reply_topic">
			<div id="loadcom<?php echo $topic->id_topic; ?>"></div>
			<div id="lade<?php echo $topic->id_topic; ?>"></div>
        	<div id="comment<?php echo $topic->id_topic; ?>">
                <form action="" method="post" name="<?php echo $topic->id_topic; ?>">
                	<input type="hidden" id="cat_id<?php echo $topic->id_topic; ?>" value="<?php echo $topic->cat_id; ?>"/>
	                <textarea placeholder="<?php echo $fofo->sokial('R14'); ?>" id="textreply<?php echo $topic->id_topic; ?>"></textarea>
	                <button id="<?php echo $topic->id_topic; ?>" class="right btn btn_green btn_reply_topic"><?php echo $form->sokial('F13'); ?></button>
	            </form>
                <div class="clear"></div>
            </div>
		</div>
	</section>
</article>