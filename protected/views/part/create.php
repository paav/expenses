<?php
/* @var $this PartController */
/* @var $model Part */
?>

<p>Создание запчасти (расх. мат)</p>

<?php $this->renderPartial('_form', array(
    'model'=>$model,
    'partTypes'=>$partTypes,
)); ?>
