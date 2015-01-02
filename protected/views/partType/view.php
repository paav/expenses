<?php
/* @var $this PartTypeController */
/* @var $model PartType */

$this->breadcrumbs=array(
	'Part Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PartType', 'url'=>array('index')),
	array('label'=>'Create PartType', 'url'=>array('create')),
	array('label'=>'Update PartType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PartType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PartType', 'url'=>array('admin')),
);
?>

<h1>View PartType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
