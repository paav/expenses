<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp

/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/* @var $genders Gender array of Gender objects */

if ($this->isAction('create')):
  $this->layout = 'without-nav';
  $header = 'Регистрация';
  $this->pageTitle = 'Регистрация | Expenses';
else:
  $header = 'Редактирование профиля';
  $this->pageTitle = 'Редактирование профиля | Expenses';
endif;
?>
<?php if ($this->id == 'site'): ?>
<nav>
  <div class="row">
    <div class="col-md-3 col-md-offset-9">
      <a href="<?php echo $this->createUrl('site/login'); ?>">Вход</a>
    </div>
  </div>
</nav>
<?php endif; ?>
<div class="row">
  <div class="col-md-5 col-md-offset-4">
    <h1><?php echo $header; ?></h1>
    <?php
        $this->renderPartial('_form', array(
            'model' => $model,
            'genders' => $genders,
        ));
    ?>
  </div>
</div>
