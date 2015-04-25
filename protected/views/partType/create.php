<?php
// vim: ft=htmlphp

/* @var $this PartTypeController */
/* @var $model PartType */
/* @var $parents array of PartType objects */
?>

<h1>Create/edit PartType</h1>

<div class="form">

  <?php
    $form=$this->beginWidget('CActiveForm', array(
      'id'=>'part-type-form', 'enableAjaxValidation'=>false));
  ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

  <div class="row">
    <div class="form-group">
      <?php echo $form->labelEx($model, 'parent_id'); ?>
      <?php echo $form->error($model, 'parent_id'); ?>
      <?php
        echo $form->dropDownList($model, 'parent_id', CHtml::listData($parents,
          'id', 'name'), array('size'=>'10','class'=>'form-control'));
      ?>
    </div>
  </div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
