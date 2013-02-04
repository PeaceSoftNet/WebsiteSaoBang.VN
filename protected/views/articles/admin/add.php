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
$this->pageTitle = 'Quản lý sản phẩm';

$this->breadcrumbs = array(
    'Quản trị sản phẩm' => array('articles/add'),
    'Chiến lược marketing' => array('marketing/demand'),
);

$form = $this->beginWidget('CActiveForm', array('id' => 'newArticlesForm'));
?>
<h3><?php echo $this->pageTitle; ?></h3>
<table width="100%">
    <tr>
        <td>
            <div class="form-popup">
                <div class="items">
                    <?php echo $form->labelEx($model, 'title'); ?>
                    <?php echo $form->textField($model, 'title'); ?>
                    <div id="errorSummary" class="errorMessage">
                        <?php echo $form->error($model, 'title'); ?>
                    </div>            
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'avata'); ?>
                    <?php echo $form->textField($model, 'avata', array('id' => 'fileImg', 'onclick' => 'openFileBrowser("fileImg")')); ?>    
                    <?php echo $form->error($model, 'avata'); ?>            
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'budget'); ?>
                    <?php echo $form->textField($model, 'budget'); ?>            
                    <?php echo $form->error($model, 'budget'); ?>            
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'description'); ?>
                    <?php echo $form->textArea($model, 'description', array('cols' => '86', 'rows' => '5')); ?>
                    <?php echo $form->error($model, 'description'); ?>
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'content'); ?>
                    <?php echo $form->textArea($model, 'content', array('id' => 'area1', 'cols' => '86', 'rows' => '15')); ?>
                    <?php echo $form->error($model, 'content'); ?>
                </div>
                <div class="items">
                    <?php
                    if ($model->beginTime)
                        $model->beginTime = date('d-m-Y', $model->beginTime);
                    ?>
                    <?php echo $form->labelEx($model, 'beginTime'); ?>
                    <?php echo $form->textField($model, 'beginTime', array('id' => 'beginTime')); ?>
                </div>
                <?php
                $this->widget('application.extensions.calendar.SCalendar', array(
                    'inputField' => 'beginTime',
                    'ifFormat' => '%d-%m-%Y',
                ));
                ?>
                <div class="items">
                    <?php
                    if ($model->endTime)
                        $model->endTime = date('d-m-Y', $model->endTime);
                    ?>
                    <?php echo $form->labelEx($model, 'endTime'); ?>
                    <?php echo $form->textField($model, 'endTime', array('id' => 'endTime')); ?>
                </div>
                <?php
                $this->widget('application.extensions.calendar.SCalendar', array(
                    'inputField' => 'endTime',
                    'ifFormat' => '%d-%m-%Y',
                ));
                ?>
                <div class="sumitButton">
                    <?php echo CHtml::submitButton('Cập nhật'); ?>
                </div>
            </div>
            <div class="clear"></div>
        </td>
        <td>
            <div style="width: 100%;">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => 'admin/_add',
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
        'itemView' => 'admin/_add',
        'ajaxUpdate' => false,
        'pager' => array(
            'header' => 'page',
        ),
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