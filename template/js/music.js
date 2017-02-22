//Like music
$(function(){
    $(".likem").click(function(){
        var id = $(this).attr("id");
        var name = $(this).attr("name");
        var dataString = 'id='+ id;
        var parent = $(this);
        if(name=='like_music'){
            $(this).fadeIn(200).html('<img src="../template/sokial/img/load.gif"/>');
            $.ajax({
                type:"POST",
                url:"../music_like.php",
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
                url:"../music_unlike.php",
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
    $(".com_btn_music").click(function(){
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
                url:"../music_comment.php",
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