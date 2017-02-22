// Chat Sidebar
$(document).ready(function(){
  $("#open_chat").click(function(){
    $("#right_chat").fadeIn(300);
  });
  $("#close_chat").click(function(){
    $("#right_chat").fadeOut(300);
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

// Button options
$(document).ready(function(){
    $("button").click(function(){
        $("div#options").toggle();
    });
});

$(document).ready(
    function(){
        $('img').hide();
    }
);
$(window).load(
    function(){
        $('img').fadeIn('slow');
    }
);