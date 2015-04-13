<?php
/* @var $this AddressController */
/* @var $model Address */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'address-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'line1'); ?>
		<?php echo $form->textField($model,'line1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'line1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'line2'); ?>
		<?php echo $form->textField($model,'line2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'line2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'line3'); ?>
		<?php echo $form->textField($model,'line3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'line3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->