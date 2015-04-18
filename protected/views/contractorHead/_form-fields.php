<?php
/* @var $this CController */
/* @var $model ContractorHead */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="form-group">
      <?php
        echo $form->labelEx($model, 'name', array(
          'class'=>'control-label'
        ));
      ?>
      <?php
        echo $form->textField($model, 'name', array(
          'class'=>'form-control',
          'placeholder'=>'Возрождение'
        ));
      ?>
      <?php echo $form->error($model, 'name'); ?>
    </div>
</div>
