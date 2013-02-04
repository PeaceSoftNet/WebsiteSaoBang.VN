function loadAskContent(askId){
    $('#askPreview_'+askId).slideDown('1000', function(){
        $('#functionAsk_'+askId).fadeOut(0, function(){
            $('#descriptionAsk_'+askId).fadeIn();
        });
    });
}

function checkCountTitle(numberContenitem){
    $('#titleCharNumber').html(numberContenitem);
}
function checkCountContent(numberContenitem){
    $('#textContentNumber').html(numberContenitem);
}
function submitAsk(){
    $('#askSubmitForm').submit()
}
function getTitleTag(titString){
    $('#runtimeGetTag').load('/ask/getTag', {
        'string' : titString
    });
}
function getShop(destString){
    var asktitle = $('#askTitle').val();
    destString = asktitle + '. ' + destString;
    $('#runtimeGetShop').load('/ask/getShop #runtimeGetShop', {
        'dest' : destString
    });
}
function removeTag(tagname){
    $('#tag_'+tagname).remove();
}

function addProduct(){
    var pName = $('#inProduct').val();
    $('#listProduct').append('<li>'+pName+'</li>');
    $('#ShopIdentify_content').append(pName+'; ');
    $('#inProduct').val('');
}