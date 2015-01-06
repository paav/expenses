<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this PartExpenseController
 * @var $model PartExpense
 * @var $partsAll Array
 * @var $storesAll Contractor
 * @var $form CActiveForm
 */
?>

<?php yii::app()->clientScript->registerCssFile(yii::app()->baseUrl.'/css/form-my.css'); ?>
<?php yii::app()->clientScript->registerCssFile('http://i.icomoon.io/public/temp/7b7d465304/UntitledProject1/style.css'); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'enableAjaxValidation'=>false,
)); ?>
  <div class="form-group">
    <?php echo $form->labelEx($model, 'date'); ?>
    <?php echo $form->dateField($model, 'date', array('class'=>'form-control',
            'value'=>'2015-01-01')); ?>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($model, 'contractor_id'); ?>
    <?php echo $form->error($model, 'contractor_id'); ?>
    <table class="table">
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
    <a href="<?php $this->createAbsoluteUrl('contractor/create/contractorType=1');
             ?>">Добабить магазин</a>
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
            }), array('size'=>'10'));
    ?>
    <a href="<?php $this->createAbsoluteUrl('part/create');
             ?>">Добабить добавить запчасть</a>
  </div>
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
  <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать'
                                                     : 'Сохранить'); ?>
<?php $this->endWidget(); ?>
