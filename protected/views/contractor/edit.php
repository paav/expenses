<?php
// vim: ft=htmlphp

/* @var $this ContractorController */
/* @var $model Contractor */
/* @var $form CActiveForm */
/* @var $heads array of ContractorHead */
/* @var $newHead ContractorHead */
/* @var $types array of ContractorType */
/* @var $address Address */
?>
<h1><?php
  echo $model->filterPageHeading(array(
    'new'=>array(
      'Новый магазин',
      'Новая мастерская',
      'Новая заправка',
    ),
    'edit'=>array(
      'Редактирование магазина',
      'Редактирование мастерской',
      'Редактирование заправки',
    )
  ));
?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'expenses-form',
  // Please note: When you enable ajax validation, make sure the corresponding
  // controller action is handling ajax validation correctly.
  // There is a call to performAjaxValidation() commented in generated controller code.
  // See class documentation of CActiveForm for details on this.
  'enableAjaxValidation'=>false,
)); ?>

  <div class="row">
    <div class="col-md-6">
      <fieldset>
        <legend><?php echo $model->getAttributeLabel('address_id'); ?></legend>
        <?php
          $this->renderPartial('/address/_form-fields', array(
            'model'=>$address,
            'form'=>$form
          ));
        ?>
      </fieldset>
      <div class="row">
        <div class="form-group">
          <?php
            echo $form->labelEx($model, 'note', array('class'=>'control-label'));
          ?>
          <?php
            echo $form->textArea($model, 'note', array(
              'class'=>'form-control', 'maxlength'=>240,
              'placeholder'=>'Приятный персонал'
            ));
          ?>
          <?php echo $form->error($model,'note'); ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <?php echo $form->labelEx($model,'head_id', array('class'=>'control-label')); ?>
        <?php echo $form->error($model,'head_id'); ?>

      <?php
        $this->widget('ext.paavtable.PaavTable', array(
          'dataProvider'=>$headsDp,
          'view'=>'components.paavtable-custom.views.table-heads',
          'data'=>array('model'=>$model),
          'columns'=>array('name')
        ));
      ?>

      </div>

      <?php
        $this->renderPartial('/contractorHead/_form-fields', array(
          'model'=>$newHead,
          'form'=>$form
        ));
      ?>

      <div class="form-group">
        <?php
          echo CHtml::submitButton('Добавить', array('name'=>'addHead',
            'class'=>'btn btn-default'));
        ?>
      </div>
    </div>
  </div>

  <?php if (!empty($types)): ?>
  <div class="row">
    <div class="form-group">
      <?php echo $form->labelEx($model,'type_id', array('class'=>'control-label')); ?>
      <?php
        echo $form->dropDownList($model, 'type_id', CHtml::listData(
          $types, 'id', 'name'), array('size'=>'10','class'=>'form-control')
        );
      ?>
      <?php echo $form->error($model,'type_id'); ?>
    </div>
  </div>
  <?php endif; ?>

  <div class="form-group">
    <?php
      echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',
                               array('class'=>'btn btn-default'));
    ?>
  </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
