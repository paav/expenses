<?php
/* @var $this FuelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fuels',
);

$this->menu=array(
	array('label'=>'Create Fuel', 'url'=>array('create')),
	array('label'=>'Manage Fuel', 'url'=>array('admin')),
);
?>

<h1>Fuels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
