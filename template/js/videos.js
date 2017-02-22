// Live modification
$(function(){
	$(".title").keyup(function(){
		var title=$(this).val();
		$(".titl").html(title);
		return false;
	});
});

$(function(){
	$(".description").keyup(function(){
		var description=$(this).val();
		$(".desc").html(description);
		return false;
	});
});

// Share Social
Share = {
		facebook:function(purl,ptitle,pimg,text){
		url = 'http://www.facebook.com/sharer.php?s=100';
		url += '&p[title]='+encodeURIComponent(ptitle);
		url += '&p[summary]='+encodeURIComponent(text);
		url += '&p[url]='+encodeURIComponent(purl);
		url += '&p[images][0]='+encodeURIComponent(pimg);
		Share.popup(url);
	},
	twitter: function(purl,ptitle){
		url = 'http://twitter.com/share?';
		url += 'text='+encodeURIComponent(ptitle);
		url += '&url='+encodeURIComponent(purl);
		url += '&counturl='+encodeURIComponent(purl);
		Share.popup(url);
	},
	google: function(purl){
		url = 'https://plus.google.com/u/0/share?';
		url += 'url='+encodeURIComponent(purl);
		Share.popup(url);
	},
	popup: function(url){
		window.open(url,'','toolbar=0,status=0,width=626,height=436');
	}
};

//Like video
$(function(){
    $(".likev").click(function(){
        var id = $(this).attr("id");
        var name = $(this).attr("name");
        var dataString = 'id='+ id;
        var parent = $(this);
        if(name=='like_video'){
            $(this).fadeIn(200).html('<img src="../template/sokial/img/load.gif"/>');
            $.ajax({
                type:"POST",
                url:"../videos_like.php",
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
                url:"../videos_unlike.php",
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

//Add comment
$(document).ready(function(){
    $(".com_btn_video").click(function(){
        var element = $(this);
        var Id = element.attr("id");
        var test = $("#textcom"+Id).val();
        var dataString = 'textcontent='+ test + '&com_id=' + Id;
        if(test==''){
            alert("Please Enter Some Text");
        }else{
            $("#lade"+Id).show();
            $("#lade"+Id).fadeIn(400).html('<img src="../template/sokial/img/load.gif" alt=""/>');
            $.ajax({
                type:"POST",
                url:"../videos_comment.php",
                data:dataString,
                cache:false,
                success:function(html){
                    $("#loadcom"+Id).append(html);
                    document.getElementById('textcom'+Id).value='';
                    document.getElementById('textcom'+Id).focus();
                    $("#lade"+Id).hide();
                }
            });
        }
        return false;
    });
});

//Tabs
$(document).ready(function(){
    $(".video_submenu").hide();
    $("ul.video_menu li:first").addClass("active").show();
    $(".video_submenu:first").show();
    $("ul.video_menu li").click(function(){
        $("ul.video_menu li").removeClass("active");
        $(this).addClass("active");
        $(".video_submenu").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
});