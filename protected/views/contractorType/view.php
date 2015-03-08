<?php
/* @var $this ContractorTypeController */
/* @var $model ContractorType */

$this->breadcrumbs=array(
	'Contractor Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ContractorType', 'url'=>array('index')),
	array('label'=>'Create ContractorType', 'url'=>array('create')),
	array('label'=>'Update ContractorType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ContractorType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContractorType', 'url'=>array('admin')),
);
?>

<h1>View ContractorType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
