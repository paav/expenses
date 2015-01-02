# vim: ts=2:sw=2:sts=2
<?php yii::app()->clientScript->registerCssFile('http://i.icomoon.io/public/temp/7b7d465304/UntitledProject1/style.css'); ?>

<p>Все расходы</p> 

<?php $this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider'=>$allExpensesDp,
  'nullDisplay'=>'нет',
  'enableSorting'=>false,
  'cssFile'=>Yii::app()->baseUrl.'/css/grid-index.css',
  'columns'=>array(
    /*
    array(
      'id'=>'boundIds',
      'class'=>'CCheckBoxColumn',
      'value'=>'$data->id',
      'checked'=>'($data->bound_id == 19)',
    ),
    */
//    'id',
    array(
      'id'=>'date',
      'name'=>'date',
      'type'=>'date',
      'headerHtmlOptions'=>array('class'=>'date'),
      'htmlOptions'=>array('class'=>'date'),
      'footer'=>'Итого:',
    ),
    array(
      'id'=>'run',
      'name'=>'run',
      'type'=>'run',
      'htmlOptions'=>array('class'=>'run align-right'),
      'headerHtmlOptions'=>array('class'=>'run align-right'),
      'footerHtmlOptions'=>array('class'=>'run align-right'),
      'footer'=>yii::app()->format->run(Expense::getTotalRun($allExpensesDp)),
    ),
    array(
      'id'=>'type',
      'name'=>'type.name',
      'htmlOptions'=>array('class'=>'type'),
      'headerHtmlOptions'=>array('class'=>'type'),
    ),
    array(
      'id'=>'cost',
      'name'=>'cost',
      'type'=>'price', 
      'htmlOptions'=>array('class'=>'cost align-right'),
      'headerHtmlOptions'=>array('class'=>'cost align-right'),
      'footerHtmlOptions'=>array('class'=>'cost align-right'),
      'footer'=>yii::app()->format->price(Expense::getTotalCost($allExpensesDp)),
    ),
    //'quantity',
    //'unit_price',
    array(
      'id'=>'descr',
      'header'=>'Описание',
      'htmlOptions'=>array('class'=>'descr'),
      'headerHtmlOptions'=>array('class'=>'descr'),
      'value'=>function($data){
        switch($data->expense_type_id):
          case Expense::TYPE_JOB:
            return $data->job->name;
          case Expense::TYPE_PART:
            return $data->part->type->name.' '.$data->part->name;   
        endswitch;
      },
    ),
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
