<?php
/**
 * 
 * @author             Linhnt 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */       
 $sess = Yii::app()->session['loginName']; 
 if($this->_rawSearchData['resultBrowse']){
    $data = $this->_rawSearchData['resultBrowse'];
//    $catId = $this->_rawSearchData['keyword'];
 } else{
    $data = $this->_rawSearchData['result'];
 }
$keyword = urldecode($this->_rawSearchData['keyword']);
$total = $this->_rawSearchData['total'];
$currentPage = $this->_rawSearchData['page'];
$perPage = $_GET['p'] ? $_GET['p']:20;
if($total > $perPage)
        $totalPage = round($total/$perPage) ;
$nameCate = $_GET['name'] ;
echo '<ul class="list-Browse-NewsRv">';
if(!empty($data)){     
    if($this->_rawSearchData['result'])                // draw search result
            echo '<h1 class="title-page">Đang tìm: '.$keyword.'</h1>';
    echo $this->drawMainContent($data);
}       //end if
else echo '<li>Không có bản tin nào thuộc danh mục này</li>';
echo '</ul>';
//paging

if($totalPage > 1){
$margin = ceil($currentPage/ 5);
$marginCSS = ' style="right:'.($margin-1)*225 .'px"';
$maxCSS = ceil($totalPage/5);
$this->_maxCss = $maxCSS;
echo '<div class="pagination clearfix">
<a class="PageNavPrev"><b>←</b></a>
            <div class="paging">
                <ul'.$marginCSS.'>';
$i = 1;
for($i; $i < $totalPage; $i++){
    if($i == $currentPage)
        echo '<li><a href="'.Yii::app()->createUrl('mobile/browse', array('catId'=>$keyword, 'name'=>$nameCate, 'page'=>$i)).'" class="active">'.$i.'</a></li>';
    else
        echo '<li><a href="'.Yii::app()->createUrl('mobile/browse', array('catId'=>$keyword, 'name'=>$nameCate, 'page'=>$i)).'">'.$i.'</a></li>';
        
}
echo '   </ul>
            </div>
            <a class="PageNavNext">→</a>
            <a class="btn-prev" href="'.Yii::app()->createUrl('mobile/browse', array('catId'=>$keyword, 'name'=>$nameCate, 'page'=>$currentPage-1)).'">« Trước</a>
            <a class="btn-next" href="'.Yii::app()->createUrl('mobile/browse', array('catId'=>$keyword, 'name'=>$nameCate, 'page'=>$currentPage+1)).'">Sau »</a>
        </div>';
}
?>