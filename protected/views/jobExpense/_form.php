# vim: sw=2:ts=2:sts=2
<?php
/* @var $this ExpensesController */
/* @var $model Expenses */
/* @var $types Types */
/* @var $contractors Contractors */
/* @var $form CActiveForm */
?>
<?php yii::app()->clientScript->registerCssFile(yii::app()->baseUrl.'/css/form-my.css'); ?>
<?php yii::app()->clientScript->registerCssFile('http://i.icomoon.io/public/temp/7b7d465304/UntitledProject1/style.css'); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
//  'id'=>'expenses-form',
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

  <div class="row holder">
    <div class="left-column even-height">
      <label>Мастерская</label>
    </div>
    <div class="right-column even-height">
      <table class="selectable">
        <thead>
          <tr>
            <th class="radio"></th>
            <th>Название</th>
            <th>Адрес</th>
            <th>Комментарий</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($contractors as $contractor): ?>
          <tr>
            <td class="radio">
              <?php echo $form->radioButton($model,'contractor_id'); ?>
            </td>
            <td><?php echo $contractor->name; ?></td>
            <td><?php echo $contractor->address; ?></td>
            <td><?php echo $contractor->note; ?></td>
            <td class="link">
              <a href="<?php echo $this->createAbsoluteUrl('contractor/view',array('id'=>$contractor->id)); ?>" class="icon-search"></a>
              <a href="<?php echo $this->createAbsoluteUrl('contractor/update',array('id'=>$contractor->id)); ?>" class="icon-pen"></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php echo CHtml::link('Добавить мастерскую', array('contractor/create/contractorType='.Contractor::TYPE_GARAGE), array('class'=>'')); ?>
    </div>
  </div>

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
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
)); */?> 

  <div class="row holder">
    <div class="left-column even-height">
      <label>Наим. работы</label>
    </div>
    <div class="right-column even-height">
      <?php echo $form->listBox($model,'job_id',CHtml::listData($jobs,'id',function($job) {
          return $job->name;
      })); ?>
      <?php echo $form->error($model,'job_id'); ?>
      <br>
      <?php echo CHtml::link('Добавить работу', array('job/create'), array('class'=>'')); ?>
    </div>
  </div>

  <div class="row">
    <span class="note">
      <?php echo $form->labelEx($model,'note'); ?>
      <?php echo $form->textArea($model,'note',array('rows'=>5,'cols'=>50,'maxlength'=>240,'placeholder'=>'Добавьте коментарий')); ?>
      <?php echo $form->error($model,'note'); ?>
    </span>
  </div>
<?php /*$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$jobsDp,
    'nullDisplay'=>'не указано',
    'columns'=>array(
        array(
            'id'=>'JobExpense[job_id]',
            'class'=>'CCheckBoxColumn',
            'value'=>'$data->id',
        ),
        'name',
    ),
)); */?> 

  <div class="row">
    <?php echo $form->labelEx($model,'cost'); ?>
    <?php echo $form->textField($model,'cost',array('size'=>8,'maxlength'=>7,'placeholder'=>'0.00')); ?>
    <span class="unit">руб.</span>
    <?php echo $form->error($model,'cost'); ?>
  </div>

<?php $getCheckBoxColumnConfig=function($id){
    return array(
        'class'=>'CCheckBoxColumn',
        'selectableRows'=>10,
        'id'=>$id,
        'value'=>'$data->id',
    );
} ?>

<p>Связанные расходы на запчасти</p>
<?php $this->renderPartial('//partExpense/_table',array(
    'checkBoxColumn'=>$getCheckBoxColumnConfig('idsToUnbind'),
    'partExpensesDp'=>$connectedExpensesDp,
)); ?>

<?php echo CHtml::submitButton('Отвязать',array('name'=>'unbind','class'=>'')); ?>

<p>Привязать к этому расходу запчасти</p>
<?php $this->renderPartial('//partExpense/_table',array(
    'checkBoxColumn'=>$getCheckBoxColumnConfig('idsToBind'),
    'partExpensesDp'=>$allExpensesDp,
)); ?>

<?php echo CHtml::submitButton('Привязать',array('name'=>'bind','class'=>'')); ?>
<br>
<?php echo CHtml::link('Добавить расход на запчасть', array('partExpense/create'), array('class'=>'')); ?>
<br>
<br>

  <div class="row">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'')); ?>
    <?php if(!$model->isNewRecord): ?>
    <?php endif; ?>
  </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
