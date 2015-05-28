<?php
// vim:ft=htmlphp

/* @var $this PartController */
/* @var $model Part */
/* @var $rootTypes array of PartType objects */
/* @var $rootType PartType */
/* @var $vendors array of Vendor objects */
/* @var $typesDp CActiveDataProvider for PartType class */
?>

<h1>Новый расходный материал</h1>

<div class="form">
  <?php
    $form=$this->beginWidget('CActiveForm', array(
      'enableAjaxValidation'=>false,
    ));
  ?>

  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <?php
          echo $form->labelEx($model,'part_type_id', array(
            'class'=>'control-label'));
        ?>
        <?php echo $form->error($model,'part_type_id'); ?>

        <?php
          $ptv = $this->widget('components.paavtreeview.PaavTreeView', array(
            'dataProvider'=>$typesDp,
            'hiddenData'=>array($model, 'part_type_id'),
          ));
        ?>
      </div>
    </div>

    <div class="col-md-5">
      <div class="form-group">
        <?php echo $form->labelEx($model, 'vendor_id'); ?>
        <?php echo $form->error($model, 'vendor_id'); ?>
        <?php
          echo $form->dropDownList($model, 'vendor_id', CHtml::listData(
            $vendors, 'id', 'name'), array('size'=>'10',
              'class'=>'form-control'));
        ?>
      </div>
    </div>
  </div>
  <?php if ($ptv->getClicked()): ?>
    <div class="row">
      <div class="col-md-5">
        <?php
          $this->renderPartial($this->typeToView($model->superType), array(
            'model'=>$model, 'form'=>$form));
        ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="row">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('name'=>'submit','class'=>'')); ?>
    <?php if(!$model->isNewRecord): ?>
    <?php echo CHtml::link('Удалить', array('delete', 'id'=>$model->id), array('class'=>'')); ?>
    <?php endif; ?>
  </div>

  <?php $this->endWidget(); ?>
</div>
