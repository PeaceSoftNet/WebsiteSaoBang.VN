$(document).ready(function($){
    $('a[rel*=facebox]').facebox({
        loadingImage : '/themes/facebok/loading.gif',
        closeImage   : '/themes/facebok/closelabel.png'
    })
    //process action click continune
    $('#loadContentSearch').click(function(){
        paggingSearch();
    });
    //end process click
    var currHeight = $('#loadContentSearch').offset().top;
    $(window).scroll(function(){
        if  ($(window).scrollTop() == $(document).height() - $(window).height()){
            paggingSearch();
        }
    }); 
});

//paging append content
function paggingSearch(){
    var page = $("#currentPage").val();
    var glink = window.location;
    page++;
    $.ajax({
        type: "GET",
        url: glink,
        data: "ASolrDocument_page="+page, 
        success: function(html){
            $("#listViewAd").append(html); 
            $('#currentPage').val(page);
        }
    });
}