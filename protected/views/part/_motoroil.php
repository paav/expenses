<?php
// vim:ft=htmlphp

/* @var $model Part */
?>

<div class="form-group">
  <?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?>
  <?php echo $form->textField($model,'name',array('class'=>'form-control','maxlength'=>50,'placeholder'=>'Например, "EDGE 0W-30 A3/B4"')); ?>
  <?php echo $form->error($model,'name'); ?>
</div>

<div class="form-group">
  <?php echo $form->labelEx($model,'sae_grade', array('class'=>'control-label')); ?>
  <?php echo $form->textField($model,'sae_grade',array('class'=>'form-control','maxlength'=>6,'placeholder'=>'Например, "0W-30"')); ?>
  <?php echo $form->error($model,'sae_grade'); ?>
</div>

<div class="form-group">
  <?php echo $form->labelEx($model,'volume', array('class'=>'control-label')); ?>
  <?php echo $form->textField($model,'volume',array('class'=>'form-control','maxlength'=>5,'placeholder'=>'Например, "0,5"')); ?>
  <?php echo $form->error($model,'volume'); ?>
</div>

<div class="form-group">
  <?php echo $form->labelEx($model,'part_number', array('class'=>'control-label')); ?>
  <?php echo $form->textField($model,'part_number',array('class'=>'form-control','maxlength'=>50,'placeholder'=>'Это поле можно оставить пустым')); ?>
  <?php echo $form->error($model,'part_number'); ?>
</div>

<div class="form-group">
  <?php echo $form->labelEx($model,'note', array('class'=>'control-label')); ?>
  <?php echo $form->textArea($model,'note',array('class'=>'form-control','form-groups'=>5,'cols'=>50,'maxlength'=>240,'placeholder'=>'Например, "Очень хорошее масло"')); ?>
  <?php echo $form->error($model,'note'); ?>
</div>

