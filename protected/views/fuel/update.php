<?php
/* @var $this FuelController */
/* @var $model Fuel */

$this->breadcrumbs=array(
	'Fuels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fuel', 'url'=>array('index')),
	array('label'=>'Create Fuel', 'url'=>array('create')),
	array('label'=>'View Fuel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Fuel', 'url'=>array('admin')),
);
?>

<h1>Update Fuel <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>