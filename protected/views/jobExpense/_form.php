<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this JobExpenseController
 * @var $model JobExpense
 * @var $jobsAll Array
 * @var $boundToModelExpenses Array
 * @var $garagesAll Contractor
 * @var $boundToNothingExpenses Array
 * @var $form CActiveForm
 */
?>
<?php $form = $this->beginWidget('CActiveForm', array(
  'htmlOptions'=>array(
    'class'=>'form',
  ),
  'enableAjaxValidation' => false,
)); ?>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <?php echo $form->labelEx($model, 'date', array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'date', array('class'=>'form-control datesetter',
                'value'=>'')); ?>
        <?php //echo $form->labelEx($model, 'date', array('class'=>'control-label')); ?>
        <?php //echo $form->dateField($model, 'date', array('class'=>'form-control',
                //'value'=>'2015-01-01')); ?>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'run', array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'run', array('class'=>'form-control')); ?>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model, 'job_id'); ?>
        <?php echo $form->error($model, 'job_id'); ?>
        <?php echo $form->dropDownList($model, 'job_id', CHtml::listData(
          $jobsAll, 'id', 'name'), array('size'=>'10', 'class'=>'form-control'));
        ?>
      </div>
      <p><a href="<?php $this->createAbsoluteUrl('job/create');
               ?>">Добавить работу</a></p>
    </div>
    <div class="col-md-8">
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
            <?php foreach ($garagesAll as $garage): ?>
            <tr>
              <td><?php echo $form->radioButton($model, 'contractor_id', array(
                          'uncheckValue'=>null,
                          'value'=>$garage->id));
                  ?>
              <td><?php echo $garage->name; ?>
              <td><?php echo $garage->address; ?>
              <td><?php echo $garage->note; ?>
            <?php endforeach; ?>
        </table>
        <p><a href="<?php $this->createAbsoluteUrl('contractor/create/contractorType=2');
                 ?>">Добавить мастерскую</a></p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <?php echo $form->labelEx($model, 'cost'); ?>
        <?php echo $form->error($model, 'cost'); ?>
        <?php echo $form->numberField($model, 'cost', array('class'=>'form-control',
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
        <?php echo $form->labelEx($model, 'note'); ?>
        <?php echo $form->textArea($model, 'note', array('class'=>'form-control',
                'col'=>'50','row'=>'5','placeholder'=>'Введите комментарий'));
        ?>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="">Связанные расходы на запчати</label>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>
          <th>Дата покупки
          <th>Магазин
          <th>Наименование
          <th>Цена за ед.
          <th>Количество
          <th>Стоимость
      <tbody>
        <?php foreach ($boundToModelExpenses as $expense): ?>
        <tr>
          <td><?php echo CHtml::checkbox('idsToUnbind[]', false, array(
                      'value'=>$expense->id)); ?>
          <td><?php echo $expense->date; ?>
          <td><?php echo $expense->contractor->name . ', ' .
                         $expense->contractor->address; ?>
          <td><?php echo $expense->part->type->name . ' ' .
                         $expense->part->manufacturer . ' ' .
                         $expense->part->name . ' ' .
                         $expense->part->part_number;
              ?>
          <td><?php echo $expense->unit_price; ?>
          <td><?php echo $expense->quantity; ?>
          <td><?php echo $expense->cost; ?>
        <?php endforeach; ?>
    </table>
  </div>
  <div class="form-group">
    <label for="">Свободные расходы на запчасти</label>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>
          <th>Дата покупки
          <th>Магазин
          <th>Наименование
          <th>Цена за ед.
          <th>Количество
          <th>Стоимость
      <tbody>
        <?php foreach ($boundToNothingExpenses as $expense): ?>
        <tr>
          <td><?php echo CHtml::checkbox('idsToBind[]', false, array(
                      'value'=>$expense->id)); ?>
          <td><?php echo $expense->date; ?>
          <td><?php echo $expense->contractor->name . ', ' .
                         $expense->contractor->address;
              ?>
          <td><?php echo $expense->part->type->name . ' ' .
                         $expense->part->manufacturer . ' ' .
                         $expense->part->name . ' ' .
                         $expense->part->part_number;
              ?>
          <td><?php echo $expense->unit_price; ?>
          <td><?php echo $expense->quantity; ?>
          <td><?php echo $expense->cost; ?>
        <?php endforeach; ?>
    </table>
  </div>
  <p><a href="<?php $this->createAbsoluteUrl('partExpense/create');
           ?>">Добавить расход на запчать</a></p>
  <div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать'
      : 'Сохранить', array('class'=>'btn btn-default')); ?>
  </div>
<?php $this->endWidget(); ?>
