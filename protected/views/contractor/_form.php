<?php
// vim: ft=htmlphp

/* @var $this ContractorController */
/* @var $model Contractor */
/* @var $form CActiveForm */
?>
<?php yii::app()->clientScript->registerCssFile(yii::app()->baseUrl.'/css/form-my.css'); ?>
<?php yii::app()->clientScript->registerCssFile('http://i.icomoon.io/public/temp/7b7d465304/UntitledProject1/style.css'); ?>

<?php
switch($model->type_id):
	case Contractor::TYPE_STORE:
		$placeholders=[
			'name'=>'Введите название магазина',
			'address'=>'Введите адрес магазина',
			'note'=>'Введите коментарий о магазине',
		];
		break;
	case Contractor::TYPE_GARAGE:
		$placeholders=[
			'name'=>'Введите название мастерской',
			'address'=>'Введите адрес мастерской',
			'note'=>'Введите коментарий о мастерской',
		];
		break;
	case Contractor::TYPE_STATION:
		$placeholders=[
			'name'=>'Введите название заправки',
			'address'=>'Введите адрес заправки',
			'note'=>'Введите коментарий о заправки',
		];
		break;
endswitch;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'expenses-form',
  // Please note: When you enable ajax validation, make sure the corresponding
  // controller action is handling ajax validation correctly.
  // There is a call to performAjaxValidation() commented in generated controller code.
  // See class documentation of CActiveForm for details on this.
  'enableAjaxValidation'=>false,
)); ?>
  <?php echo $form->hiddenField($model,'type_id'); ?>

  <div class="row">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30,'placeholder'=>$placeholders['name'])); ?>
    <?php echo $form->error($model,'name'); ?>
  </div>

  <div class="row">
    <?php $model->city = 'Красноярск'; ?>
    <?php echo $form->labelEx($model,'city'); ?>
    <?php echo $form->textField($model,'city',array('size'=>30,'maxlength'=>30)); ?>
    <?php echo $form->error($model,'city'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'address'); ?>
    <?php echo $form->textArea($model,'address',array('rows'=>3,'cols'=>30,'maxlength'=>50,'placeholder'=>$placeholders['address'])); ?>
    <?php echo $form->error($model,'address'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'note'); ?>
    <?php echo $form->textArea($model,'note',array('rows'=>5,'cols'=>50,'maxlength'=>240,'placeholder'=>$placeholders['note'])); ?>
    <?php echo $form->error($model,'note'); ?>
  </div>

  <div class="row">
    <?php echo CHtml::link('Назад', array('site/index'), array('class'=>'button')); ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'button')); ?>
    <?php if(!$model->isNewRecord): ?>
    <?php echo CHtml::link('Удалить', array('expenses/delete', 'id'=>$model->id), array('class'=>'button')); ?>
    <?php endif; ?>
  </div>
<?php $this->endWidget(); ?>


  <p>Все магазины</p>

  <?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$contractorDp,
    'cssFile'=>yii::app()->getBaseUrl().'/css/grid_contractors.css',
    'columns'=>array(
      'name',
//      'city',
      'address',
      'note', 
      array(
        'class'=>'CLinkColumn',
        'label'=>'',
        'urlExpression'=>function($data){
           return $this->createAbsoluteUrl('contractor/view',array('id'=>$data->id));
        },
        'linkHtmlOptions'=>array('class'=>'icon-search'),
        'headerHtmlOptions'=>array('class'=>'link'),
      ),
      array(
        'class'=>'CLinkColumn',
        'label'=>'',
        'urlExpression'=>function($data){
           return $this->createAbsoluteUrl('contractor/update',array('id'=>$data->id));
        },
        'linkHtmlOptions'=>array('class'=>'icon-pen'),
        'headerHtmlOptions'=>array('class'=>'link'),
      ),
    ),
  )); ?> 

</div><!-- form -->
