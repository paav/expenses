<?php
/* @var $this AddressController */
/* @var $data Address */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('line1')); ?>:</b>
	<?php echo CHtml::encode($data->line1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('line2')); ?>:</b>
	<?php echo CHtml::encode($data->line2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('line3')); ?>:</b>
	<?php echo CHtml::encode($data->line3); ?>
	<br />


</div>