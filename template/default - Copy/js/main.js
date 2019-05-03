/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    
    $(".close").click(function(){ $(".msgbox").remove(); });

    $(".review").click(function(){
        $.fancybox({'padding': 10, 'scrolling' : 'no','href':  $(this).attr("href"),'transitionIn': 'elastic','transitionOut'	: 'elastic'});
        return false;

    });
});

