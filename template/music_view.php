<article id="page_full">
	<div id="music_view">
		<div id="content_music">
			<?php echo $view->embed; ?>
		</div>
	</div>
	<section id="bloc_view">
		<div id="pic"><a href="<?php echo $domaine; ?>profil/<?php echo $user->id_user; ?>" title=""><img src="<?php echo $photo_user; ?>" alt="" /></a></div>
		<h1><?php echo $title; ?></h1>
		<span class="grey"><?php echo $music->sokial('U03'); ?>
			<a href="<?php echo $domaine; ?>profil/<?php echo $user->id_user; ?>" title="" class="capital"><?php echo $user->firstname.' '.$user->lastname; ?></a> 
			<?php echo $music->sokial('U04'); ?> <a href="" title=""><?php echo $cat->name; ?></a>
			<span id="time">- <?php echo $time; ?></span>
		</span>
		<div class="clear"></div>
		<div id="infos_photo">
			<ul>
        		<?php echo $like; ?>
        		<li><div class="show_comment" id="<?php echo $view->id_music; ?>"><i class="fa fa-comments-o"></i><?php echo $feeds->sokial('X04'); ?></div></li>
                <li><a href="#" title="" data-width="500" data-rel="ShareMusic" class="poplight" rel="popup_name"><i class="fa fa-share-square-o"></i><?php echo $feeds->sokial('X05'); ?></a></li>
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
        	<div id="loadcom<?php echo $view->id_music; ?>"></div>
			<div id="lade<?php echo $view->id_music; ?>"></div>
        	<div id="comment<?php echo $view->id_music; ?>" class="comment">
                <div class="round_pic user_pic">
                    <img src="<?php echo $photo_profil; ?>" alt="" />
                </div>
                <form action="" method="post" name="<?php echo $view->id_music; ?>">
	                <textarea placeholder="<?php echo $feeds->sokial('X06'); ?>" id="textcom<?php echo $view->id_music; ?>"></textarea>
	                <button id="<?php echo $view->id_music; ?>" class="com_btn_music"><i class="fa fa-angle-right"></i></button>
	            </form>
                <div class="clear"></div>
            </div>
        </div>
        <div id="ShareMusic" class="popup_block">
		    <div class="popup_top">
		        <h4><?php echo $music->sokial('U08'); ?></h4>
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