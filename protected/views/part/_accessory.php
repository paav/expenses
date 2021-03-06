<?php
// vim:ft=htmlphp

/* @var $model Part */
?>

<div class="form-group">
  <?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?>
  <?php echo $form->textField($model,'name',array('class'=>'form-control','maxlength'=>50,'placeholder'=>'Например, "ароматизатор"')); ?>
  <?php echo $form->error($model,'name'); ?>
</div>

<div class="form-group">
  <?php echo $form->labelEx($model,'part_number', array('class'=>'control-label')); ?>
  <?php echo $form->textField($model,'part_number',array('class'=>'form-control','maxlength'=>50,'placeholder'=>'Это поле можно оставить пустым')); ?><span></span>
  <?php echo $form->error($model,'part_number'); ?>
</div>

<div class="form-group">
  <?php echo $form->labelEx($model,'note', array('class'=>'control-label')); ?>
  <?php echo $form->textArea($model,'note',array('class'=>'form-control','form-groups'=>5,'cols'=>50,'maxlength'=>240,'placeholder'=>'Например, "Очень хороший ароматизатор"')); ?>
  <?php echo $form->error($model,'note'); ?>
</div>
