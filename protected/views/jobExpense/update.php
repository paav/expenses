<?php
/* @var $this ExpenseController */
/* @var $model Expense */
/* @var $contractors Contractor */
?>
<p>Редактирование расхода на обслуживание</p>
<?php $this->renderPartial('_form',array(
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
