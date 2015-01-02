<?php
/* @var $this PartController */
/* @var $model Part */
?>
<h1>Редактирование запчасти</h1>

<?php $this->renderPartial('_form', array(
    'model'=>$model,
    'partTypes'=>$partTypes,
)); ?>
