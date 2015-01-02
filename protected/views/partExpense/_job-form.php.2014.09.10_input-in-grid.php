<?php
/* @var $this ExpensesController */
/* @var $model Expenses */
/* @var $types Types */
/* @var $contractors Contractors */
/* @var $form CActiveForm */
?>

<p>Расход на ремонт</p>

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
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
        'attribute'=>'date',
        'model'=>$model,
        'options'=>array(
          'dateFormat'=>'dd.mm.yy',
        ),
        'htmlOptions'=>array(
            'size'=>8,
            'maxlength'=>10,
            'value'=>CTimestamp::formatDate('d.m.Y'),
      ),
    )); ?>
    <?php echo $form->error($model,'date'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'run'); ?>
    <?php echo $form->textField($model,'run',array('size'=>8, 'maxlength'=>7)); ?>
    <span class="unit">км</span>
    <?php echo $form->error($model,'run'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'cost'); ?>
    <?php echo $form->textField($model,'cost',array('size'=>8, 'maxlength'=>7)); ?>
    <span class="unit">руб.</span>
    <?php echo $form->error($model,'cost'); ?>
  </div>

<p>Выберите мастерскую</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$contractorsDp,
    'nullDisplay'=>'не указано',
    'columns'=>array(
        array(
            'id'=>'JobExpense[contractor_id]',
            'class'=>'CCheckBoxColumn',
            'value'=>'$data->id',
        ),
        'name',
        'street',
        'building',
    ),
)); ?> 

<p>Выберите наименование работы</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$jobsDp,
    'nullDisplay'=>'не указано',
    'selectableRows'=>2,
    'columns'=>array(
        array(
            'id'=>'Job[selectedIds]',
            'class'=>'CCheckBoxColumn',
            'value'=>'$data->id',
        ),
        'name',
        array(
            'type'=>'raw',
            'header'=>'Стоимость работы',
            'value'=>'CHtml::textField("Job[costs][]")',
        ),
    ),
)); ?> 

<p>Связать этот расход с расходами на запчасти</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$expensesDp,
    'nullDisplay'=>'не указано',
    'columns'=>array(
        array(
            'class'=>'CCheckBoxColumn',
            'value'=>'$data->id',
        ),
        'date:date',
        'cost',
        'part.name',
    ),
)); ?> 

  <div class="row">
    <span class="note">
      <?php echo $form->labelEx($model,'note'); ?>
      <?php echo $form->textArea($model,'note',array('rows'=>5,'cols'=>50,'maxlength'=>240)); ?>
      <?php echo $form->error($model,'note'); ?>
    </span>
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
