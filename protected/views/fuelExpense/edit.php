<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this ExpenseController 
 * @var $model Expense 
 * @var $contractors Contractor 
 */
?>
<p><?php
  if ($this->action->id == 'create')
    echo '# Создание расхода на топливо';
  else
    echo '# Редактирование расхода на топливо';
?></p>
<?php $this->renderPartial('_form', array(
		'model'=>$model,
		'fuelsAll'=>$fuelsAll,
		'stationsAll'=>$stationsAll,
)); ?>
