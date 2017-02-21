<script type="text/javascript">
// Delete feed
$(function() {
    $(".photo_delete").click(function() {
        var id = $(this).attr("id");
        var dataString = 'id='+ id;
        var parent = $(this);
        $(this).fadeIn(200).html('<img src="../../template/sokial/img/load.gif"/>');
        $.ajax({
            type: "POST",
            url: "../../photos_delete.php",
            data: dataString,
            cache: false,
            success:function(html){
                parent.html(html);
            }
        });
        return false;
    });
});
</script>

<article id="page">
    <section id="content">  
		<div class="right">
			<div class="right_photo">
	    		<div id="pic">
	    			<a href="<?php echo $domaine.'profil/'.$user->id_user; ?>" title=""><img src="<?php echo $photo_user; ?>" alt=""/></a>
	    		</div>
	    		<a href="<?php echo $domaine.'profil/'.$user->id_user; ?>" title="" class="capital"><?php echo $user->firstname.' '.$user->lastname; ?></a>
	    		<div class="clear"></div>
	    		<p><span><?php echo $photo->sokial('P06'); ?> :</span> <?php echo $view->views; ?></p>
	    		<p><span><?php echo $photo->sokial('P07'); ?> :</span> <?php echo $weight.' '.$photo->sokial('P10'); ?></p>
	    		<p><span><?php echo $photo->sokial('P08'); ?> :</span> <?php echo $view->width; ?>x<?php echo $view->length; ?></p>
	    		<p style="color:#999;margin-top:10px"><?php echo $photo->sokial('P11').' '.$time; ?></p>
	    		<a href="<?php echo $domaine.$view->original; ?>" title="" class="btn btn_blue down" target="_blank"><?php echo $photo->sokial('P09'); ?></a>
	    		<?php if ($view->user_id == $_SESSION['sk_id']) { ?>
	    		<a href="<?php echo $domaine.'photos_style.php?id='.$view->id_photo; ?>" title="" class="btn btn_green down"><?php echo $general->sokial('G23'); ?></a>
	    		<a href="" title="" id="<?php echo $view->id_photo; ?>" class="btn btn_red down photo_delete"><?php echo $general->sokial('G24'); ?></a>
	    		<?php } ?>
	    	</div>
	    	<div class="clear"></div>
	        <div class="bloc ads">
	            <h5><?php echo $general->sokial('G19'); ?></h5>
	            <?php echo $ads; ?>
	        </div>
        </div>
    	<div id="photo_view">
            <img src="<?php echo $domaine.$view->original; ?>" alt="" class="<?php echo $view->style; ?> photo_post"/>
   			<div id="infos_photo">
   				<ul>
            		<?php echo $like; ?>
            		<li><div class="show_comment" id="<?php echo $view->id_photo; ?>"><i class="fa fa-comments-o"></i><?php echo $feeds->sokial('X04'); ?></div></li>
                    <li><a href="#" title="" data-width="500" data-rel="SharePhoto" class="poplight" rel="popup_name"><i class="fa fa-share-square-o"></i><?php echo $feeds->sokial('X05'); ?></a></li>
            	</ul>
            	<div id="likes">
            		<span><?php echo $total_like; ?></span>
            		<div id="infos">
	                    <ul>
	                        <li><i class="fa fa-thumbs-o-up"></i><?php echo $view->likes; ?></li>
	                        <li><i class="fa fa-comments-o"></i><?php echo $view->comments; ?></li>
	                        <li><i class="fa fa-share-square-o"></i><?php echo $view->shares; ?></li>
	                    </ul>
	                </div>
	                <div class="clear"></div>
            	</div>
            	<?php echo $comments; ?>
            	<div id="loadcom<?php echo $view->id_photo; ?>"></div>
				<div id="lade<?php echo $view->id_photo; ?>"></div>
            	<div id="comment<?php echo $view->id_photo; ?>" class="comment">
	                <div class="round_pic user_pic">
	                    <img src="<?php echo $photo_profil; ?>" alt="" />
	                </div>
	                <form action="" method="post" name="<?php echo $view->id_photo; ?>">
		                <textarea placeholder="<?php echo $feeds->sokial('X06'); ?>" id="textcom<?php echo $view->id_photo; ?>"></textarea>
		                <button id="<?php echo $view->id_photo; ?>" class="com_btn"><i class="fa fa-angle-right"></i></button>
		            </form>
	                <div class="clear"></div>
	            </div>
            </div>
        </div>
		<div id="SharePhoto" class="popup_block">
		    <div class="popup_top">
		        <h4><?php echo $photo->sokial('P12'); ?></h4>
		    </div>
		    <form method="post" action="">
			    <div id="share">
			        <textarea name="comment" placeholder="<?php echo $feeds->sokial('X06'); ?>"></textarea>
			    </div>
			    <div class="popup_bottom">
			    	<button class="btn btn_blue right"><?php echo $feeds->sokial('X05'); ?></button>
			    	<div class="clear"></div>
			    </div>
			</form>
		</div>
	</section>
</article>