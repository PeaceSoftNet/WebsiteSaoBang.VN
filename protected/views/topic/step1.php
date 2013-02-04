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
$this->pageTitle = 'Đăng rao vặt - Chọn danh mục';
?>

<div class="block">
    <div class="bl-title clearfix">
        <form id="searchCategory" method="get" action="">
            <div class="fr"><input type="text" class="findCateg" onkeyup="searchCategoryThroughDescription(this.value);" name="categoryKey" onclick="this.value=''" value="<?php if ($keyword) echo $keyword; else echo 'Tìm kiếm danh mục đăng tin'; ?>" /></div>
        </form>
        <h4><b class="org-clr">Bước 1:</b> Chọn danh mục đăng tin</h4>
    </div>
    <?php
    if ($dataProvider) {
        foreach ($dataProvider as $key => $value) {
            if ($value->parentId == 0) {
                $listCategory[$value->id]['title'] = $value->name;
                foreach ($dataProvider as $index => $data) {
                    if ($data->parentId == $value->id) {
                        $listCategory[$value->id]['child'][$data->id] = $data->name;
                    }
                }
            }
        }
    }
    ?>
    <div id="findCategorZone">
        <?php
        if (isset($listCategory)) {
            ?>

            <div class="block-content">
                <?php
                foreach ($listCategory as $keyId => $item) {
                    ?>
                    <div class="listslCateg">
                        <p class="tit"><?php echo $item['title']; ?></p>

                        <ul class="clearfix">
                            <?php
                            if (isset($item['child'])) {
                                foreach ($item['child'] as $keyChild => $itemChild) {
                                    ?>
                                    <li><a href="<?php echo Yii::app()->createUrl('topic/step2', array('categoryId' => $keyId, 'childCatId' => $keyChild)) ?>"><?php echo $itemChild ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>    
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    function searchCategoryThroughDescription(keyword){
        $('#findCategorZone').load('<?php echo Yii::app()->createUrl('topic/step1') ?> #findCategorZone', {'categoryKey':keyword});
    }
    
</script>