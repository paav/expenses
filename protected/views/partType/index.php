<?php
/* @var $this PartTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Part Types',
);

$this->menu=array(
	array('label'=>'Create PartType', 'url'=>array('create')),
	array('label'=>'Manage PartType', 'url'=>array('admin')),
);
?>

<h1>Part Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
