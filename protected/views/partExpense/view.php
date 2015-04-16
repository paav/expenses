# vim: ts=2:sts=2:sw=2
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
      'label'=>'Магазин',
      'value'=>"{$model->contractor->head->name}, {$model->contractor->addressr->line1}",
    ),
    array(
      'label'=>'З/часть (расх. мат)',
      'value'=>$model->part->type->name.' '.$model->part->manufacturer
        .' '.$model->part->name.' '.$model->part->part_number,
    ),
    'unit_price:price',
    'quantity:quantity',
		'cost:price',
	),
)); ?>

<p>Эта з/часть (расх. мат) использовалась в следующих работах:</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider'=>$relatedExpensesDp,
  'enableSorting'=>false,
  'cssFile'=>yii::app()->baseUrl.'/css/grid.css',
  'columns'=>array(
    'date:date',
    array(
      'header'=>'Мастерская',
      'value'=>'$data->contractor->head->name.", ".$data->contractor->addressr->line1',
    ),
    'job.name',
    'cost:price',
    array(
      'class'=>'CLinkColumn',
      'label'=>'',
      'urlExpression'=>function($data){
        return $this->createAbsoluteUrl($data->controllerName.'/view',array('id'=>$data->id));
      },
      'linkHtmlOptions'=>array('class'=>'icon-search'),
    ),
    array(
      'class'=>'CLinkColumn',
      'label'=>'',
      'urlExpression'=>function($data){
        return $this->createAbsoluteUrl($data->controllerName.'/update',array('id'=>$data->id));
      },
      'linkHtmlOptions'=>array('class'=>'icon-pen'),
    ),
  ),
)); ?> 
