<?php
/* @var $this CController */
/* @var $model Address */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="form-group">
      <?php
        echo $form->labelEx($model, 'line1', array(
          'class'=>'control-label'
        ));
      ?>
      <?php
        echo $form->textField($model, 'line1', array(
          'class'=>'form-control',
          'placeholder'=>'Киренского'
        ));
      ?>
      <?php echo $form->error($model, 'line1'); ?>
    </div>
</div>

<div class="row">
    <div class="form-group">
      <?php
        echo $form->labelEx($model, 'line2', array(
          'class'=>'control-label'
        ));
      ?>
      <?php
        echo $form->textField($model, 'line2', array(
          'class'=>'form-control',
          'placeholder'=>'89а'
        ));
      ?>
      <?php echo $form->error($model, 'line2'); ?>
    </div>
</div>

<div class="row">
    <div class="form-group">
      <?php
        echo $form->labelEx($model, 'line3', array(
          'class'=>'control-label'
        ));
      ?>
      <?php
        echo $form->textField($model, 'line3', array(
          'class'=>'form-control',
          'placeholder'=>'3-11'
        ));
      ?>
      <?php echo $form->error($model, 'line3'); ?>
    </div>
</div>
