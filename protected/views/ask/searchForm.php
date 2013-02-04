<?php
/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$this->beginWidget('CActiveForm', array('id' => 'searchHomepage', 'method' => 'get', 'action' => Yii::app()->createUrl('ask/search')));
?>
<div class="textcap1">Tôi muốn tìm</div>
<style type="text/css">
    .browse-head .boxsearch{width: 586px}
    .boxsearch input.search-head{width: 570px;}
</style>
<div class="boxsearch">
    <span class="corner-left"></span>
    <span class="corner-right"></span>
    <input class="search-head" type="text" name="keyword" id="keywordAsktoBy" value="<?php echo $keyword; ?>" />
</div>                    
<a class="submit-head" onclick="searchContent();" href="javascript:void(0);">Tìm ngay</a>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#keywordAsktoBy').click(function(){
            if(this.value=="<?php echo $keyword; ?>") this.value="";
        });
    });    
</script>