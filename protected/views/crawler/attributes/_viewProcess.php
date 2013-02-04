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
$model = TopicModel::model()->findByPk($data->id);
if ($model) {
    $doc = new ASolrDocument;
    $doc->id = $data->id;
    $doc->title = $model->title;
    $doc->domain = $model->domain;
    $doc->categoryId = $model->categoryId;
    $doc->childCatId = $model->childCatId;
    $doc->locality = $model->locality;
    $doc->demand = $model->demand;
    $doc->extension1 = $extension1;
    $doc->extension2 = $extension2;
    $doc->extension3 = $extension3;
    $doc->extension4 = $extension4;
    $doc->extension5 = $extension5;
    $doc->site = $model->site;
    $doc->description = $model->description;
    $doc->text = $model->description;
    $doc->save(); // adds the document to solr
    $doc->getSolrConnection()->commit();
}

if ($index % 2) {
    echo '<tr class="odd">';
} else {
    echo '<tr>';
}
?>
<td><strong>#<?php echo $index + 1; ?></strong></td>
<td style="text-align: left;">
    <div class="title">
        <?php
        echo $data->id;
        ?>
    </div>
</td>    
<td style="text-align: left;">
    <?php
    echo '<strong>' . $data->title . '</strong>';
    ?>
</td>
</tr>
