<?php
/* @var $this ContractorTypeController */
/* @var $model ContractorType */

$this->breadcrumbs=array(
	'Contractor Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContractorType', 'url'=>array('index')),
	array('label'=>'Manage ContractorType', 'url'=>array('admin')),
);
?>

<h1>Create ContractorType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>