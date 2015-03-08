<?php
/* @var $this ExpenseController */
/* @var $model Expense */
/* @var $contractors Contractor */
?>

<h1>Создание расхода на автозапчасть</h1>
<?php $this->renderPartial('_form',array(
    'model'=>$model,
    'partsAll'=>$partsAll,
    //'jobsAll'=>$jobsAll,
    'storesAll'=>$storesAll,
    //'jobsAllDp'=>$jobsAllDp,
    //'expenses'=>$expenses,
    //'storesDp'=>$storesDp,
    //'connectedExpensesDp'=>$connectedExpensesDp,
    //'connectedExpenses'=>$connectedExpenses,
    //'allExpensesDp'=>$allExpensesDp,
)); ?>
