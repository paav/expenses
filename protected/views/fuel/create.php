<?php
/* @var $this FuelController */
/* @var $model Fuel */

$this->breadcrumbs=array(
	'Fuels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fuel', 'url'=>array('index')),
	array('label'=>'Manage Fuel', 'url'=>array('admin')),
);
?>

<h1>Create Fuel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>