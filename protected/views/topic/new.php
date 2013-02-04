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
$this->pageTitle = 'Đăng rao vặt';
$form = $this->beginWidget('CActiveForm', array('id' => 'topicSubmitForm'));
if (!$model->email)
    $model->email = Yii::app()->session['email'];
$listCategory = ExtensionClass::getCategoryChildByParentCat($model->categoryId);

$this->renderPartial('uploadImg');
?>

<?php
echo CHtml::css('#facebox .content{width: auto !important;}');
?>
<div class="grid_9">

    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a class="active" href="<?php echo Yii::app()->createUrl('topic/new'); ?>">Đăng tin</a></li>
        </ul>
    </div>
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <div class="title">
                Tiêu đề <code style="color: red;" title="Bắt buộc">*</code>
                <span class="Notes">Tối đa 140 ký tự: <span id="titleCharNumber">0</span>/140</span>
            </div>
            <?php echo $form->textField($model, 'title', array('class' => 'inp-sminfo')); ?>
        </div>
    </div>
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <div class="fl">
                <div class="title">
                    Email
                    <code style="color: red;" title="Bắt buộc">*</code>
                    <?php
                    if (!Yii::app()->session['userId']) {
                        echo '<span class="Notes">Hoặc <a rel="Chienlv-Login-Ajax" href="' . Yii::app()->createUrl('user/login') . '">Đăng nhập</a></span>';
                    }
                    ?>
                </div>
                <?php echo $form->textField($model, 'email', array('class' => 'inp-sminfo')); ?>
            </div>
            <div class="fr">
                <div class="title">
                    <label for="TopicModel_mobileNumber">Số điện thoại</label>
                </div>
                <?php echo $form->textField($model, 'mobileNumber', array('class' => 'inp-sminfo floatOnly')); ?>
            </div>
        </div>
        <?php //echo $form->error($model, 'email', array('class' => 'report-error')); ?>
    </div>
    <div class="boxModule edt-user">
        <h4 class="title" title="Tối thiểu 100 ký tự">Nội dung
            <code style="color: red;" title="Bắt buộc">*</code>
        </h4>   
        <?php echo $form->textArea($modelDetail, 'content', array('id' => 'area1', 'cols' => '86', 'rows' => '15')); ?>
        <?php //echo $form->error($modelDetail, 'content', array('class' => 'report-error')); ?>
    </div>
    <div id="ajxContent">    
        <div class="sm-forminfo sltCateg clearfix">
            <div class="cont">
                <div class="fl">
                    <div class="title">Danh mục <code style="color: red;" title="Bắt buộc">*</code></div>
                    <div class="wrap">
                        <?php $this->widget('zii.widgets.CMenu', ExtensionClass::listCategoryParent($model->categoryId)); ?>
                        <?php echo $form->hiddenField($model, 'categoryId'); ?>
                    </div>
                </div>
                <div class="fr">
                    <div class="title">Danh mục con <code style="color: red;" title="Bắt buộc">*</code></div>
                    <div class="wrap scroll">
                        <div id="childrentCategory">
                            <?php $this->widget('zii.widgets.CMenu', ExtensionClass::listCategoryChild($model->categoryId, $model->childCatId)); ?>
                            <?php echo $form->hiddenField($model, 'childCatId'); ?>
                        </div>
                    </div>
                    <?php
                    $demandvalue = ExtensionClass::getDemandByCategory($model->categoryId);
                    if ($demandvalue) {
                        echo '<div class="title">Nhu cầu:</div><div class="wrap" id="demandform"><ul>';
                        foreach ($demandvalue as $dkey => $dvalue) {
                            if ($dkey == $model->demand) {
                                echo '<li class="active"><a id="ded' . $dkey . '" onclick="setDemand(' . $model->categoryId . ', ' . $model->childCatId . ',' . $dkey . ')" href="javascript:void(0);">' . $dvalue . '</a></li>';
                            } else {
                                echo '<li><a id="ded' . $dkey . '" onclick="setDemand(' . $model->categoryId . ', ' . $model->childCatId . ',' . $dkey . ')" href="javascript:void(0);">' . $dvalue . '</a></li>';
                            }
                        }
                        echo '</ul></div>';
                        echo $form->hiddenField($model, 'demand');
                    }
                    ?>
                </div>
            </div>
            <div id="category_required" class="report-error none"><code style="color: red;" title="Bắt buộc">*</code> Danh mục không được bỏ trống</div>
        </div>   
        <?php
        $attrArr = ExtensionClass::getListAttributesAjax($model->categoryId);
        $attrArrChild = ExtensionClass::getListAttributesAjax($model->childCatId);
        /**
         * list extension by category parent
         * listPropertyborder
         */
        if ($attrArr || $attrArr) {
            echo '<div class="sm-forminfo">
                        <ul class="clearfix"> ';
            $num = 0;
            if ($attrArr) {
                foreach ($attrArr as $key => $value) {
                    $num++;
                    if ($num <= 5) {
                        $extension = 'extension' . $num;
                        echo '<li class="z-id99"><div class="sltboxnone"><a class="slted" href="javascript:void(0);"><strong>' . $value['name'] . '</strong></a>';
                        echo $form->radioButtonList($model, $extension, $value['attr'], array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;'));
                        echo '</div></li>';
                    }
                }
            }

            /**
             * list extension by category child
             */
            if ($attrArrChild) {
                foreach ($attrArrChild as $keyChild => $valueChild) {
                    $num++;
                    if ($num <= 5) {
                        $extension = 'extension' . $num;
                        echo '<li class="z-id99"><div class="sltboxnone">
                <a class="slted" href="javascript:void(0);"><strong>' . $valueChild['name'] . '</strong></a>';
                        echo $form->radioButtonList($model, $extension, $valueChild['attr'], array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;'));
                        echo '</div></li>';
                    }
                }
            }
            echo '</ul><div class="report-error"></div></div>';
        }
        ?>
        <?php
        $categoryStatus = ExtensionClass::getTopicByCategoryStatus($model->categoryId);
        if (isset($categoryStatus['isPrice'])) {
            if ($categoryStatus['isPrice'] == 1) {
                ?>
                <div class="sm-forminfo clearfix">
                    <div class="cont">
                        <div class="title">
                            <?php echo $form->labelEx($model, 'price'); ?>
                            <span class="Notes" id="prePrice">Đơn vị: VNĐ</span>
                        </div>
                        <?php
                        echo $form->textField($model, 'price', array('class' => 'inp-sminfo', 'onkeyup' => '$.priceFormat(this);'));
                        ?>
                    </div>
                    <div class="report-error"></div>
                </div>
                <?php
            }
        }
        ?>
        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="fl">
                    <div class="title"><?php echo $form->labelEx($model, 'locality'); ?></div>            
                    <div class="sltbox">
                        <a class="slted" onclick="showDropDown('dropLocalTopic', '_dropLocaltopic');" href="javascript:void(0);" id="topicLocalName">
                            <?php
                            $listLocalArr = ExtensionClass::getListLocality();
                            if ($model->locality) {
                                echo $listLocalArr[$model->locality];
                            } else {
                                echo 'Toàn quốc';
                            }
                            ?>
                        </a>
                        <input type="hidden" name="dropdownfucntion" value="1" id="dropLocalTopic" />
                        <div id="_dropLocaltopic" class="none">
                            <div class="sub-sltbox">
                                <div class="scroll-auto inner-sub-sltbox">
                                    <?php $this->widget('zii.widgets.CMenu', ExtensionClass::topicLocality()); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="report-error"></div>
        </div>
        <div id="localityAjax">
            <?php echo $form->hiddenField($model, 'locality'); ?>
            <?php
            if (isset($categoryStatus['isChildLocality'])) {
                if ($categoryStatus['isChildLocality'] && $model->locality) {
                    /**
                     * list child locality
                     */
                    $listLocality = ExtensionClass::getChildLocality($model->locality);
                    if (isset($listCurrLocality['localityId'])) {
                        $modelTopicLocality->localityId = $listCurrLocality['localityId'];
                    } else {
                        $modelTopicLocality->localityId = ExtensionClass::getChildLocalityByTopic($model->id);
                    }

                    if ($listLocality) {
                        ?>
                        <div class="sm-forminfo clearfix">
                            <div class="check-all-loal" id="checkAll123"><a onclick="checkAllLocal();" href="javascript:void(0);">Chọn tất cả</a></div>
                            <div class="cont list-child-local grayModule">
                                <?php
                                $conShow = 'style="display: block"';
                                echo '<div class="localityItems" ' . $conShow . '>';
                                echo $form->checkBoxList($modelTopicLocality, 'localityId', $listLocality, array('separator' => '', 'template' => '<div class="child-local">{input}&nbsp;{label} &nbsp;&nbsp;</div>'));
                                echo '</div>';
                                ?>
                            </div>        
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <div id="top-message">
        <?php if ($form->errorSummary($model) OR $form->errorSummary($modelDetail)): ?>
            <div class="msg-error">
                <?php
                echo $form->errorSummary($model);
                echo $form->errorSummary($modelDetail);
                ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
    $model->site = 25;
    echo $form->hiddenField($model, 'site');
    $model->domain = 'Saobang.vn';
    echo $form->hiddenField($model, 'domain');
    ?>
    <?php if (extension_loaded('gd')): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model, 'verifyCode'); ?>
            </div>
            <div class="hint">Vui lòng nhập các ký tự xác thực ở hình bên!</div>
        </div>
    <?php endif; ?>
    <div class="grayModule">
        <div class="clearfix">
            <span class="fl" style="margin-top: 8px;"><?php echo $form->checkBox($model, 'checkBoxRules', array('id' => 'rulesOkie')); ?><label for="rulesOkie"><code style="color: red;" title="Bắt buộc">*</code> Tôi chấp nhận các <a target="_black" href="<?php echo Yii::app()->createUrl('home/publishedRules'); ?>">Điều khoản và Quy định</a> của SaoBăng.vn</label></span>
            <a class="btn-postNews fr" onclick="$('#topicSubmitForm').submit()" href="javascript:void(0);"><span>Đăng rao vặt</span></a>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">   
    $(document).ready(function() {  
        var titleLength = $('#TopicModel_title').val().length;
        $('#titleCharNumber').html(titleLength);
        //process key
        $('#TopicModel_title').keyup(function(){
            var lengNumber = this.value.length;
            $('#titleCharNumber').html(lengNumber);
        });
        
    });
    function getParentCategory(categoryId){
        $('.wrap .active').removeAttr('class');//remove select
        $('#cat'+categoryId).parent().addClass('active');//new select
        $('#childrentCategory').html('<center><img src="/themes/homepage/pictures/loading.gif"></center>');
        $('#ajxContent').load('<?php echo Yii::app()->createUrl('topic/new'); ?> #ajxContent', {'categoryId': categoryId});
    }
    /**
     * insert image to editor
     * 
     **/
    function insertImg(srcImg, textId){
        var contentIsert = '';
        var comment = $('#'+textId).val();
        if(comment == 'Nội dung ảnh ...') comment = '';
        contentIsert = '<div class="boxModule clearfix"><div class="dt-showimg"><div class="image"><img style="max-width: 600px" src="'+srcImg+'"><span class="bdt-t">&nbsp;</span><span class="bdt-l">&nbsp;</span><span class="bdt-b">&nbsp;</span><span class="bdt-r">&nbsp;</span><div class="txtimg"><div class="inner-txtimg"><h4>'+comment+'</h4><span class="bdt-t">&nbsp;</span><span class="bdt-l">&nbsp;</span><span class="bdt-b">&nbsp;</span><span class="bdt-r">&nbsp;</span></div></div></div></div></div><div style="clear:both"></div>';
        tinyMCE.execCommand('mceInsertContent',false,contentIsert);
        return false;
    }
    /**
     *  function set locality
     */
    function setTopicLocality(localId, localName){
        $('#_dropLocaltopic').removeAttr('style');
        $('#topicLocalName').html(localName);
        var categoryId = $('#TopicModel_categoryId').val();
        $('#localityAjax').load('<?php echo Yii::app()->createUrl('topic/new'); ?> #localityAjax', {'categoryId':categoryId, 'localityId': localId});
    }
    
    /**
     * set demand
     **/
    function setDemand(catId, childCat, dvalue){
        $('#demandform .active').removeAttr('class');//remove select
        $('#ded'+dvalue).parent().addClass('active');//new select
        $('#TopicModel_demand').val(dvalue);
    }
    /**
     * set child category
     **/
    function setChildCat(catId, childCat){
        $('#demandform .active').removeAttr('class');//remove select
        $('#childcat'+childCat).parent().addClass('active');//new select
        $('#ajxContent').load('<?php echo Yii::app()->createUrl('topic/new'); ?> #ajxContent', {'categoryId': catId, 'childCatId':childCat});
    }
    /**
     * check all local
     */
    function checkAllLocal(){
        $("input[name='TopicLocalityModel[localityId][]']").each(function(){this.checked = true;});
        $('#checkAll123').html('<a onclick="uncheckAllLocal();" href="javascript:void(0);">Bỏ chọn tất cả</a>');
    }
    function uncheckAllLocal(){
        $("input[name='TopicLocalityModel[localityId][]']").each(function(){this.checked = false;});
        $('#checkAll123').html('<a onclick="checkAllLocal();" href="javascript:void(0);">Chọn tất cả</a>');
    }
    /**
     * remove img
     */
    function removeImg(valId){
        $('#imgArea'+valId).remove();
        var i = $('#number_countimg').val();
        i--;
        $('#number_countimg').val(i);
    }
</script>