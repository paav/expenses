# vim: ft=html:syn=php
<?php
/* @var $this ExpensesController */
/* @var $model Expenses */
/* @var $types Types */
/* @var $contractors Contractors */
/* @var $form CActiveForm */
?>
<p>Расход на запчасть</p>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'expenses-form',
  // Please note: When you enable ajax validation, make sure the corresponding
  // controller action is handling ajax validation correctly.
  // There is a call to performAjaxValidation() commented in generated controller code.
  // See class documentation of CActiveForm for details on this.
  'enableAjaxValidation'=>false,
));
CHtml::$afterRequiredLabel = '';
?>

  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php echo $form->labelEx($model,'date'); ?>
    <?php echo $form->textField($model,'date',array('id'=>'cal','maxlength'=>10)); ?>
    <?php echo $form->error($model,'date'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'cost'); ?>
    <?php echo $form->textField($model,'cost',array('size'=>7, 'maxlength'=>9)); ?><span>руб.</span>
    <?php echo $form->error($model,'cost'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'contractor_id'); ?>
    <?php echo $form->dropDownList($model,'contractor_id',CHtml::listData($contractors, 'id', function($contractor) {
      return "$contractor->name, $contractor->street";
    })); ?>
    <?php echo $form->error($model,'contractor_id'); ?>
  </div>

    <?php echo CHtml::link('Добавить магазин', array('contractor/create'), array('class'=>'button')); ?>

  <div class="row">
    <?php echo $form->labelEx($model,'part_id'); ?>
    <?php echo $form->dropDownList($model,'part_id',CHtml::listData($parts, 'id', function($part) {
      return "$part->name $part->manufacturer $part->part_number";
    })); ?>
    <?php echo $form->error($model,'part_id'); ?>
  </div>

  <?php echo CHtml::link('Редактировать запчаcть', array('part/update/'.$model->part_id), array('class'=>'button')); ?>
  <?php echo CHtml::link('Добавить запчасть', array('part/create'), array('class'=>'button')); ?>

  <div class="row">
    <span class="note">
      <?php echo $form->labelEx($model,'note'); ?>
      <?php echo $form->textArea($model,'note',array('rows'=>5,'cols'=>50,'maxlength'=>240)); ?>
      <?php echo $form->error($model,'note'); ?>
    </span>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'quantity'); ?>
    <?php echo $form->textField($model,'quantity',array('size'=>7, 'maxlength'=>9)); ?><span>шт.</span>
    <?php echo $form->error($model,'quantity'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'unit_price'); ?>
    <?php echo $form->textField($model,'unit_price',array('size'=>7, 'maxlength'=>9)); ?><span>руб.</span>
    <?php echo $form->error($model,'unit_price'); ?>
  </div>

  <div class="row">
    <?php echo CHtml::link('Назад', array('site/index'), array('class'=>'button')); ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'button')); ?>
    <?php if(!$model->isNewRecord): ?>
    <?php echo CHtml::link('Удалить', array('expenses/delete', 'id'=>$model->id), array('class'=>'button')); ?>
    <?php endif; ?>
  </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
