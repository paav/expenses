<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this ExpenseController
 * @var $allExpense array of Expense objects
 */
?>
<h1>Все расходы</h1> 
<table class="table table-striped">
  <thead>
    <tr>
      <th>Дата
      <th>Пробег
      <th>Тип расхода
      <th>Стоимость
      <th>Описание
      <th>
  <tbody>
    <?php foreach ($allExpenses as $expense): ?>
    <tr>
      <td><?php echo yii::app()->dateFormatter->format('dd.MM.yyyy', $expense->date); ?>
      <td><?php echo $expense->run ? $expense->run . ' км' : 'нет'; ?>
      <td><?php echo $expense->expenseType->name; ?>
      <td><?php echo $expense->cost; ?> руб.
      <td><?php echo $expense->descr; ?>
          <?php $ctrl = $expense->type == Expense::TYPE_JOB ? 'JobExpense'
                                                            : 'PartExpense'; ?>
      <td><a href="<?php echo $this->createAbsoluteUrl($ctrl . '/view', array(
                           'id'=>$expense->id));
                   ?>"><i class="fa fa-search fa-lg"></i></a>
      <td><a href="<?php echo $this->createAbsoluteUrl($ctrl . '/update', array(
                           'id'=>$expense->id));
                   ?>"><i class="fa fa-edit fa-lg"></i></a>
      <td><a href="<?php echo $this->createAbsoluteUrl('Expense/delete', array(
                           'id'=>$expense->id));
                   ?>"><i class="fa fa-remove fa-lg"></i></a>
    <?php endforeach; ?>
</table>
<?php $this->widget('CLinkPager', array('pages'=>$pages)); ?>
