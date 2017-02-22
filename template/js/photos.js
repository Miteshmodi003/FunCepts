//Like Photo
$(function(){
    $(".likep").click(function(){
        var id = $(this).attr("id");
        var name = $(this).attr("name");
        var dataString = 'id='+ id;
        var parent = $(this);
        if(name=='like_photo'){
            $(this).fadeIn(200).html('<img src="../template/sokial/img/load.gif"/>');
            $.ajax({
                type:"POST",
                url:"../photos_like.php",
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
                url:"../photos_unlike.php",
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

// Show comment textarea
$(document).ready(function(){
    $(".show_comment").click(function(){
        var element = $(this);
        var CI = element.attr("id");
        $("#comment"+CI).toggle(300);
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
            $("#lade"+Id).fadeIn(400).html('<img src="../template/sokial/img/load.gif" alt=""/>');
            $.ajax({
                type:"POST",
                url:"../photos_comment.php",
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