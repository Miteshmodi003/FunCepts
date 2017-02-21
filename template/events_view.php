<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo SK_JS; ?>map.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var track_load = 0;
    var loading  = false;
    var total_groups = <?php echo $total_groups; ?>;
    $('#loadfeeds').load("<?php echo $domaine; ?>feeds_events.php?id=<?php echo $id_event; ?>",{'page':track_load},function(){track_load++;$.getScript('<?php echo $domaine; ?>template/sokial/js/feed.js');});
    $(window).scroll(function(){
        if($(window).scrollTop()+$(window).height() == $(document).height()){
            if(track_load <= total_groups && loading==false){
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo $domaine; ?>feeds_events.php?id=<?php echo $id_event; ?>',{'group_no': track_load}, function(data){
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

//Map
$(function() { 
    $("#map").goMap({
    	mapTypeControl:false,
        maptype:'ROADMAP',
        address:'<?php echo $event->city; ?>, <?php echo $country->name_country; ?>', 
        zoom:12
    });
    $.goMap.createMarker({  
            address:'<?php echo $event->city; ?>, <?php echo $country->name_country; ?>',
            icon:'images/',
            html:{ 
                id:'#info_event', 
                popup:true 
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

//Going event
$(function(){
    $(".going").click(function(){
        var id = $(this).attr("id");
        var name = $(this).attr("name");
        var dataString = 'id='+ id;
        var parent = $(this);
        if(name=='going_event'){
            $(this).fadeIn(200).html('<img src="../template/sokial/img/load.gif"/>');
            $.ajax({
                type:"POST",
                url:"../events_going.php",
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
                url:"../events_leave.php",
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
<div id="back_map">
	<div id="info_event">
		<p class="title_event"><?php echo $event->title; ?></p>
		<span><?php echo $event->address; ?>, <?php echo $event->city; ?>, <?php echo $country->name_country; ?></span>
	</div>

	<div id="map"></div>
</div>
<div id="profile_menu">
	<nav>
		<ul class="profile_tabs">
			<li><a href="#informations" title=""><?php echo $evnt->sokial('E11'); ?></a></li>
			<li><a href="#going" title=""><?php echo $evnt->sokial('E12'); ?> (<?php echo $nb_going->n_going; ?>)</a></li>
		</ul>
		<div class="right">
			<?php echo $going; ?>
            <?php echo $message; ?>
		</div>
	</nav>
</div>

<article id="event">
	<section id="content">
		<div id="informations" class="profile_tab">
	        <div id="event_about">
				<span class="info_marker"><i class="fa fa-calendar"></i> <?php echo $event->day; ?> - <?php echo $event->date_end; ?></span>
				<span class="info_marker"><i class="fa fa-map-marker"></i> <?php echo $event->address; ?>, <?php echo $event->city; ?>, <?php echo $country->name_country; ?></span>
				<p class="details_event"><?php echo $event->details; ?></p>
			</div>
			<div id="profile_feeds">
				<div id="refresh"></div><div id="update"></div>
		        <div id="loadfeeds" class="left"></div>
		        <div class="clear"></div>
		        <div class="animation_image">
		            <img src="<?php echo SK_IMG; ?>load.gif" alt=""/>
		        </div>
			</div>
	    </div>
	    <div id="going" class="profile_tab">
	    	<div id="members">
				<?php echo $going_users; ?>
			</div>
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