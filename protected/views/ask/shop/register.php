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
$this->pageTitle = 'Người bán đăng ký';
$form = $this->beginWidget('CActiveForm', array('id' => 'registerShop'));
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="clearfix">
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>" >Hỏi mua</a></li>
                    <li><a href="javascript:void(0);" class="active"><?php echo $this->pageTitle; ?></a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <div class="clear"></div>
        <?php $this->listShopViewColum(); ?>
        <div class="grid_9">

            <div class="title-page">
                <h1>Đăng ký người bán đảm bảo</h1>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        <?php echo $form->labelEx($model, 'name', array('class' => 'title')); ?>
                        <span class="Notes">(hoặc cửa hàng, nhà cung cấp)</span>
                        <?php echo $form->error($model, 'name', array('class' => 'report-error')); ?>
                    </div>                    
                    <?php echo $form->textField($model, 'name', array('class' => 'inp-sminfo')); ?>
                </div>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        <?php echo $form->labelEx($model, 'logo'); ?>
                        <span class="Notes">logo của nhà cung cấp hoắc sản phẩm</span>
                        <?php echo $form->error($model, 'logo', array('class' => 'report-error')); ?>
                    </div>
                    <?php echo $form->textField($model, 'logo', array('class' => 'inp-sminfo')); ?>
                </div>

            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="fl">
                        <div class="title">
                            <?php echo $form->labelEx($model, 'email'); ?>
                            <span class="Notes">(cách nhau bởi dấu ;)</span>
                        </div>
                        <?php echo $form->textField($model, 'email', array('class' => 'inp-sminfo')); ?>
                    </div>
                    <span style="margin:40px 10px 0;display:block;float:left">&nbsp;</span>
                    <div class="fr">
                        <div class="title">
                            Di động
                            <?php echo $form->error($model, 'email', array('class' => 'report-error')); ?>
                        </div>
                        <?php echo $form->textField($model, 'phone', array('class' => 'inp-sminfo floatOnly', 'style' => 'width: 390px;')); ?>
                    </div>
                </div>                
            </div>
            <p style="padding-left: 10px;">
                <?php echo $form->checkBox($model, 'isSMS', array('id' => 'isSMS')); ?><label for="isSMS">Tôi muốn đăng ký nhận tin hỏi mua qua sms</label>
            </p>
            <div class="sm-forminfo clearfix">        
                <div class="cont">
                    <?php echo $form->labelEx($model, 'description', array('class' => 'title')); ?>
                    <?php echo $form->textArea($model, 'description', array('class' => 'tarea-sminfo')); ?>
                </div>
                <?php echo $form->error($model, 'description', array('class' => 'report-error')); ?>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <?php echo $form->labelEx($model, 'url', array('class' => 'title')); ?>
                    <?php echo $form->textField($model, 'url', array('class' => 'inp-sminfo')); ?>
                </div>
                <?php echo $form->error($model, 'url', array('class' => 'report-error')); ?>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <?php echo $form->labelEx($model, 'address', array('class' => 'title')); ?>
                    <?php echo $form->textField($model, 'address', array('class' => 'inp-sminfo')); ?>
                </div>
                <?php echo $form->error($model, 'address', array('class' => 'report-error')); ?>
            </div>
            <style type="text/css">
                .dropdown-local select{height: 30px; line-height: 30px; width: 200px;}
                .dropdown-local select option{padding: 5px 10px;}
                div.report-error{width: 280px !important;}
                .submitButtonTag{width: 120px !important; height: 22px; line-height: 22px; border: 1px solid #666; background: #ccc; font-weight: 700; cursor: pointer;}
            </style>            
            <div class="dropdown-local">
                <div class="cont">
                    <?php
                    echo $form->labelEx($model, 'zone') . '<br />';
                    $listLocalArr = ExtensionClass::getListLocality();
                    $listLocalArr[0] = 'Toàn quốc';
                    echo $form->dropDownList($model, 'zone', $listLocalArr);
                    ?>
                </div>
            </div>   
            <br />
            <h4>Chọn danh mục ngành hàng</h4>
            <div class="sm-forminfo clearfix  no-mg" style="width: 700px; display: block; border: 0; overflow: auto; height: 250px;">
                <div class="cont">
                    <ul class="check-seller clearfix">
                        <?php
                        foreach ($listShopCategory as $index => $data) {
                            $isChecked = '';
                            if ($model->category) {
                                $categoryArr = json_decode($model->category);
                                if (in_array($data->id, $categoryArr)) {
                                    $isChecked = 'checked="checked"';
                                }
                            }
                            ?>
                            <li>
                                <div class="check"><input <?php echo $isChecked; ?> type="checkbox" name="ShopModel[category][]" value="<?php echo $data->id; ?>" id="box_<?php echo $data->id; ?>" /></div>
                                <div class="seller" style="width: 280px;">
                                    <label for="box_<?php echo $data->id; ?>"><?php echo $data->name; ?></label>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        <?php echo $form->labelEx($modelIdentify, 'content', array('class' => 'title')); ?>
                        <span class="Notes">Tên các loại sản phẩm, dòng sản phẩm, hoặc mã sản phẩm</span>
                    </div>
                    <?php echo $form->textArea($modelIdentify, 'content', array('class' => 'tarea-sminfo')); ?>
                </div>
            </div>            
            <div class="grayModule">
                <div class="clearfix">
                    <span class="fl" style="margin-top: 8px;"><?php echo $form->checkBox($model, 'checkBoxRules', array('id' => 'rulesOkie')); ?><label for="rulesOkie"><code style="color: red;" title="Bắt buộc">*</code> Tôi chấp nhận các <a target="_black" href="<?php echo Yii::app()->createUrl('home/publishedRules'); ?>">Điều khoản và Quy định</a> của SaoBăng.vn</label></span>
                    <a class="org-btn fr" onclick="$('#registerShop').submit();" href="javascript:void(0);"><span>Đăng hỏi mua</span></a>
                </div>
            </div>
            <div style="clear: both;"> </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
