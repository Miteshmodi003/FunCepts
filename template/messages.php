<script type="text/javascript">
$(document).ready(function(){
	$(".disc").hide();
	$("ul.convs li:first").addClass("active").show();
    $(".disc:first").show();
	$("ul.convs li").click(function(){
		var element = $(this);
		var CI = element.attr("id");
		var track_load = 0;
		$('#replies'+CI).load('<?php echo $domaine; ?>messages_reply.php?id='+ CI +'',{'page':track_load},function(){track_load++;});
		$("ul.convs li").removeClass("active");
        $(this).addClass("active");
        $(".disc").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
	});
});
</script>
<article id="page_full">
	<section id="upload">
		<ul class="convs">
			<?php echo $conversation; ?>
		</ul>
		<div id="select_convers">
			<?php echo $members->sokial('M15'); ?>
		</div>
	</section>
</article>