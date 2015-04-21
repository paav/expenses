<?php
// vim: ft=htmlphp

/* @var $this PartExpenseController */
/* @var $model PartExpense */
/* @var $partsAll Array */
/* @var $partsDp CActiveDataProvider */
/* @var $form CActiveForm */
/* @var $df CDateFormatter */
?>
<p><?php
  if ($this->action->id == 'create')
    echo '# Создание расхода на запчасть';
  else
    echo '# Редактирование расхода на запчасть';
?></p>
<?php $form = $this->beginWidget('CActiveForm', array(
  'htmlOptions'=>array(
    'class'=>'form',
  ),
  'enableAjaxValidation' => false,
)); ?>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <?php
        echo $form->labelEx($model, 'date', array('class'=>'control-label'));
      ?>
      <?php echo $form->textField($model, 'date', array(
          'class'=>'form-control datesetter',
          'value'=>$df->format('dd.MM.yyyy', $model->date),
        ));
      ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'part_id'); ?>
      <?php echo $form->error($model, 'part_id'); ?>

      <?php
        $this->widget('ext.paavtable.PaavTable', array(
          'dataProvider'=>$partsDp,
          'view'=>'components.paavtable-custom.views.table-parts',
          'data'=>array('model'=>$model),
          'columns'=>array('type.name', 'manufacturer', 'name', 'part_number')
        ));
      ?>

      <a href="<?php echo $this->createAbsoluteUrl('part/create');
        ?>">Добавить запчасть</a>
    </div>

    <div class="form-group">
      <?php echo $form->labelEx($model, 'contractor_id'); ?>
      <?php echo $form->error($model, 'contractor_id'); ?>

      <?php
        $this->widget('components.contractor-paavtable.ContractorPaavTable',
          array(
            'contractorType'=>Contractor::TYPE_STORE,
            'data'=>array('model'=>$model)
          )
        );
      ?>

      <a href="<?php
          echo $this->createAbsoluteUrl('contractor/create', array(
            'id'=>Contractor::TYPE_STORE
          ));
        ?>">Добавить магазин</a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'unit_price'); ?>
      <?php echo $form->error($model, 'unit_price'); ?>
      <?php
        echo $form->textField($model, 'unit_price', array(
          'class'=>'form-control',
          'placeholder'=>'0,00'
        ));
      ?> руб.
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'quantity'); ?>
      <?php echo $form->error($model, 'quantity'); ?>
      <?php
        echo $form->textField($model, 'quantity', array(
          'class'=>'form-control',
          'placeholder'=>'0,00'
        ));
      ?> шт.
    </div>
  </div>
</div>
<div class="form-group">
  <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать'
    : 'Сохранить', array('class'=>'btn btn-default')); ?>
</div>
<?php $this->endWidget(); ?>

