<?php
/* @var $this ExpenseController */
/* @var $model Expense */
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$partExpensesDp,
    'cssFile'=>yii::app()->baseUrl.'/css/grid-part.css',
    'columns'=>array(
        $checkBoxColumn,
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
        array(
          'class'=>'CLinkColumn',
          'label'=>'',
          'urlExpression'=>function($data){
             return $this->createAbsoluteUrl('partExpense/view',array('id'=>$data->id));
          },
          'linkHtmlOptions'=>array('class'=>'icon-search'),
        ),
        array(
          'class'=>'CLinkColumn',
          'label'=>'',
          'urlExpression'=>function($data){
             return $this->createAbsoluteUrl('partExpense/update',array('id'=>$data->id));
          },
          'linkHtmlOptions'=>array('class'=>'icon-pen'),
        ),
    ),
)); ?> 
