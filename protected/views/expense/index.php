<?php
// vim: ft=htmlphp

/* @var $this ExpenseController */
/* @var $allExpenses array of Expense objects */

$this->pageTitle = 'Все расходы | Expenses';

$cols = ['date' => 'Дата',
         'run'  => 'Пробег',
         'type' => 'Тип расхода',
         'cost' => 'Стоимость',
         'descr'=> 'Описание'];
$sortableCols = $sortHelper->getSortable(array_keys($cols));
$numberFormatter = yii::app()->numberFormatter;
?>
<?php //<h1>Все расходы</h1>  ?>
<div class="row">
  <div class="col-md-6">
    <form class="form-inline search-form" method="get">
      <div class="form-group">
        <?php //echo CHtml::activeLabelEx($searchForm, 'searchString'); ?>
        <?php echo CHtml::error($searchForm, 'searchString'); ?>
        <?php echo CHtml::activeSearchField($searchForm, 'searchString', array(
          'class'=>'form-control')); ?>
      </div>
      <input type="submit" class="btn btn-default" value="Найти">
    </form>
  </div>
  <div class="col-md-6">
    <?php $this->widget('ext.paavpager.PaavPager', array('pages'=>$pages)); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-hover">
      <colgroup span="4" class="table-width-1">
        <?php foreach ($sortableCols as $col): ?>
        <?php if ($sortHelper->isSortBy($col)): ?>
        <col class="table-col-active">
        <?php else: ?>
        <col>
        <?php endif; ?>
        <?php endforeach; ?>
      <colgroup>
      <colgroup span="3" class="table-width-2">
      <thead>
        <tr>
          <?php
            foreach ($cols as $col=>$label):
              if ($sortHelper->isSortable($col)):
                echo '<th><a href=' . $this->updateUrl('',
                  $sortHelper->getParams($col)) . '>' . $label . ' ';
                if ($sortHelper->isSortBy($col)):
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
          <td><?php
            echo yii::app()->dateFormatter->format('dd.MM.yyyy', $expense->date);
          ?>

          <td class="text-right"><?php
            echo $expense->run ?
              $numberFormatter->formatDecimal($expense->run) . ' км' : 'нет';
          ?>

          <td><?php echo $expense->expenseType->name; ?>

          <td class="text-right"><?php
            echo $numberFormatter->formatDecimal($expense->cost);
          ?> руб.

          <td><?php echo $expense->descr; ?>

          <td class="table-col-cmd"><a href="<?php
						echo $this->getAbsUrlByModel($expense, 'view', array('id'=>$expense->id));
					?>"><i class="fa fa-search fa-lg hover-scale"></i></a>

          <td class="table-col-cmd"><a href="<?php
						echo $this->getAbsUrlByModel($expense, 'update', array('id'=>$expense->id));
          ?>"><i class="fa fa-edit fa-lg hover-scale"></i></a>

          <td class="table-col-cmd"><a href="<?php
            echo $this->createAbsoluteUrl('Expense/delete', array('id'=>$expense->id));
          ?>"><i class="fa fa-remove fa-lg hover-scale"></i></a>
        <?php endforeach; ?>
    </table>
  </div>
</div>
