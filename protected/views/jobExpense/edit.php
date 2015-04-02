<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this JobExpenseController
 * @var $model JobExpense
 * @var $jobsAll Array
 * @var $boundToModelExpenses Array
 * @var $garagesAll Contractor
 * @var $boundToNothingExpenses Array
 */
?>
<p><?php
  if ($this->action->id == 'create')
    echo '# Создание расхода на работу';
  else
    echo '# Редактирование расхода на работу';
?></p>
<?php $this->renderPartial('_form',array(
  'model' => $model,
  'partsAll' => $partsAll,
  'jobsAll' => $jobsAll,
  'garagesAll' => $garagesAll,
  'boundToModelExpenses' => $boundToModelExpenses,
  'boundToNothingExpenses' => $boundToNothingExpenses,
  'df'=> $df,
)); ?>
