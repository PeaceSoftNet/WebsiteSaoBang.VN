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
foreach ($dataProvider as $index => $data) {
    $localModule = AdExtension::getLocalById($data->locality);
    $linkDetail = Yii::app()->createUrl('ad/detail', array('categoryName' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title)));
    $linkPriview = Yii::app()->createUrl('ad/preview', array('categoryName' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title)));
    ?>
    <li>
        <?php
        if ($data->icon) {
            $data->icon = AdExtension::getDataImage($data->icon);
            if (AdExtension::isImage($data->icon)) {
                ?>
                <div class="bl-image">
                    <a href="<?php echo $linkDetail; ?>">
                        <div style="background-size:cover !important; height: 40px; width: 40px; display: block; background-size: 40px 40px; background: url('<?php echo $data->icon; ?>') top no-repeat;">&nbsp;</div>
                    </a>
                </div>
                <?php
            }
        }
        ?>
        <h2 class="title-Br-NewsRv">
            <?php if ($data->isSms) echo '<i class="iconVip">&nbsp;</i>'; ?>
            <span class="cl99"><?php echo $localModule->name; ?>: </span>
            <a class="fl" href="<?php echo $linkDetail; ?>"><?php echo $data->title; ?></a>
        </h2>
        <p class="Br-NewsRv-cont">
            <a href="<?php echo $linkPriview; ?>" rel="facebox" class="text-unline">Xem nhanh</a>
            <span class="gray-clr">• <?php echo GlobalComponents::convertTimeValue($data->createDate); ?> tại <?php echo $data->domain; ?></span>
            <span class="gray-clr">• Mã rao vặt: <?php echo $data->code; ?></span>
        </p>
    </li>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if ($index == 8 && $page == 1) {
        ?>
        <li>
            <div class="box-smsVip clearfix">
                <span class="iconVip">&nbsp;</span>
                <span class="fl">Soạn tin  <b class="clRed">SB  VIP  [Mã rao vặt]</b>  gửi  <span class="clRed">8708</span>  để đăng tin VIP    
                    <a target="_black" href="http://saobang.vn/huong-dan/huong-dan-mua-tin-vip.html">chính sách tin VIP</a> </span>
            </div>
        </li>
        <?php
    } elseif ($index == 24 && rand(1, 7) == 3) {
        echo '<li>' . $this->googleAd() . '</li>';
    }
}