<?php
/* @var $this ContractorHeadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contractor Heads',
);

$this->menu=array(
	array('label'=>'Create ContractorHead', 'url'=>array('create')),
	array('label'=>'Manage ContractorHead', 'url'=>array('admin')),
);
?>

<h1>Contractor Heads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
