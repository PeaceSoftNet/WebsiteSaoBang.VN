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
$this->pageTitle = 'Quản lý quảng cáo';
$form = $this->beginWidget('CActiveForm', array('id'=>'bannerSubmit'));
$this->breadcrumbs = array(
    'Quản trị thông báo' => array('administrator/notify'),
    'Quản trị quảng cáo' => array('administrator/banner'),
    'Quản trị hỗ trợ' => array('administrator/help'),
    'Tin đã xóa' => array('topic/manager'),
);
?>
<table width="100%">
    <tr>
        <td>
            <div class="form-popup" id="administratorForm">
                <h3><?php echo $this->pageTitle; ?></h3>
                <div class="items">
                    <?php echo $form->labelEx($model, 'img'); ?>
                    <?php echo $form->textField($model, 'img', array('id' => 'fileImg', 'onclick' => 'openFileBrowser("fileImg")')); ?>
                    <?php echo $form->error($model, 'img'); ?>
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'url'); ?>
                    <?php echo $form->textField($model, 'url'); ?>
                    <?php echo $form->error($model, 'url'); ?>
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'position'); ?>
                    <?php echo $form->dropDownList($model, 'position', array('1' => 'Trang chủ', '2' => 'Trang chi tiết')); ?>
                    <?php echo $form->error($model, 'position'); ?>
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'endDate'); ?>
                    <?php
                    echo $form->textField($model, 'endDate', array("id" => "endDate"));

                    $this->widget('application.extensions.calendar.SCalendar', array(
                        'inputField' => 'endDate',
                        'ifFormat' => '%Y-%m-%d %H:%M:%S',
                    ));
                    ?>
                    <?php echo $form->error($model, 'endDate'); ?>
                </div>
                <div class="sumitButton">
                    <?php echo CHtml::submitButton('Cập nhật', array('onclick' => '$("#bannerSubmit").submit();')); ?>
                </div>
            </div>  
        </td>
        <td>
            <div style="width: 100%">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '_banner',
                    'template' => "{items}\n",
                ));
                ?> 
            </div>

        </td>
    </tr>
</table>
<div style="width: 100%">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_banner',
        'template' => "{pager}",
    ));
    ?> 
</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    function openFileBrowser(id){
        fileBrowserlink = "<?php echo Yii::app()->request->baseUrl; ?>/fileBrowser/index.php?editor=standalone&returnID=" + id;
        window.open(fileBrowserlink,'pdwfilebrowser', 'width=1000,height=650,scrollbars=no,toolbar=no,location=no');
    }
</script>