<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp

/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->layout = 'without-nav';
$this->pageTitle = 'Вход | Expenses';

// TODO: same as in the user form.
$ifErrorAdd = function($attr, $output) use ($model) {
  echo $model->hasErrors($attr) ? $output : '';
};
$icon = '<span class="glyphicon glyphicon-remove form-control-feedback"'
      . 'aria-hidden="true"></span>';
?>
<div class="loginForm">
  <div class="loginForm-img">
  </div>
  <form class="form-horizontal" method="post">
    <div class="form-group has-feedback <?php $ifErrorAdd('username',
                                                          'has-error'); ?>">
      <div class="col-sm-12">
        <?php echo CHtml::activeLabel($model, 'username',
                                      array('class'=>'control-label')); ?>
      </div>
      <div class="col-sm-7">
        <?php echo CHtml::activeTextField($model, 'username',
                                          array('class'=>'form-control')); ?>
        <?php echo $ifErrorAdd('username', $icon); ?>
      </div>
      <div class="col-sm-5">
        <?php echo CHtml::error($model, 'username'); ?>
      </div>
    </div>
    <div class="form-group has-feedback <?php $ifErrorAdd('password',
                                                          'has-error'); ?>">
      <div class="col-sm-12">
        <?php echo CHtml::activeLabel($model, 'password',
                                    array('class'=>'control-label')); ?>
      </div>
      <div class="col-sm-7">
        <?php echo CHtml::activePasswordField($model, 'password', array(
                     'class'=>'form-control')); ?>
        <?php echo $ifErrorAdd('password', $icon); ?>
      </div>
      <div class="col-sm-5">
        <?php echo CHtml::error($model, 'password'); ?>
      </div>
    </div>
    <input class="btn btn-default" type="submit" value="Войти">
  </form>
</div>
