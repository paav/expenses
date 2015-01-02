# vim: ft=html:syn=php
<?php
/* @var $this ExpensesController */
/* @var $model Expenses */
/* @var $types Types */
/* @var $contractors Contractors */
/* @var $form CActiveForm */
?>

<?php yii::app()->clientScript->registerCssFile(yii::app()->baseUrl.'/css/form-my.css'); ?>

<div class="form">

  <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'expenses-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
  ));
  ?>

  <?php CHtml::$afterRequiredLabel = ''; ?>
  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php echo $form->labelEx($model,'part_type_id'); ?>
    <?php echo $form->dropDownList($model,'part_type_id',CHtml::listData($partTypes,'id','name'),array('prompt'=>'Выберите тип')); ?>
    <?php echo $form->error($model,'part_type_id'); ?>
    <?php echo CHtml::link('Добавить тип', array('partType/create'), array('class'=>'')); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textArea($model,'name',array('maxlength'=>255,'rows'=>2,'cols'=>30,'placeholder'=>'Например, Mobil 1 0W-40 4л')); ?>
    <?php echo $form->error($model,'name'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'part_number'); ?>
    <?php echo $form->textField($model,'part_number',array('maxlength'=>50,'placeholder'=>'Укажите артикул')); ?><span></span>
    <?php echo $form->error($model,'part_number'); ?>
  </div>

  <div class="row">
    <span class="note">
      <?php echo $form->labelEx($model,'note'); ?>
      <?php echo $form->textArea($model,'note',array('rows'=>5,'cols'=>50,'maxlength'=>240,'placeholder'=>'Добавьте коментарий')); ?>
      <?php echo $form->error($model,'note'); ?>
    </span>
  </div>

  <div class="row">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'')); ?>
    <?php if(!$model->isNewRecord): ?>
    <?php echo CHtml::link('Удалить', array('expenses/delete', 'id'=>$model->id), array('class'=>'')); ?>
    <?php endif; ?>
  </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
