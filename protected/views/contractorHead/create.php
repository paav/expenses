<?php
/* @var $this ContractorHeadController */
/* @var $model ContractorHead */

$this->breadcrumbs=array(
	'Contractor Heads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContractorHead', 'url'=>array('index')),
	array('label'=>'Manage ContractorHead', 'url'=>array('admin')),
);
?>

<h1>Create ContractorHead</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>