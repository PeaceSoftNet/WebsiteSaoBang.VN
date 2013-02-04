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
?>
<div class="askBuy-same block">
    <div class="mod-tit">Hỏi mua tương tự</div>
    <ul>
        <?php
        $count = 0;
        foreach ($result->response->docs as $doc) {
            $id = isset($doc->id) ? $doc->id : 0;
            if ($id != $askId) {
                $count++;
                $askData = Yii::app()->cache->get('askModel_byId_' . $id);
                if ($askData === false) {
                    $askData = AskModel::model()->findByPk($id);
                    Yii::app()->cache->set('askModel_byId_' . $id, $askData, 60 * 60);
                }
                if (isset($askData->isAuth)) {
                    ?>
                    <li>
                        <p><b><?php echo GlobalComponents::hiddenEmail($askData->email); ?></b> <span class="hint">• <?php echo GlobalComponents::convertTimeValue($askData->createDate); ?> </span></p>
                        <p><a href="<?php echo Yii::app()->createUrl('ask/detail', array('id' => $askData->id, 'title' => ExtensionClass::utf8_to_ascii($askData->title))); ?>"><?php echo $askData->title; ?></a></p>
                        <p class="fs11">Có <b><?php echo $askData->visit; ?></b> lượt xem - <b><?php echo $askData->report; ?></b> Báo giá</p>
                    </li>
                    <?php
                }
            }
        }
        if ($count == 0) {
            echo '<li>Không có hỏi mua nào tương tự</li>';
        }
        ?>
    </ul>
</div>