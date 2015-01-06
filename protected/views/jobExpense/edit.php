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
<h1><?php if ($model->type === Expense::TYPE_JOB)
            echo 'Создание расхода на работу';
          else
            echo 'Редактирование расхода на работу';
    ?></h1>
<?php $this->renderPartial('_form',array(
    'model' => $model,
    'partsAll' => $partsAll,
    'jobsAll' => $jobsAll,
    'garagesAll' => $garagesAll,
    'boundToModelExpenses' => $boundToModelExpenses,
    'boundToNothingExpenses' => $boundToNothingExpenses,
)); ?>
