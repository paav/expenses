<?php
/* @var $this ContractorController */
/* @var $model Contractor */

$this->breadcrumbs=array(
	'Contractors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contractor', 'url'=>array('index')),
	array('label'=>'Create Contractor', 'url'=>array('create')),
	array('label'=>'View Contractor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Contractor', 'url'=>array('admin')),
);
?>

<h1>Update Contractor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>