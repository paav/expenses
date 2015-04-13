<?php
/* @var $this ContractorHeadController */
/* @var $model ContractorHead */

$this->breadcrumbs=array(
	'Contractor Heads'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContractorHead', 'url'=>array('index')),
	array('label'=>'Create ContractorHead', 'url'=>array('create')),
	array('label'=>'View ContractorHead', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ContractorHead', 'url'=>array('admin')),
);
?>

<h1>Update ContractorHead <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>