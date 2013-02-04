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
$list = array();
$listLocality = ExtensionClass::getListLocality();

$listMail = Yii::app()->cache->get('email_all_exprot');
if ($listMail === false) {
    $sql = 'SELECT `email`, `createDate` FROM `tbl_user`';
    $command = Yii::app()->db->createCommand($sql);
    $rs = $command->queryAll();

    foreach ($rs as $key => $value) {
        $listMail[$value['email']] = $value['createDate'];
    }
    Yii::app()->cache->set('email_all_exprot', $listMail);
}

foreach ($dataProvider->getData() as $key => $value) {
    if ($value->email) {
        if ($value->locality) {
            $local = $listLocality[$value->locality];
        } else {
            $local = 'Toàn quốc';
        }

        $timeString = isset($listMail[$value->email]) ? $listMail[$value->email] : '';

        if ($timeString) {
            $RegisterDate = date('d/m/Y', strtotime($timeString));
            $list[] = array($value->email, "HTML", "Confirmed", $value->createDate, "Unknown IP Address", '', $local, true, $value->mobileNumber, $RegisterDate, '');
        } else {
            $list[] = array($value->email, "HTML", "Confirmed", date('d/m/Y', strtotime($value->createDate)), "Unknown IP Address", '', $local, false, $value->mobileNumber, '', '');
        }
    }
}

$fp = fopen('data/listEmail' . $zone . '.csv', 'a+');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_all',
    'template' => "\n{pager}",
    'ajaxUpdate' => FALSE,
    'enablePagination' => true,
    'emptyText' => '',
        )
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_all',
    'template' => "{items}",
    'emptyText' => '',
        )
);

header("refresh:5;url=/email/all?TopicSlaveModel_page=" . $page . "&zone=" . $zone);
?>