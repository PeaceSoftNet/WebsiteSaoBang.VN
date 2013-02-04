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
$this->pageTitle = 'Đăng tin rao vặt - Bước 1: Chọn danh mục';
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="grid_12">
            <div class="title-page">
                <h1 class="fl">Đăng tin rao vặt</h1>
                <span class="cl99 fr">Bước <b>1</b>/3</span>
            </div>
        </div>
        <div class="listslCateg">
            <center>
                <input type="text" onkeyup="searchCategoryAd(this.value);" onclick="this.value='';" style="width: 450px;" class="findCateg" value="Nhập từ khóa tìm kiếm danh mục" />
            </center>            
        </div>
        <div id="categoryview">
            <?php
            foreach ($dataProvider as $index => $data) {
                if ($data->parentId == 0) {
                    ?>
                    <div class="listslCateg">
                        <p class="tit"><?php echo $data->name; ?></p>
                        <ul class="clearfix">
                            <?php
                            foreach ($dataProvider as $key => $value) {
                                if ($value->parentId == $data->id) {
                                    $link = Yii::app()->createUrl('ad/step2', array('categoryId' => $data->id, 'childCategoryId' => $value->id));
                                    ?>
                                    <li><a href="<?php echo $link; ?>"><?php echo $value->name; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div> 