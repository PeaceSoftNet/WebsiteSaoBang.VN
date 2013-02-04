$(document).ready(function($){
    $('a[rel*=facebox]').facebox({
        loadingImage : '/themes/facebok/loading.gif',
        closeImage   : '/themes/facebok/closelabel.png'
    })
    //process action click continune
    $('#loadContent').click(function(){
        pagging();
    });
    
    var currHeight = $('#loadContent').offset().top;
    $(window).scroll(function(){
        if  ($(window).scrollTop() == $(document).height() - $(window).height()){
            pagging();
        }
    }); 
});

//paging append content
function pagging(){
    var page = $("#currentPage").val();
    var glink = window.location;
    page++;
    $.ajax({
        type: "GET",
        url: glink,
        data: "page="+page, 
        success: function(html){
            $("#listViewAd").append(html); 
            $('#currentPage').val(page);
        }
    });
}