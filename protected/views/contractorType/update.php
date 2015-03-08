<?php
/* @var $this ContractorTypeController */
/* @var $model ContractorType */

$this->breadcrumbs=array(
	'Contractor Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContractorType', 'url'=>array('index')),
	array('label'=>'Create ContractorType', 'url'=>array('create')),
	array('label'=>'View ContractorType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ContractorType', 'url'=>array('admin')),
);
?>

<h1>Update ContractorType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>