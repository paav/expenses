<?php
/* @var $this ContractorTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contractor Types',
);

$this->menu=array(
	array('label'=>'Create ContractorType', 'url'=>array('create')),
	array('label'=>'Manage ContractorType', 'url'=>array('admin')),
);
?>

<h1>Contractor Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
