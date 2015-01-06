<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this ExpenseController 
 * @var $model Expense 
 * @var $contractors Contractor 
 */
?>
<h1><?php if ($model->type === Expense::TYPE_JOB)
            echo 'Создание расхода на запчасть';
          else
            echo 'Редактирование расхода на запчасть';
    ?></h1>
<?php $this->renderPartial('_form',array(
    'model' => $model,
    'partsAll' => $partsAll,
    'storesAll' => $storesAll,
)); ?>
