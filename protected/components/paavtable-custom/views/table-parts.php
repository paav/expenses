<?php
// vim: ft=htmlphp

/* @var $this PaavTable */
/* @var $models array */
/* @var $attrlabels array */
/* @var $pages CPagination */
?>
<?php
  $this->widget('PaavPager', array(
    'pages'=>$pages,
    'view'=>'components.paavtable-custom.views.pager'
  ));
?>
<table class="aTable-contractor table table-bordered">
  <thead>
    <tr>
      <?php // First th is for radio buttons ?>
      <th>

      <?php foreach ($attrLabels as $name => $label): ?>
      <th><?php echo $this->createSortLink($name, $label); ?>
      <?php endforeach; ?>
      <?php // Last th is for the commands column ?>
      <th>
  <tbody>

    <?php foreach ($models as $model): ?>
    <tr>
      <td><?php
        echo CHtml::activeRadioButton($data->model,'part_id',array(
          'uncheckValue'=>null,
          'value'=>$model->id));
      ?>

      <?php foreach ($attrLabels as $attr => $label): ?>
      <td><?php echo CHtml::value($model, $attr, 'Не указано'); ?>
      <?php endforeach; ?>

      <td class="table-cell-cmd">

        <a href="<?php
          echo $this->getAbsUrlByModel($model, 'view', array(
            'id'=>$model->id
          ));
        ?>"><i class="fa fa-search fa-lg hover-scale"></i></a>

        <a href="<?php
          echo $this->getAbsUrlByModel($model, 'update', array(
            'id'=>$model->id
          ));
        ?>"><i class="fa fa-edit fa-lg hover-scale"></i></a>

        <a href="<?php
          echo $this->getAbsUrlByModel($model, 'delete', array(
            'id'=>$model->id
          ));
        ?>"><i class="fa fa-remove fa-lg hover-scale"></i></a>

    <?php endforeach; ?>
</table>

