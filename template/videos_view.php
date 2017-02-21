<article id="page_full">
	<div id="video_view">
		<div id="content_video">
			<?php echo $view->embed; ?>
		</div>
	</div>
	<div id="line_view">
		<div id="content">
			<div id="share_social">
				<a href="" title="" id="twitter" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Twitter" onclick="Share.twitter('<?php echo $domaine.'video/'.$view->id_video; ?>','<?php echo $view->title; ?>')"><i class="fa fa-twitter"></i></a>
				<a href="" title="" id="facebook" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Facebook" onclick="Share.facebook('<?php echo $domaine.'video/'.$view->id_video; ?>','<?php echo $view->title; ?>','http://i2.ytimg.com/vi/<?php echo $view->unique_id; ?>/mqdefault.jpg','<?php echo $description; ?>')"><i class="fa fa-facebook"></i></a>
				<a href="" title="" id="google" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Google+" onclick="Share.google('<?php echo $domaine.'video/'.$view->id_video; ?>')"><i class="fa fa-google-plus"></i></a>
			</div>
			<p id="video_views"><?php echo $view->views; ?> <span><?php echo $video->sokial('V10'); ?></span></p>
		</div>
	</div>
    <section id="bloc_view">
		<div id="pic"><a href="<?php echo $domaine; ?>profil/<?php echo $user->id_user; ?>" title=""><img src="<?php echo $photo_user; ?>" alt="" /></a></div>
		<h1><?php echo $title; ?></h1>
		<span class="grey"><?php echo $video->sokial('V07'); ?> 
			<a href="<?php echo $domaine; ?>profil/<?php echo $user->id_user; ?>" title="" class="capital"><?php echo $user->firstname.' '.$user->lastname; ?></a> 
			<?php echo $video->sokial('V08'); ?> <a href="" title=""><?php echo $cat->name; ?></a>
			<span id="time">- <?php echo $time; ?></span>
		</span>
		<div class="clear"></div>

        <ul class="video_menu">
            <li><a href="#about" title=""><?php echo $video->sokial('V15'); ?></a></li>
            <li><a href="#embed" title=""><?php echo $video->sokial('V16'); ?></a></li>
        </ul>

		<div class="description video_submenu" open="false" id="about">
			<p><?php echo $descb; ?><span class="hidd"><?php echo $desca; ?></span></p>
			<span class="opened" onclick="this.parentNode.setAttribute('open',true);"><?php echo $video->sokial('V11'); ?> </span>
			<span class="secret" onclick="this.parentNode.setAttribute('open',false);"><?php echo $video->sokial('V12'); ?> </span>
		</div>

		<div id="embed" class="video_submenu">
       		<p><input type="text" value="<?php echo $domaine.'video/'.$view->id_video; ?>" style="width:300px"/></p>
       		<p><textarea>&lt;iframe width="750" height="421" src="<?php echo $domaine.'watch/'.$view->id_video; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>&lt;/iframe></textarea></p>
    	</div>

		<div id="infos_photo">
			<ul>
        		<?php echo $like; ?>
        		<li><div class="show_comment" id="<?php echo $view->id_video; ?>"><i class="fa fa-comments-o"></i><?php echo $feeds->sokial('X04'); ?></div></li>
                <li><a href="#" title="" data-width="500" data-rel="ShareVideo" class="poplight" rel="popup_name"><i class="fa fa-share-square-o"></i><?php echo $feeds->sokial('X05'); ?></a></li>
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
        	<div id="loadcom<?php echo $view->id_video; ?>"></div>
			<div id="lade<?php echo $view->id_video; ?>"></div>
        	<div id="comment<?php echo $view->id_video; ?>" class="comment">
                <div class="round_pic user_pic">
                    <img src="<?php echo $photo_profil; ?>" alt="" />
                </div>
                <form action="" method="post" name="<?php echo $view->id_video; ?>">
	                <textarea placeholder="<?php echo $feeds->sokial('X06'); ?>" id="textcom<?php echo $view->id_video; ?>"></textarea>
	                <button id="<?php echo $view->id_video; ?>" class="com_btn_video"><i class="fa fa-angle-right"></i></button>
	            </form>
                <div class="clear"></div>
            </div>
        </div>
        <div id="ShareVideo" class="popup_block">
		    <div class="popup_top">
		        <h4><?php echo $video->sokial('V13'); ?></h4>
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