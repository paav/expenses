<?php
/* @var $this PartTypeController */
/* @var $model PartType */

$this->breadcrumbs=array(
	'Part Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PartType', 'url'=>array('index')),
	array('label'=>'Manage PartType', 'url'=>array('admin')),
);
?>

<h1>Create PartType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>