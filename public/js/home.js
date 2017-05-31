$(document).ready(function(){
    for(var x=0; x<=5; x++){
    $("#div"+x).addClass("img-thumbnail img-rounded")
            .css({
               background: '#0089cd', 
               width: '200'  
            });
    };
    $("#informacao").css({
        'background-color': '#0089cd',
        'background-position': 'center',
         height: '400'
    }); 
});
function mouseMove(x){
        $("#div"+x).css({
        background: '#33c2fc', color: 'white'
    }).click(function(){
         $("img").attr("src","img/loader.gif");
    });
    $("#div"+x).mouseout(function(){
        $("#div"+x).removeAttr("style")
        .css({
        background: '#0089cd',
        width: '200'
    });
    });
}



