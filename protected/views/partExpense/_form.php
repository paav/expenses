# vim: ts=2:sw=2:sts=2
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

  <div class="row holder">
    <div class="left-column even-height">
      <label for="for">Магазин</label>
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
              <?php echo $form->radioButton($model,'contractor_id',array('value'=>$contractor->id,'uncheckValue'=>null)); ?>
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
      <?php echo CHtml::link('Добавить магазин', array('contractor/create'), array('class'=>'')); ?>
    </div>
  </div>

  <div class="row holder">
    <div class="left-column even-height">
        <label>Запчасть</label>
    </div>
    <div class="right-column even-height">
      <?php echo $form->listBox($model,'part_id',CHtml::listData($parts,'id',function($part) {
          return $part->type->name . ' ' . $part->manufacturer . ' ' . $part->name . ' ' . $part->part_number;
      })); ?>
      <?php echo $form->error($model,'part_id'); ?>
      <br>
      <?php echo CHtml::link('Добавить запчасть', array('part/create'), array('class'=>'')); ?>
    </div>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'unit_price'); ?>
    <?php echo $form->textField($model,'unit_price',array('size'=>8, 'maxlength'=>7)); ?>
    <span class="unit">руб.</span>
    <?php echo $form->error($model,'unit_price'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'quantity'); ?>
    <?php echo $form->numberField($model,'quantity',array('min'=>0,'max'=>1000,'step'=>'any','style'=>'width:5em')); ?>
    <span class="unit">шт.</span>
    <?php echo $form->error($model,'quantity'); ?>
  </div>

  <div class="row">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'')); ?>
    <?php if(!$model->isNewRecord): ?>
    <?php echo CHtml::link('Удалить', array('expenses/delete', 'id'=>$model->id), array('class'=>'')); ?>
    <?php endif; ?>
  </div>

<div class="right-column">
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

</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
