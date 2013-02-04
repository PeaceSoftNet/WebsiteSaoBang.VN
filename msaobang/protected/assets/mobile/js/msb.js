 $(document).ready(function(){
                        $(".all-category li").each(function(index, element) {
                            var el = $(this);
                            el.click(function(e) {
								var childEL = $(el).find('ul.Categlv2');
								var k = childEL.css('display');
								if( k === 'none'){
									$(document).find('ul.Categlv2').slideUp('slow', 'linear', $(document).find('a[name=labelCate]').removeClass('active') );
									childEL.slideDown('slow', 'linear', $(this).find('a[name=labelCate]').addClass('active'));
								}
								else{
									childEL.slideUp('slow', 'swing', $(this).find('a[name=labelCate]').removeClass('active'));
								}
                            });
                        });
						
						$("#slProvince").change(function(e) {
                             id = $(this).val();
							 $.post('mobile/SetProvince', {
								'location' : id
							}, function(){
								window.location.reload();
							});
                        });
						if(maxCss > 0){
							$('.PageNavNext').click(function(e) {
								post = parseInt($('div.paging > ul').css('right'));
								post = post + 225;
								if(post >= (maxCss * 225)) return false;
	//							if(post == 0) return false;
								$('div.paging > ul').animate({right:post+'px'},'slow');
							});
							
							$('.PageNavPrev').click(function(e) {
								post = parseInt($('div.paging > ul').css('right'));
								post = post - 225;
								if(post < 0) return false;
								$('div.paging > ul').animate({right:post+'px'}, 'slow');
							});
						}
                });
				
function searchContent(){
	searchText = $('#headSeach').val();	
	if(searchText != defKey){
		$('#searchHomepage').submit();
	} else {
		alert('Bạn phải chọn nội dung tìm kiếm!'); 
	}
}