<script type="text/javascript">
$(document).ready(function(){
    var track_load = 0;
    var loading  = false;
    var total_groups = <?php echo $total_groups; ?>;
    $('#loadfeeds').load("<?php echo $domaine; ?>feeds_profile.php?id=<?php echo $id_profil; ?>",{'page':track_load},function(){track_load++;$.getScript('<?php echo $domaine; ?>template/sokial/js/feed.js');});
    $(window).scroll(function(){
        if($(window).scrollTop()+$(window).height() == $(document).height()){
            if(track_load <= total_groups && loading==false){
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo $domaine; ?>feeds_profile.php?id=<?php echo $id_profil; ?>',{'group_no': track_load}, function(data){
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

//Button post status show
$(function(){
    $("#publish_profil").focus(function(){
        $(this).animate({"height":"20px",},"fast");
        $(".post_profil").slideDown("fast");
        return false;
    });
});

//Add Status profil
$(function(){
    $(".post_profil").click(function(){
        var publish = $("#publish_profil").val();
        var dataString = 'publish_profil='+ publish;
        if(publish==''){
            alert("Please Enter Some Text");
        }else{
            $("#refresh").show();
            $("#refresh").fadeIn(400).html('<img src="../template/sokial/img/load.gif" align="center">');
            $.ajax({
                type:"POST",
                url:"../feed_status_profil.php?id=<?php echo $id_profil; ?>",
                data:dataString,
                cache:false,
                success:function(html){
                    $("div#update").prepend(html);
                    $("div#update div:first").slideDown("slow");
                    document.getElementById('publish_profil').value='';
                    document.getElementById('publish_profil').focus();
                    $("#refresh").hide();
                }
            });
        }
        return false;
    });
});

//Add friend
$(function(){
	$(".friend").click(function(){
		var id = $(this).attr("id");
		var name = $(this).attr("name");
		var dataString = 'id='+ id;
		var parent = $(this);
		if(name=='add_friend'){
			$(this).fadeIn(200).html('<img src="../template/sokial/img/load.gif"/>');
			$.ajax({
				type:"POST",
				url:"../friends_add.php",
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
				url:"../friends_delete.php",
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
		<h1><?php echo $profil->firstname.' '.$profil->lastname; ?></h1>
	</div>
</div>
<div id="profile_menu">
	<nav>
		<ul class="profile_tabs">
			<li><a href="#feeds" title=""><?php echo $header->sokial('H02'); ?></a></li>
			<?php if ($nbr_friend > 0) { ?>
			<li><a href="#friends" title=""><?php echo $header->sokial('H12'); ?></a></li>
			<?php } ?>
			<?php if ($nbr_photo > 0) { ?>
			<li><a href="#photos" title=""><?php echo $header->sokial('H04'); ?></a></li>
			<?php } ?>
			<?php if ($nbr_video > 0) { ?>
			<li><a href="#videos" title=""><?php echo $header->sokial('H05'); ?></a></li>
			<?php } ?>
			<?php if ($nbr_music > 0) { ?>
			<li><a href="#musics" title=""><?php echo $header->sokial('H06'); ?></a></li>
			<?php } ?>
			<?php if ($nbr_blog > 0) { ?>
			<li><a href="#blogs" title=""><?php echo $header->sokial('H07'); ?></a></li>
			<?php } ?>
			<?php if ($nbr_group > 0) { ?>
			<li><a href="#groups" title=""><?php echo $header->sokial('H13'); ?></a></li>
			<?php } ?>
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
				<span><?php echo $sex; ?></span>
				<span><?php echo $members->sokial('M06').' '.$country->name_country; ?></span>
				<span id="share_social">
					<a href="#" title="" id="twitter" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Twitter" onclick="Share.twitter('<?php echo $domaine.'profil/'.$id_profil; ?>','<?php echo $profil->firstname; ?>')"><i class="fa fa-twitter"></i></a>
					<a href="#" title="" id="facebook" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Facebook" onclick="Share.facebook('<?php echo $domaine.'profil/'.$id_profil; ?>','<?php echo $profil->firstname; ?>','','<?php echo $members->sokial('M06').' '.$country->name_country; ?>')"><i class="fa fa-facebook"></i></a>
					<a href="#" title="" id="google" class="sk-bubble network" sokial="<?php echo $general->sokial('G22'); ?> Google+" onclick="Share.google('<?php echo $domaine.'profil/'.$id_profil; ?>')"><i class="fa fa-google-plus"></i></a>
				</span>
			</div>
			<?php if ($id_profil != $_SESSION['sk_id']) { ?>
				<?php if(connected_member()) { ?>
	            <div id="status" class="status_profil">
	                <form method="post" action="">
	                    <textarea name="publish_profil" id="publish_profil" rows="1" placeholder="<?php echo $home->sokial('A01'); ?>"></textarea>
	                    <button class="btn btn_blue post_profil"><?php echo $home->sokial('A02'); ?></button>
	                </form>
	            </div>
	            <?php } ?>
            <?php } ?>
			<div id="refresh"></div><div id="update"></div>
	        <div id="loadfeeds" class="left"></div>
	        <div class="clear"></div>
	        <div class="animation_image">
	            <img src="<?php echo SK_IMG; ?>load.gif" alt=""/>
	        </div>
	    </div>
	    <div id="friends" class="profile_tab">
			<div id="members"><?php echo $list_friends; ?></div>  
	    </div>
	    <div id="photos" class="profile_tab">
	    	<div id="columns">
				<?php echo $list_photos; ?>
			</div>
	    </div>
	    <div id="videos" class="profile_tab">
			<?php echo $list_videos; ?>
	    </div>
	    <div id="musics" class="profile_tab">
			<?php echo $list_musics; ?> 
	    </div>
	    <div id="blogs" class="profile_tab">
			<?php echo $list_blogs; ?>
	    </div>
	    <div id="groups" class="profile_tab">
			<?php echo $list_groups; ?>
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