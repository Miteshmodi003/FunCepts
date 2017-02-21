<script type="text/javascript">
$(document).ready(function(){
    var track_load = 0;
    var loading  = false;
    var total_groups = <?php echo $total_groups; ?>;
    $('#loadfeeds').load("<?php echo $domaine; ?>feeds_groups.php?id=<?php echo $id_group; ?>",{'page':track_load},function(){track_load++;$.getScript('<?php echo $domaine; ?>template/sokial/js/feed.js');});
    $(window).scroll(function(){
        if($(window).scrollTop()+$(window).height() == $(document).height()){
            if(track_load <= total_groups && loading==false){
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo $domaine; ?>feeds_groups.php?id=<?php echo $id_group; ?>',{'group_no': track_load}, function(data){
                    $("#loadfeeds").append(data);
                    $('.animation_image').hide();
                    track_load++;
                    loading = false; 
                }).fail(function(xhr,ajaxOptions,thrownError){
                    alert(thrownError);
                    $('.animation_image').hide();
                    loading = false;
                });
            }
        }
    });
});

//Tabs post
$(document).ready(function(){
    $(".profile_tab").hide();
    $("ul.profile_tabs li:first").addClass("slec").show();
    $(".profile_tab:first").show();
    $("ul.profile_tabs li").click(function(){
        $("ul.profile_tabs li").removeClass("slec");
        $(this).addClass("slec");
        $(".profile_tab").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
});

//Join group
$(function(){
	$(".join").click(function(){
		var id = $(this).attr("id");
		var name = $(this).attr("name");
		var dataString = 'id='+ id;
		var parent = $(this);
		if(name=='meet_group'){
			$(this).fadeIn(200).html('<img src="../template/sokial/img/load.gif"/>');
			$.ajax({
				type:"POST",
				url:"../groups_joint.php",
				data:dataString,
				cache:false,
				success:function(html){
					parent.html(html);
				}
			});
		}else{
			$(this).fadeIn(200).html('<img src="../template/sokial/img/load.gif"/>');
			$.ajax({
				type:"POST",
				url:"../groups_leave.php",
				data:dataString,
				cache:false,
				success:function(html){
					parent.html(html);
				}
			});
		}
		return false;
	});
});
</script>
<?php if(isset($success)) echo '<div class="mess_valid"><p>&#8730; '.$success.'</p></div>' ?>

<div id="back_cover">
	<img src="<?php echo $cover; ?>" alt="" id="cover"/>
	<div id="pos_cover">
		<div id="border_photo_profil"></div>
		<img src="<?php echo $photo_profil; ?>" alt="" id="photo_profil"/>
		<h1><?php echo $view->name; ?></h1>
	</div>
</div>
<div id="profile_menu">
	<nav>
		<ul class="profile_tabs">
			<li><a href="#feeds" title=""><?php echo $header->sokial('H02'); ?></a></li>
			<li><a href="#users" title=""><?php echo $header->sokial('H03'); ?></a></li>
		</ul>
		<div class="right">
			<?php echo $add_cover; ?>
			<?php echo $add_photo; ?>
		</div>
	</nav>
</div>
<article id="profile">
	<section id="content">
		<div id="feeds" class="profile_tab">
	        <div id="profile_about">
				<span><?php echo $view->description; ?></span>
				<span id="share_social">
					<a href="#" title="" id="twitter" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Twitter" onclick="Share.twitter('<?php echo $domaine.'group/'.$id_group; ?>','<?php echo $view->name; ?>')"><i class="fa fa-twitter"></i></a>
					<a href="#" title="" id="facebook" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Facebook" onclick="Share.facebook('<?php echo $domaine.'group/'.$id_group; ?>','<?php echo $view->name; ?>','','<?php echo $view->description; ?>')"><i class="fa fa-facebook"></i></a>
					<a href="#" title="" id="google" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Google+" onclick="Share.google('<?php echo $domaine.'group/'.$id_group; ?>')"><i class="fa fa-google-plus"></i></a>
				</span>
			</div>

			<div id="refresh"></div><div id="update"></div>
	        <div id="loadfeeds" class="left"></div>
	        <div class="clear"></div>
	        <div class="animation_image">
	            <img src="<?php echo SK_IMG; ?>load.gif" alt=""/>
	        </div>
	    </div>
	    <div id="users" class="profile_tab">
			<div id="members"><?php echo $users; ?></div>  
	    </div>
	</section>
</article>

<div id="SendMessage" class="popup_block">
    <div class="popup_top">
        <h4><?php echo $members->sokial('M11').' '.$profil->firstname.' '.$profil->lastname; ?></h4>
    </div>
    <form method="post" action="">
	    <div id="send_message">
	        <textarea name="message" placeholder="<?php echo $members->sokial('M12'); ?>"></textarea>
	    </div>
	    <div class="popup_bottom">
	    	<button class="btn btn_blue right"><?php echo $general->sokial('G21'); ?></button>
	    	<div class="clear"></div>
	    </div>
	</form>
</div>