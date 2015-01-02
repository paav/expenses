<?php
/* @var $this ExpenseController */
/* @var $model Expense */
/* @var $contractors Contractor */
?>

<?php $this->renderPartial("_$expenseType-form",array(
    'model'=>$model,
    'parts'=>$parts,
    'jobs'=>$jobs,
    'contractors'=>$contractors,
    'jobsDp'=>$jobsDp,
    'expenses'=>$expenses,
    'contractorsDp'=>$contractorsDp,
    'connectedExpensesDp'=>$connectedExpensesDp,
    'connectedExpenses'=>$connectedExpenses,
    'allExpensesDp'=>$allExpensesDp,
)); ?>
