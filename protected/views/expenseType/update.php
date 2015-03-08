<?php
/* @var $this ExpenseTypeController */
/* @var $model ExpenseType */

$this->breadcrumbs=array(
	'Expense Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExpenseType', 'url'=>array('index')),
	array('label'=>'Create ExpenseType', 'url'=>array('create')),
	array('label'=>'View ExpenseType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExpenseType', 'url'=>array('admin')),
);
?>

<h1>Update ExpenseType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>