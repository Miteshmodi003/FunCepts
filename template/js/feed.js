// Show comment textarea
$(document).ready(function(){
    $(".show_comment").click(function(){
        $.Callbacks("once")
        var element = $(this);
        var CI = element.attr("id");
        $("#comment"+CI).toggle(300);
        return false;
    });
});

//Tabs post
$(document).ready(function(){
    $(".feed_tab").hide();
    $("ul.feed_tabs li:first").addClass("active").show();
    $(".feed_tab:first").show();
    $("ul.feed_tabs li").click(function(){
        $("ul.feed_tabs li").removeClass("active");
        $(this).addClass("active");
        $(".feed_tab").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
});

//Button post status show
$(function(){
    $("#publish").focus(function(){
        $(this).animate({"height":"20px",},"fast");
        $(".post_status").slideDown("fast");
        return false;
    });
});

//Button post add_video show
$(function(){
    $("#link_video").focus(function(){
        $(this).animate({"height":"20px",},"fast");
        $(".post_video").slideDown("fast");
        return false;
    });
});

//Button post add_music show
$(function(){
    $("#link_music").focus(function(){
        $(this).animate({"height":"20px",},"fast");
        $(".post_music").slideDown("fast");
        return false;
    });
});

//Add Status
$(function(){
    $(".post_status").click(function(){
        var publish = $("#publish").val();
        var dataString = 'publish='+ publish;
        if(publish==''){
            alert("Please Enter Some Text");
        }else{
            $("#refresh").show();
            $("#refresh").fadeIn(400).html('<img src="../../template/sokial/img/load.gif" align="center">');
            $.ajax({
                type:"POST",
                url:"../../feed_status.php",
                data:dataString,
                cache:false,
                success:function(html){
                    $("div#update").prepend(html);
                    $("div#update div:first").slideDown("slow");
                    document.getElementById('publish').value='';
                    document.getElementById('publish').focus();
                    $("#refresh").hide();
                }
            });
        }
        return false;
    });
});

//Add video
$(function(){
    $(".post_video").click(function(){
        var link_video = $("#link_video").val();
        var dataString = 'link_video='+ link_video;
        if(link_video==''){
            alert("Please Enter Some Text");
        }else{
            $("#refresh").show();
            $("#refresh").fadeIn(400).html('<img src="../../template/sokial/img/load.gif" align="center">');
            $.ajax({
                type:"POST",
                url:"../../feed_add_video.php",
                data:dataString,
                cache:false,
                success:function(html){
                    $("div#update").prepend(html);
                    $("div#update div:first").slideDown("slow");
                    document.getElementById('link_video').value='';
                    document.getElementById('link_video').focus();
                    $("#refresh").hide();
                }
            });
        }
        return false;
    });
});

//Add music
$(function(){
    $(".post_music").click(function(){
        var link_music = $("#link_music").val();
        var dataString = 'link_music='+ link_music;
        if(link_music==''){
            alert("Please Enter Some Text");
        }else{
            $("#refresh").show();
            $("#refresh").fadeIn(400).html('<img src="../../template/sokial/img/load.gif" align="center">');
            $.ajax({
                type:"POST",
                url:"../../feed_add_music.php",
                data:dataString,
                cache:false,
                success:function(html){
                    $("div#update").prepend(html);
                    $("div#update div:first").slideDown("slow");
                    document.getElementById('link_music').value='';
                    document.getElementById('link_music').focus();
                    $("#refresh").hide();
                }
            });
        }
        return false;
    });
});

//Add comment
$(document).ready(function(){
    $(".com_btn").click(function(){
        var element = $(this);
        var Id = element.attr("id");
        var test = $("#textcom"+Id).val();
        var dataString = 'textcontent='+ test + '&com_id=' + Id;
        if(test==''){
            alert("Please Enter Some Text");
        }else{
            $("#lade"+Id).show();
            $("#lade"+Id).fadeIn(400).html('<img src="../../template/sokial/img/load.gif" alt=""/>');
            $.ajax({
                type:"POST",
                url:"../../feed_comment.php",
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

//Like Feed
$(function(){
    $(".likes").click(function(){
        var id = $(this).attr("id");
        var name = $(this).attr("name");
        var dataString = 'id='+ id;
        var parent = $(this);
        if(name=='like_feed'){
            $(this).fadeIn(200).html('<img src="../../template/sokial/img/load.gif"/>');
            $.ajax({
                type:"POST",
                url:"../../feed_like.php",
                data:dataString,
                cache:false,
                success:function(html){
                    parent.html(html);
                }
            });
        }else{
            $(this).fadeIn(200).html('<img src="../../template/sokial/img/load.gif"/>');
            $.ajax({
                type:"POST",
                url:"../../feed_unlike.php",
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

//Popup
jQuery(function($){
    $('a.poplight').on('click', function(){
        var popID = $(this).data('rel');
        var popWidth = $(this).data('width');
        $('#' + popID).fadeIn(200).css({ 'width': popWidth}).prepend('<a href="#" title="" class="popup_close">&times;</a>');
        var popMargTop = ($('#' + popID).height() + 80) / 2;
        var popMargLeft = ($('#' + popID).width() + 80) / 2;
        $('#' + popID).css({
            'margin-top' : -popMargTop,
            'margin-left' : -popMargLeft
        });
        $('body').append('<div id="popup"></div>');
        $('#popup').css({'filter' : 'alpha(opacity=80)'}).fadeIn(200);
        return false;
    });
    $('body').on('click', 'a.popup_close, #popup', function(){
        $('#popup , .popup_block').fadeOut(function(){
            $('#popup, a.popup_close').remove();  
    });
        return false;
    });
});

// Delete feed
$(function() {
    $(".delete_feed").click(function() {
        var id = $(this).attr("id");
        var dataString = 'id='+ id ;
        var parent = $("#feed"+id);
        $.ajax({
            type: "POST",
            url: "../../feed_delete.php",
            data: dataString,
            cache: false,
            beforeSend: function() {
                parent.animate({ opacity: 0.35 }, "slow");;
            }, 
            success: function() {
                parent.slideUp('slow', function() {$(this).remove();});
            }
        });
        return false;
    });
});

//Like Feed
$(function(){
    $(".shares").click(function(){
        var id = $(this).attr("id");
        var name = $(this).attr("name");
        var dataString = 'id='+ id;
        var parent = $(this);
        if(name=='share_feed'){
            $(this).fadeIn(200).html('<img src="../../template/sokial/img/load.gif"/>');
            $.ajax({
                type:"POST",
                url:"../../feed_share.php",
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