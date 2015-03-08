# vim: ts=2:sts=2:sw=2
<?php
/* @var $this ExpenseController */
/* @var $model Expense */
?>

<?php Yii::app()->clientScript->registerScriptFile(yii::app()->baseUrl.'/js/detail-view.js',CClientScript::POS_END); ?>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
  'cssFile'=>yii::app()->baseUrl.'/css/detail.css',
	'attributes'=>array(
    'date:date',
    array(
      'label'=>'Заправка',
      'value'=>"{$model->contractor->name}, {$model->contractor->address}",
    ),
    array(
      'label'=>'Марка',
      'value'=>$model->fuel->name,
    ),
    'unit_price:price',
    'quantity:quantity',
		'cost:price',
	),
));
?>
