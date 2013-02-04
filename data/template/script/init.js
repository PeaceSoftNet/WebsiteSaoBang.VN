$(document).ready(function(){    
    $(window).scroll(function () { 
        if($(window).scrollTop() > 125){
            $('#topbarGlobal').fadeIn(300);
        }else{
            $('#topbarGlobal').fadeOut(600);
        }
    });
            
    $('#homelocality').click(function(){
        if(this.value == 'Nhập tên thành phố'){
            this.value = '';
        }else{
            $('#localityAjx').load('/ad/homeLocalAjx #localityAjx', {
                'localKey' : this.value
            });
        }
    });
    $('#homelocality').keyup(function(){
        $('#localityAjx').load('/ad/homeLocalAjx #localityAjx', {
            'localKey' : this.value
        });
    });
    
});

//loadAdChodientu
function loadAdChodientu(categoryId){
    $('#adChodientu').load('/ad/chodientu', {
        'category': categoryId
    });
}

function setLocal(localId){
    $.post('/ad/getLocal', {
        'localId':localId
    }, function(){
        window.location.reload(true);
    });
}
//set filter
function setFilter(fnum, fvalue){
    $.post('/ad/setFilter', {
        'fnum':fnum, 
        'fvalue':fvalue
    }, function(){
        window.location.reload(true);
    });
}
//remove filter
function removeFilter(fnum){
    $.post('/ad/removeFilter', {
        'fnum':fnum
    }, function(){
        window.location.reload(true);
    });
}

function dropdownMenu(idArea){
    $("#"+idArea).slideToggle('600', function(){
        $("body").one("click", function() {
            $("#"+idArea).fadeOut('300');
        });
    });
}

function updateTopic(topicId){
    $('#uploadtingButton').html('<i class="dticon-postNews"></i>&nbsp;Uploadting');
    $.get('/ad/UpdateTopic', {
        'topicId': topicId
    }, function(data){
        alert(data);
        $('#uploadtingButton').html('<i class="dticon-postNews"></i>&nbsp;Success');
    });    
}

function searchCategoryAd(keyword){
    $('#categoryview').load('/ad/step1 #categoryview', {
        'keyword':keyword
    });
}
function step2Local(localId, localName){
    $('#localLabel').html(localName);
    $('#TopicModel_locality').val(localId);
}
/**
     * insert image to editor
     * 
     **/
function insertImg(srcImg, textId){
    var contentIsert = '';
    contentIsert = '<div><img style="max-width: 600px" src="'+srcImg+'"></div><br /><br />';
    tinyMCE.execCommand('mceInsertContent',false,contentIsert);
    return false;
}

/**
     * remove img
     */
function removeImg(valId){
    $('#imgArea'+valId).remove();
    var i = $('#number_countimg').val();
    i--;
    $('#number_countimg').val(i);
}

function gotoTop(){
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
}    
$.removeTopic = function(topicId){
    var answer = confirm("Bạn có chắc chắn muốn xóa tin này không?")
    if (answer){ 
        $.ajax({
            type: "post",
            url: '/topic/dl',
            data: {
                'id':topicId
            },
            success: function(result){
                if(result==1){
                    alert('Xóa thành công.');
                    window.location.reload( true );
                }
            }
        });
    }
}

function loadShop(keysearch){
    $('#listShopItem').load('/ad/pageShop', {
        'string': keysearch
    });
}