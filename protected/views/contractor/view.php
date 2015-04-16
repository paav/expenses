<?php
/* @var $this ContractorController */
/* @var $model Contractor */
?>

<?php Yii::app()->clientScript->registerScriptFile(yii::app()->baseUrl.'/js/detail-view.js',CClientScript::POS_END); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'cssFile'=>yii::app()->baseUrl.'/css/detail.css',
	'attributes'=>array(
		'head.name',
		'addressr.line1',
		'note',
	),
)); ?>
