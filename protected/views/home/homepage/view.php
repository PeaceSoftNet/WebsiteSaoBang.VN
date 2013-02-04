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
$this->pageTitle = 'Rao vặt miễn phí';
Yii::app()->clientScript->registerMetaTag('Rao vặt miễn phí Saobang.vn - Website tổng hợp thông tin mua bán, rao vặt và việc làm trên toàn quốc. Đăng tin và tìm kiếm nhanh nhất, hoàn toàn miễn phí . Sản phẩm của Peacesoft Solutions.', 'description');
Yii::app()->clientScript->registerMetaTag('mua bán, rao vặt, việc làm, online, ' . ExtensionClass::getCurrentLocality(), 'keyword');
Yii::app()->clientScript->registerMetaTag('1 days', 'revisit-after');
?>

<div class="grid_9">
    <?php
    $this->renderPartial('statistic/view', array('dataProviderSite' => $dataProviderSite, 'dataProviderNotify' => $dataProviderNotify));
    ?>
    <!-- LeaderBoard_728x90 -->
    <div id='div-gpt-ad-1352106844912-0' style="margin-bottom: 20px;">
        <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1352106844912-0'); });
        </script>
    </div>
    <div class="block">
        <div class="bl-title"><h4>Danh mục rao vặt</h4></div>
        <div class="block-content">
            <ul class="categRv">        
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => 'homepage/_view',
                    'template' => "{items}",
                    'emptyText' => '',
                        )
                );
                ?>                
            </ul>
        </div>
    </div>                
</div>

<div class="grid_3">            
    <div class="block slt-location">
        <div class="bl-title"><h4>Chọn Tỉnh/Thành phố</h4></div>
        <div class="block-content">
            <input class="enter-lct" id="homelocality" type="text" value="Nhập tên thành phố" />
            <div id="localityAjx">
                <div class="holder">
                    <div class="list-lct scroll-pane">
                        <ul class="clearfix">
                            <?php
                            if (!isset($_POST['localKey']))
                                echo '<li><a onclick="setLocation(0);" href="javascript:void(0);">Toàn quốc</a></li>';

                            foreach ($dataProviderLocality as $index => $data) {
                                echo '<li><a onclick="setLocation(' . $data->id . ');" href="javascript:void(0);">' . $data->name . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $this->renderPartial('advertising/homePage', array('dataProviderAd' => $dataProviderAd));
    ?>    
</div>