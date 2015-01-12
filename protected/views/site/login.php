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
<div class="row">
  <div class="col-md-3 col-md-offset-9">
    <a href="<?php echo $this->createUrl( 'user/create'); ?>">Регистрация</a>
  </div>
</div>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <form method="post">
      <div class="form-group has-feedback <?php $ifErrorAdd('username',
                                                            'has-error'); ?>">
        <?php echo CHtml::activeLabel($model, 'username',
                                      array('class'=>'control-label')); ?>
        <?php echo CHtml::activeTextField($model, 'username',
                                          array('class'=>'form-control')); ?>
        <?php echo $ifErrorAdd('username', $icon); ?>
        <?php echo CHtml::error($model, 'username'); ?>
      </div>
      <div class="form-group has-feedback <?php $ifErrorAdd('password',
                                                            'has-error'); ?>">
        <?php echo CHtml::activeLabel($model, 'password',
                                      array('class'=>'control-label')); ?>
        <?php echo CHtml::activePasswordField($model, 'password', array(
                     'class'=>'form-control')); ?>
        <?php echo $ifErrorAdd('password', $icon); ?>
        <?php echo CHtml::error($model, 'password'); ?>
      </div>
      <input class="btn btn-default" type="submit" value="Войти">
    </form>
  </div>
</div>
