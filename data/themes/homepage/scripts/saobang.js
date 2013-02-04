$(document).ready(function() {  
    
    $("#dropLocal").bind({
        click: function(){
            $('#_dropLocal').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_dropLocal').fadeOut(100, function() {
                $('#_dropLocal').attr('style', 'display: none;'); 
            });            
        }
    });
    
    $(".categsearch").bind({
        click: function(){
            $('#_catSvalue').attr('style', 'display: block;'); 
        },
        mouseenter: function(){
            $('#_catSvalue').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_catSvalue').fadeOut(100, function() {
                $('#_catSvalue').attr('style', 'display: none;'); 
            });
        }
    });
    
    $("#leftdropLocal").bind({
        click: function(){
            $('#_leftLocal').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftLocal').fadeOut(100, function() {
                $('#_leftLocal').attr('style', 'display: none;'); 
            });
        }
    });
    
    $("#leftDropCategory").bind({
        click: function(){
            $('#_leftCat').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftCat').fadeOut(100, function() {
                $('#_leftCat').attr('style', 'display: none;'); 
            });
        }
    });
    
    $("#leftCCat").bind({
        click: function(){
            $('#_leftCCat').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftCCat').fadeOut(100, function() {
                $('#_leftCCat').attr('style', 'display: none;'); 
            });
        }
    });
    
    $("#leftDemand").bind({
        click: function(){
            $('#_leftDemand').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftDemand').fadeOut(100, function() {
                $('#_leftDemand').attr('style', 'display: none;'); 
            });
        }
    });
    
    $("#leftA1").bind({
        click: function(){
            $('#_leftA1').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftA1').fadeOut(100, function() {
                $('#_leftA1').attr('style', 'display: none;'); 
            });
        }
    });

    $("#leftA2").bind({
        click: function(){
            $('#_leftA2').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftA2').fadeOut(100, function() {
                $('#_leftA2').attr('style', 'display: none;'); 
            });
        }
    });
        
    $("#leftA3").bind({
        click: function(){
            $('#_leftA3').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftA3').fadeOut(100, function() {
                $('#_leftA3').attr('style', 'display: none;'); 
            });
        }
    });

    $("#leftA4").bind({
        click: function(){
            $('#_leftA4').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftA4').fadeOut(100, function() {
                $('#_leftA4').attr('style', 'display: none;'); 
            });
        }
    });
        
    $("#leftA5").bind({
        click: function(){
            $('#_leftA5').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftA5').fadeOut(100, function() {
                $('#_leftA5').attr('style', 'display: none;'); 
            });
        }
    });
    
    $("#leftSite").bind({
        click: function(){
            $('#_leftSite').attr('style', 'display: block;'); 
        },
        mouseleave: function(){
            $('#_leftSite').fadeOut(100, function() {
                $('#_leftSite').attr('style', 'display: none;'); 
            });
        }
    });
        
    
    $('#headSeach').click(function(){
        if(this.value=="Ví dụ: iphone cũ giá rẻ..") this.value='';
    });
    
    $('#homelocality').click(function(){
        if(this.value == 'Nhập tên thành phố'){
            this.value = '';
        }else{
            $('#localityAjx').load('/home/index #localityAjx', {
                'localKey' : this.value
            });
        }
    });
    $('#homelocality').mouseout(function(){
        if(this.value == ''){
            this.value = 'Nhập tên thành phố';
        }
    });
    $('#homelocality').keyup(function(){
        $('#localityAjx').load('/home/index #localityAjx', {
            'localKey' : this.value
        });
    });
    
    /**
     *@augments Chienlv
     *@return   Hàm xử lý hiển thị chi tiết bài viết
     **/
    $.topicDetail = function(obj){
        var $obj    =   $(obj);
        var rel     =   $obj.attr('rel');
        var id      =   $obj.attr('id');
        var $tpdt    =   $('#Chienlv-'+rel);
        if($tpdt.attr('rel')=='false'){
            $('a[rel='+rel+'] span').text("Ẩn");
            $('a[rel='+rel+'] i').attr('class','gr-icon-expand2');
            
            $tpdt.attr('rel','true');
            $tpdt.removeClass('falseDetail');
            $tpdt.addClass('trueDetail');
        }else
        {
            $('a[rel='+rel+'] span').text("Chi tiết");
            $('a[rel='+rel+'] i').attr('class','gr-icon-expand');
            $tpdt.attr('rel','false');
            $tpdt.removeClass('trueDetail');
            $tpdt.addClass('falseDetail');
        }
    }
    $('.floatOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
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
    
    $.priceFormat = function(obj){
        var $obj    =   $(obj);
        var value   =   $.trim($obj.attr('value'));
        value   =   value.replace(/[^0-9\.]/g,'');
        $obj.attr('value',currencyFormatted(value));
    }
    
    $.udTopic = function(tpId){
        $('.dtpostNews').html('Uploading');
        $.get('/home/updateTopic', {
            'topicId' : tpId, 
            'code':'true'
        }, function(){
            $('.dtpostNews').css('color', '#666');
            $('.dtpostNews').html('Success');
            $('.dtpostNews').attr('onclick', 'void(0)');
        });
    }   
});

function currencyFormatted(amount) {
    var c_money = amount.toString().replace(/\./gi,'');
    var lens = c_money.length; 
    var result = '';
    var i=0;
    if(lens>3){
        while(lens>0){
            result += c_money.charAt(lens-1);
            lens--;
            i++;
            if(i==3 && lens>0) {
                result +='.';
                i=0;   
            }
        }
        c_money = '';
        for(i=result.length-1;i>=0;i--)
            c_money += result.charAt(i);
        return c_money;
    }
    return amount;
}

function setLocation(locality){
    $.post('/home/SetLocation', {
        'location' : locality
    }, function(){
        window.location.reload();
    });
}
function setLocality(locality){
    $.post('/home/SetLocation', {
        'location' : locality
    }, function(){
        window.location.reload();
    });
}
 
function autoload(){ 
    var t = setTimeout("autoload()", 60000); 
    $('#totalCrawlerLink').load('/home/CrawlerStatistic');
}

function setPostPerPage(valNum){
    $.post('/home/PostPerPage', {
        'postNum' : valNum
    }, function(){
        window.location.reload();
    });
}

function setCategory(catId, catName){
    $('#categorySeachValue').html(catName);
    $('#categorySeach').val(catId);
    $('#childCatSeach').val('0');
    $(".categsearch").bind({
        click: function(){
            $('#_catSvalue').attr('style', 'display: none;'); 
        }
    });
}

function setChildCategory(catId, catName, childCat, childName){
    $('#categorySeachValue').html(childName);
    $('#categorySeach').val(catId);   
    $('#childCatSeach').val(childCat);
    $(".categsearch").bind({
        click: function(){
            $('#_catSvalue').attr('style', 'display: none;'); 
        }
    });
}

function showDropDown(dropId, functionId){
    var currentVal = $('#'+dropId).val();    
    if(currentVal==1){
        $('#'+functionId).attr('style', 'display: block;'); 
        $('#'+dropId).val(0);
    }else{
        $('#'+functionId).attr('style', 'display: none;'); 
        $('#'+dropId).val(1);
    }
}

function topicIsVip(tpId){
    $.post('/topic/ad', {
        'topicId': tpId
    }, function(){
        alert("Bạn đã đăng tin VIP thành công!!!");
    });
}

function searchContent(){
    var keyword = $('#headSeach').val();
    if(keyword && keyword != "Ví dụ: iphone cũ giá rẻ..")    
        $('#searchHomepage').submit();
    else alert('Vui lòng nhập từ khóa tìm kiếm');
}

function share_facebook(){
    var u=location.href;
    var t=document.title;
    window.open("https://www.facebook.com/share.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t))
}
function share_google(){
    var u=location.href;
    var t=document.title;
    window.open("http://www.google.com/bookmarks/mark?op=edit&bkmk="+encodeURIComponent(u)+"&title="+t+"&annotation="+t)
}
function share_buzz(){
    var u=location.href;
    var t=document.title;
    window.open("http://buzz.yahoo.com/buzz?publisherurn=DanTri&targetUrl="+encodeURIComponent(u))
}
function share_twitter(){
    var u=location.href;
    var t=document.title;
    window.open("http://twitter.com/home?status="+encodeURIComponent(u))
}

function removetopic(topicId){
    var answer = confirm("Bạn có chắc chắn muốn xóa tin này không?")
    if (answer){	
        $.post('/administrator/removeTopic', {
            'id':topicId
        }, function(){
            alert('Xóa thành công.');
            window.location.reload( true );
        });
    }
}

function releasetopic(topicId){
    var answer = confirm("Bạn có chắc chắn muốn lấy lại rao vặt này không?")
    if (answer){	
        $.post('/administrator/releaseTopic', {
            'id':topicId
        }, function(){
            window.location.reload( true );
        });
    }
}

function removeAdTopic(topicId){
    var answer = confirm("Bạn có chắc chắn muốn xóa tin này không?")
    if (answer){
        $.post('/administrator/removeAdTopic', {
            'id':topicId
        }, function(){
            alert('Xóa thành công.');
            window.location.reload( true );
        });
    }
}

function previewTopicDetail(tId){    
    $('#viewdetail'+tId).html('<i class="gr-icon-expand2"></i> <span>Ẩn</span>');
    $('#preview'+tId).html('Loading');
    $('#preview'+tId).load('/home/TopicPreview?id='+tId, {'id': tId});
    $('#viewdetail'+tId).attr('onclick', 'hiddenPreviewDetail(\''+tId+'\')');
}

function hiddenPreviewDetail(tId){
    $('#viewdetail'+tId).html('<i class="gr-icon-expand"></i> <span>Chi tiết</span>');
    $('#preview'+tId).html('');
    $('#viewdetail'+tId).attr('onclick', 'previewTopicDetail(\''+tId+'\')');
}