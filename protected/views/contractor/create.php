# vim: ts=2:sts=2:sw=2
<?php
/* @var $this ContractorController */
/* @var $model Contractor */
?>

<?php if ($model->type_id == Contractor::TYPE_GARAGE): ?>
  <p>Новая мастерская</p>
<?php elseif ($model->type_id == Contractor::TYPE_STORE): ?>
  <p>Новый магазин</p>
<?php endif; ?>

<?php $this->renderPartial('_form', array(
  'model'=>$model,
  'contractorDp'=>$contractorDp,
)); ?>
