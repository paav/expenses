<?php
// vim: ft=htmlphp

/* @var $this FuelExpenseController */
/* @var $model FuelExpense */
/* @var $fuelsAll Array */
/* @var $contractorsDp CActiveDataProvider */
/* @var $form CActiveForm */
/* @var $df CDateFormatter */
?>
<p><?php
  if ($this->action->id == 'create')
    echo '# Создание расхода на топливо';
  else
    echo '# Редактирование расхода на топливо';
?></p>

<?php $form = $this->beginWidget('CActiveForm', array(
  'htmlOptions'=>array(
    'class'=>'form',
  ),
  'enableAjaxValidation' => false,
)); ?>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'date', array('class'=>'control-label')); ?>
      <?php echo $form->textField($model, 'date', array(
          'class'=>'form-control datesetter',
          'value'=>$df->format('dd.MM.yyyy', $model->date),
        ));
      ?>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($model, 'run', array('class'=>'control-label')); ?>
      <?php echo $form->textField($model, 'run', array('class'=>'form-control')); ?>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($model, 'fuel_id'); ?>
      <?php echo $form->error($model, 'fuel_id'); ?>
      <?php echo $form->dropDownList($model, 'fuel_id', CHtml::listData($fuelsAll,
              'id', 'name'), array('size'=>'10','class'=>'form-control'));
      ?>
    </div>
    <p><a href="<?php echo $this->createAbsoluteUrl('fuel/create');
      ?>">Добавить топливо</a></p>
  </div>
  <div class="col-md-7">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'contractor_id'); ?>
      <?php echo $form->error($model, 'contractor_id'); ?>

      <?php
        $this->widget('ext.paavtable.PaavTable', array(
          'dataProvider'=>$contractorsDp,
          'columns'=>array('name','address','note'),
          'view'=>'components.paavtable-custom.views.table',
          'data'=>array('model'=>$model),
        ));
      ?>

      <a href="<?php
          echo $this->createAbsoluteUrl('contractor/create', array(
            'id'=>Contractor::TYPE_STATION
          ));
        ?>">Добавить заправку</a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'unit_price'); ?>
      <?php echo $form->error($model, 'unit_price'); ?>
      <?php echo $form->numberField($model, 'unit_price',
              array('class'=>'form-control',
                'min'=>'0',
                'max'=>'999999',
                'step'=>'0.01',
                'placeholder'=>'0.00'
              ));
      ?> руб.
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'quantity'); ?>
      <?php echo $form->error($model, 'quantity'); ?>
      <?php echo $form->numberField($model, 'quantity',
              array('class'=>'form-control',
                'min'=>'5',
                'max'=>'999999',
                'step'=>'0.01',
                'placeholder'=>'0.00'
              ));
      ?> литров 
    </div>
  </div>
</div>
<div class="form-group">
  <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать'
    : 'Сохранить', array('class'=>'btn btn-default')); ?>
</div>
<?php $this->endWidget(); ?>
