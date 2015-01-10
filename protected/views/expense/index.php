<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this ExpenseController
 * @var $allExpenses array of Expense objects
 */
$labels = ['date' => 'Дата',
           'run'  => 'Пробег',
           'type' => 'Тип расхода',
           'cost' => 'Стоимость',
           'descr'=> 'Описание'];
$numberFormatter = yii::app()->numberFormatter;
?>

<h1>Все расходы</h1> 
<form method="get">
  <div class="form-group">
    <?php echo CHtml::activeLabelEx($searchForm, 'searchString'); ?>
    <?php echo CHtml::error($searchForm, 'searchString'); ?>
    <?php echo CHtml::activeSearchField($searchForm, 'searchString', array(
            'class'=>'form-control')); ?>
  </div>
  <input type="submit" class="btn btn-default" value="Найти">
</form>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <?php
        foreach ($labels as $attr=>$label):
          if ($sortHelper->isSortable($attr)):
            echo '<th><a href=' . $this->updateUrl('', $sortHelper->getParams(
              $attr)) . '>' . $label . ' ';
            if ($sortHelper->isSortBy($attr)):
              if ($sortHelper->isAsc):
                echo '<i class="fa fa-sort-asc"></i></a>'; 
              else:
                echo '<i class="fa fa-sort-desc"></i></a>'; 
              endif;
            endif;
          else:
            echo '<th>' . $label;
          endif;
        endforeach;
      ?>
      <th colspan="3">
  <tbody>
    <?php foreach ($allExpenses as $expense): ?>
    <tr>
      <td><?php echo yii::app()->dateFormatter->format('dd.MM.yyyy',
                                                       $expense->date); ?>
      <td class="text-right"><?php echo $expense->run
        ? $numberFormatter->formatDecimal($expense->run) . ' км' : 'нет'; ?>
      <td><?php echo $expense->expenseType->name; ?>
      <td class="text-right"><?php echo $numberFormatter->formatDecimal(
                                     $expense->cost); ?> руб.
      <td><?php echo $expense->descr; ?>
          <?php $ctrl = $expense->type == Expense::TYPE_JOB ? 'JobExpense'
                                                            : 'PartExpense'; ?>
      <td class="cell-action"><a href="<?php
                                  echo $this->createAbsoluteUrl($ctrl . '/view',
                                    array('id'=>$expense->id));
                          ?>"><i class="fa fa-search fa-lg hover-scale"></i></a>
      <td class="cell-action"><a href="<?php
                                echo $this->createAbsoluteUrl($ctrl . '/update',
                                  array('id'=>$expense->id));
                            ?>"><i class="fa fa-edit fa-lg hover-scale"></i></a>
      <td class="cell-action"><a href="<?php
                                 echo $this->createAbsoluteUrl('Expense/delete',
                                   array('id'=>$expense->id));
                          ?>"><i class="fa fa-remove fa-lg hover-scale"></i></a>
    <?php endforeach; ?>
</table>
<?php $this->widget('CLinkPager', array('pages'=>$pages)); ?>
