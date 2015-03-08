<?php
/* @var $this ExpenseTypeController */
/* @var $model ExpenseType */

$this->breadcrumbs=array(
	'Expense Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExpenseType', 'url'=>array('index')),
	array('label'=>'Manage ExpenseType', 'url'=>array('admin')),
);
?>

<h1>Create ExpenseType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>