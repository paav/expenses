<?php
// vim: ft=htmlphp

/* @var $this ContractorController */
/* @var $model Contractor */
/* @var $form CActiveForm */
/* @var $heads array of ContractorHeads */
/* @var $address Address */
?>
<p>Страница добавления контрагента</p>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'expenses-form',
  // Please note: When you enable ajax validation, make sure the corresponding
  // controller action is handling ajax validation correctly.
  // There is a call to performAjaxValidation() commented in generated controller code.
  // See class documentation of CActiveForm for details on this.
  'enableAjaxValidation'=>false,
)); ?>
  <?php echo $form->hiddenField($model,'type_id'); ?>

  <div class="row">
    <div class="form-group">
      <?php echo $form->labelEx($model,'head_id', array('class'=>'control-label')); ?>
      <?php
        echo $form->dropDownList($model, 'head_id', CHtml::listData(
          $heads, 'id', 'name'), array('size'=>'10','class'=>'form-control')
        );
      ?>
      <?php echo $form->error($model,'head_id'); ?>
    </div>
  </div>

  <div class="row">
    <div class="form-group">
      <?php echo $form->labelEx($model,'type_id', array('class'=>'control-label')); ?>
      <?php
        echo $form->dropDownList($model, 'type_id', CHtml::listData(
          $types, 'id', 'name'), array('size'=>'10','class'=>'form-control')
        );
      ?>
      <?php echo $form->error($model,'type_id'); ?>
    </div>
  </div>

  <fieldset>
    <legend><?php echo $model->getAttributeLabel('address_id'); ?></legend>

    <?php
      $this->renderPartial('/address/_form-fields', array(
        'model'=>$address,
        'form'=>$form
      ));
    ?>

  </fieldset>

  <div class="row">
    <div class="form-group">
      <?php
        echo $form->labelEx($model, 'note', array('class'=>'control-label'));
      ?>
      <?php
        echo $form->textArea($model, 'note', array(
          'class'=>'form-control', 'maxlength'=>240,
          'placeholder'=>'Приятный персонал'
        ));
      ?>
      <?php echo $form->error($model,'note'); ?>
    </div>
  </div>

  <div class="form-group">
    <?php
      echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',
                               array('class'=>'btn btn-default'));
    ?>
  </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
