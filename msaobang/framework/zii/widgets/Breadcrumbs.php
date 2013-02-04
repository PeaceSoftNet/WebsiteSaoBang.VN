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

class Breadcrumbs extends CWidget{
	/**
	 * @var string the tag name for the breadcrumbs container tag. Defaults to 'div'.
	 */
	public $tagName='ul';
	/**
	 * @var array the HTML attributes for the breadcrumbs container tag.
	 */
	public $htmlOptions=array();
	/**
	 * @var boolean whether to HTML encode the link labels. Defaults to true.
	 */
	public $encodeLabel=true;
	/**
	 * @var string the first hyperlink in the breadcrumbs (called home link).
	 * If this property is not set, it defaults to a link pointing to {@link CWebApplication::homeUrl} with label 'Home'.
	 * If this property is false, the home link will not be rendered.
	 */
	public $homeLink;
	/**
	 * @var array list of hyperlinks to appear in the breadcrumbs. If this property is empty,
	 * the widget will not render anything. Each key-value pair in the array
	 * will be used to generate a hyperlink by calling CHtml::link(key, value). For this reason, the key
	 * refers to the label of the link while the value can be a string or an array (used to
	 * create a URL). For more details, please refer to {@link CHtml::link}.
	 * If an element's key is an integer, it means the element will be rendered as a label only (meaning the current page).
	 *
	 * The following example will generate breadcrumbs as "Home > Sample post > Edit", where "Home" points to the homepage,
	 * "Sample post" points to the "index.php?r=post/view&id=12" page, and "Edit" is a label. Note that the "Home" link
	 * is specified via {@link homeLink} separately.
	 *
	 * <pre>
	 * array(
	 *     'Sample post'=>array('post/view', 'id'=>12),
	 *     'Edit',
	 * )
	 * </pre>
	 */
	public $links=array();
	/**
	 * @var string the separator between links in the breadcrumbs. Defaults to ' &raquo; '.
	 */
	public $separator=' ';

	/**
	 * Renders the content of the portlet.
	 */
	public function run()
	{
		$i= 10;
                if(empty($this->links))
			return;

		echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
		$links=array();
                $links[]='<li class="home" target="_back" style="z-index:10">'.CHtml::link(Yii::t('zii','Trang chủ'),Yii::app()->createUrl('site/index')).'</li>';
                
		foreach($this->links as $label=>$url)
		{
			$i--;
                        if(is_string($label) || is_array($url)){
                            $currentAction = Yii::app()->controller->id . '/' . Yii::app()->controller->action->id;
                            if(in_array($currentAction, $url)){
                                $links[]='<li class="active" style="z-index:'.$i.'">' . CHtml::link($this->encodeLabel ? CHtml::encode($label) : $label, $url) . '</li>';
                            }else{
                                $links[]='<li style="z-index:'.$i.'">' . CHtml::link($this->encodeLabel ? CHtml::encode($label) : $label, $url) . '</li>';
                            }
                        }else{
                            $links[]='<span>'.($this->encodeLabel ? CHtml::encode($url) : $url).'</span>';
                        }
		}
		echo implode($this->separator,$links);
		echo CHtml::closeTag($this->tagName);
	}
}