<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this UserController
 * @var $model User
 * @var $genders Array of Gender objects
 */
$ifErrorAdd = function($attr, $output) use ($model) {
  echo $model->hasErrors($attr) ? $output : '';
};
$icon = '<span class="glyphicon glyphicon-remove form-control-feedback"'
      . 'aria-hidden="true"></span>';
$pwdLabel = $this->isAction('create') ? 'Пароль' : 'Новый пароль';
?>
<form method="post">
  <div class="form-group has-feedback <?php $ifErrorAdd('first_name',
                                                        'has-error'); ?>">
    <?php echo CHtml::activeLabel($model, 'first_name',
                                  array('class'=>'control-label')); ?>
    <?php echo CHtml::activeTextField($model, 'first_name',
                                      array('class'=>'form-control')); ?>
    <?php echo $ifErrorAdd('first_name', $icon); ?>
    <?php echo CHtml::error($model, 'first_name'); ?>
  </div>
  <?php if ($this->isAction('create')): ?>
  <div class="form-group has-feedback <?php $ifErrorAdd('username',
                                                        'has-error'); ?>">
    <?php echo CHtml::activeLabel($model, 'username',
                                  array('class'=>'control-label')); ?>
    <?php echo CHtml::activeTextField($model, 'username',
                                      array('class'=>'form-control')); ?>
    <?php echo $ifErrorAdd('username', $icon); ?>
    <?php echo CHtml::error($model, 'username'); ?>
  </div>
  <?php endif; ?>
  <?php if ($this->isAction('update')): ?>
  <div class="form-group has-feedback <?php $ifErrorAdd('currentPwd',
                                                        'has-error'); ?>">
    <label for="password" class="control-label">Текущий пароль</label>
    <?php echo CHtml::activePasswordField($model, 'currentPwd', array(
      'class'=>'form-control',
      'id'=>'currentPwd',
      'value'=>'',
    )); ?>
    <?php echo $ifErrorAdd('currentPwd', $icon); ?>
    <?php echo CHtml::error($model, 'currentPwd'); ?>
  </div>
  <?php endif; ?>
  <div class="form-group has-feedback <?php $ifErrorAdd('password',
                                                        'has-error'); ?>">
  <label for="password" class="control-label"><?php echo $pwdLabel;
                                              ?></label>
    <?php echo CHtml::activePasswordField($model, 'password', array(
      'class'=>'form-control',
      'id'=>'password',
      'value'=>'',
    )); ?>
    <?php echo $ifErrorAdd('password', $icon); ?>
    <?php echo CHtml::error($model, 'password'); ?>
  </div>
  <div class="form-group has-feedback <?php $ifErrorAdd('email',
                                                        'has-error'); ?>">
    <?php echo CHtml::activeLabel($model, 'email',
                                  array('class'=>'control-label')); ?>
    <?php echo CHtml::activeEmailField($model, 'email',
                                       array('class'=>'form-control')); ?>
    <?php echo $ifErrorAdd('email', $icon); ?>
    <?php echo CHtml::error($model, 'email'); ?>
  </div>
  <div class="<?php echo $ifErrorAdd('gender_id', 'has-error'); ?>">
    <label class="control-label">Пол</label>
  </div>
  <?php foreach ($genders as $gender): ?>
  <div class="<?php echo $ifErrorAdd('gender_id', 'has-error'); ?>">
    <div class="radio">
      <label>
        <?php echo CHtml::activeRadioButton($model, 'gender_id', array(
                     'value'=>$gender->id, 'id'=>'gender',
                     'uncheckValue'=>null)); ?>
        <?php echo $gender->name; ?>
      </label>
    </div>
  </div>
  <?php endforeach; ?>
  <?php echo CHtml::error($model, 'gender_id'); ?>
  <input class="btn btn-default" type="submit" value="<?php
    echo $this->isAction('create') ? 'Регистрация' : 'Сохранить'; ?>">
</form>
