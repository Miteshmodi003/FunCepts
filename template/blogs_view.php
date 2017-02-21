<article id="page">
    <section id="content">  
		<div class="right">
			<div class="right_photo">
	    		<div id="pic">
	    			<a href="<?php echo $domaine; ?>profil/<?php echo $user->id_user; ?>" title=""><img src="<?php echo $photo_user; ?>" alt=""/></a>
	    		</div>
	    		<a href="<?php echo $domaine; ?>profil/<?php echo $user->id_user; ?>" title="" class="capital"><?php echo $user->firstname.' '.$user->lastname; ?></a>
	    		<div class="clear"></div>
	    		<p><span><?php echo $blog->sokial('B08'); ?> :</span> <?php echo $view->views; ?></p>
	    		<p><span><?php echo $blog->sokial('B09'); ?> :</span> <?php echo $cat->name; ?></p>
	    		<p style="color:#999;margin-top:10px"><?php echo $photo->sokial('P11').' '.$time; ?></p>
	    	</div>
	    	<div class="clear"></div>
	        <div class="bloc ads">
	            <h5><?php echo $general->sokial('G19'); ?></h5>
	            <?php echo $ads; ?>
	        </div>
        </div>
    	<div id="blog_view">
    		<p class="bold"><?php echo $view->title; ?></p>
            <p><?php echo $description; ?></p>
   			<div id="infos_photo">
   				<ul>
            		<?php echo $like; ?>
            		<li><div class="show_comment" id="<?php echo $view->id_blog; ?>"><i class="fa fa-comments-o"></i><?php echo $feeds->sokial('X04'); ?></div></li>
                    <li><a href="#" title="" data-width="500" data-rel="ShareBlog" class="poplight" rel="popup_name"><i class="fa fa-share-square-o"></i><?php echo $feeds->sokial('X05'); ?></a></li>
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
            	<div id="loadcom<?php echo $view->id_blog; ?>"></div>
				<div id="lade<?php echo $view->id_blog; ?>"></div>
            	<div id="comment<?php echo $view->id_blog; ?>" class="comment">
	                <div class="round_pic user_pic">
	                    <img src="<?php echo $photo_profil; ?>" alt="" />
	                </div>
	                <form action="" method="post" name="<?php echo $view->id_blog; ?>">
		                <textarea placeholder="<?php echo $feeds->sokial('X06'); ?>" id="textcom<?php echo $view->id_blog; ?>"></textarea>
		                <button id="<?php echo $view->id_blog; ?>" class="com_btn_blog"><i class="fa fa-angle-right"></i></button>
		            </form>
	                <div class="clear"></div>
	            </div>
            </div>
        </div>
		<div id="ShareBlog" class="popup_block">
		    <div class="popup_top">
		        <h4><?php echo $blog->sokial('B10'); ?></h4>
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