
<?php 
$form = $this->beginWidget('CActiveForm', array(
'id'=>'nomination-info-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
'enableAjaxValidation'=>false,
'htmlOptions'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal',]
)); 
?>

	<?= $this->renderPartial('//../modules/admin/views/nominations/_info_details_1', ['form'=>$form, 'nominator'=>$nominator, 'chapters'=>$chapters]); ?>
	<?= $this->renderPartial('//../modules/admin/views/nominations/_info_details_2', ['form'=>$form, 'nominee'=>$nominee, 'categories'=>$categories, 'subcategories'=>$subcategories]); ?>
	<?= $this->renderPartial('//../modules/admin/views/nominations/_info_details_3', ['form'=>$form, 'nominee_essays'=>$nominee_essays]); ?>
	<?= $this->renderPartial('//../modules/admin/views/nominations/_info_details_4', ['form'=>$form, 'nominee_info'=>$nominee_info, 'countries'=>$countries]); ?>

<?php $this->endWidget(); ?>