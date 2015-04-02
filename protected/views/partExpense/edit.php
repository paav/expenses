<?php
// vim: ft=htmlphp

/* @var $this PartExpenseController */
/* @var $model PartExpense */
/* @var $partsAll Array */
/* @var $storesAll Contractor */
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
        <?php echo $form->labelEx($model, 'part_id'); ?>
        <?php echo $form->error($model, 'part_id'); ?>
        <?php echo $form->dropDownList($model, 'part_id', CHtml::listData($partsAll,
                'id', function($part) {
                  return $part->type->name . ' ' .
                         $part->manufacturer . ' ' .
                         $part->name . ' ' .
                         $part->part_number;
                }), array('size'=>'10','class'=>'form-control'));
        ?>
      </div>
      <p><a href="<?php echo $this->createAbsoluteUrl('part/create');
        ?>">Добавить запчасть</a></p>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <?php echo $form->labelEx($model, 'contractor_id'); ?>
        <?php echo $form->error($model, 'contractor_id'); ?>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>
              <th>Название
              <th>Адрес
              <th>Комментарий
          <tbody>
            <?php foreach ($storesAll as $store): ?>
            <tr>
              <td><?php echo $form->radioButton($model, 'contractor_id', array(
                          'uncheckValue'=>null,
                          'value'=>$store->id));
                  ?>
              <td><?php echo $store->name; ?>
              <td><?php echo $store->address; ?>
              <td><?php echo $store->note; ?>
            <?php endforeach; ?>
        </table>
        <a href="<?php echo $this->createAbsoluteUrl('contractor/create/contractorType=1');
                 ?>">Добавить магазин</a>
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
                  'min'=>'1',
                  'max'=>'999999',
                  'step'=>'1',
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

