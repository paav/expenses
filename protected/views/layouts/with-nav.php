<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp

/* @var $this Controller */

$jobRoute = 'jobExpense/create';
$partRoute = 'partExpense/create'; 
$username = yii::app()->user->name;
$userId = yii::app()->user->id;

$ifAdd = function($route, $class) {
  echo $this->isRoute($route) ? $class : '';
};
?>
<?php $this->beginContent('//layouts/main'); ?>
<nav class="container main-nav">
  <div class="row">
    <div class="col-md-6">
      <ul class="nav nav-links">
        <?php if (!$this->isHome()): ?>
        <li>
          <a href="<?php echo $this->createUrl('expense/index'); ?>">
            <div class="nav-links-label">На главную</div>
          </a>
        <?php endif; ?>
        <li class="<?php $ifAdd($jobRoute, 'active'); ?>">
          <a href="<?php echo $this->createUrl($jobRoute); ?>">
            <div class="nav-links-label">Добавить расход на работу</div>
          </a>
        <li class="<?php $ifAdd($partRoute, 'active'); ?>">
          <a href="<?php echo $this->createUrl($partRoute); ?>">
            <div class="nav-links-label">Добавить расход на запчасть</div>
          </a>
      </ul>
    </div>
    <div class="col-md-6">
      Пользователь: <?php echo CHtml::link($username, array('user/update', 'id'=>$userId)); ?>
      | <?php echo CHtml::link('Выйти', array('site/logout')); ?>
    </div>
  </div>
</nav>
<main class="container">
  <?php echo $content; ?>
</main>
<?php $this->endContent(); ?>
