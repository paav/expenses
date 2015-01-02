<?php
/* @var $this ExpenseController */
/* @var $model Expense */
Yii::app()->format->dateFormat='d.m.Y';
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'date:date',
		'cost',
        array(
            'label'=>'Магазин',
            'value'=>"{$model->contractor->name} {$model->contractor->street}",
        ),
        'type:text:Тип расхода',
        'part.name:text:Наименование',
	),
)); ?>
<p>Связанные расходы</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$relatedExpenses,
    'columns'=>array(
        'date:date',
        'cost',
        array(
            'header'=>'Магазин',
            'value'=>'$data->contractor->name',
        ),
        'type:text:Тип расхода',
        'job.name:text:Наименование',
    ),
)); ?> 
