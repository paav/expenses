<?php
// vim: ft=htmlphp

/* @var $this FuelExpenseController */
/* @var $model FuelExpense */
/* @var $fuelsAll Array */
/* @var $stationsAll Contractor */
/* @var $form CActiveForm */
/* @var $df CDateFormatter */
?>
<p><?php
  if ($this->action->id == 'create')
    echo '# Создание расхода на топливо';
  else
    echo '# Редактирование расхода на топливо';
?></p>
<div class="row">
  <?php
    $this->widget('ext.paavtable.PaavTable', array(
      'dataProvider'=>$contractorsDp
    ));
  ?>
</div>
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
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>
              <th>Название
              <th>Адрес
              <th>Комментарий
              <th colspan="3">
          <tbody>
            <?php foreach ($stationsAll as $station): ?>
            <tr>
              <td><?php echo $form->radioButton($model, 'contractor_id', array(
                          'uncheckValue'=>null,
                          'value'=>$station->id));
                  ?>
              <td><?php echo $station->name; ?>
              <td><?php echo $station->address; ?>
              <td><?php echo $station->note; ?>

              <td class="table-col-cmd"><a href="<?php
                  echo $this->createAbsoluteUrl(
                    'contractor/view',
                    array('id'=>$station->id)
                  );
                ?>"><i class="fa fa-search fa-lg hover-scale"></i></a>

              <td class="table-col-cmd"><a href="<?php
                  echo $this->createAbsoluteUrl(
                    'contractor/update',
                    array('id'=>$station->id)
                  );
                ?>"><i class="fa fa-edit fa-lg hover-scale"></i></a>

              <td class="table-col-cmd"><a href="<?php
                  echo $this->createAbsoluteUrl(
                    'contractor/delete',
                     array('id'=>$station->id)
                  );
                ?>"><i class="fa fa-remove fa-lg hover-scale"></i></a>
            <?php endforeach; ?>
        </table>
        <a href="<?php
            echo $this->createAbsoluteUrl('contractor/create', array('id'=>3));
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
