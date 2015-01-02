<?php
/* @var $this ExpenseController */
/* @var $model Expense */
?>

<?php Yii::app()->clientScript->registerScriptFile(yii::app()->baseUrl.'/js/detail-view.js',CClientScript::POS_END); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'cssFile'=>yii::app()->baseUrl.'/css/detail.css',
	'attributes'=>array(
        'date:date',
        array(
            'label'=>'Мастерская',
            'value'=>$model->contractor->name.', '.$model->contractor->address,
        ),
        'job.name',
        'note',
		'cost:price',
	),
)); ?>

<p>Для этой работы использовались следующие з/части (расх. мат):</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$relatedExpensesDp,
    'cssFile'=>yii::app()->baseUrl.'/css/grid.css',
    'columns'=>array(
        'date:date',
        array(
            'header'=>'Магазин',
            'value'=>'$data->contractor->name.", ".$data->contractor->address',
        ),
        array(
            'header'=>'З/часть (расх. мат)',
            'value'=>'$data->part->type->name." ".$data->part->manufacturer
                ." ".$data->part->name." ".$data->part->part_number',
        ),
        //'part.type.name',
        'unit_price:price',
        'quantity:quantity',
        'cost:price',
    ),
)); ?> 
