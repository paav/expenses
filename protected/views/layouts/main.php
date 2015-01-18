<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this Controller
 */
$baseUrl = Yii::app()->request->baseUrl;

$jobRoute = 'jobExpense/create';
$partRoute = 'partExpense/create'; 
$user = yii::app()->user;

if (!$user->isGuest)
  $gender = $user->gender == Gender::MALE ? 'male' : 'female';

$getPageClass = function() {
  $classes = [
    'site/login'=>'login-page',
    'expense/index'=>'expenses-page',
  ];

  return isset($classes[$this->route]) ? ' ' . $classes[$this->route] : '';
};

$ifAdd = function($route, $class) {
  echo $this->isRoute($route) ? $class : '';
};

$isSimpleNav = function($route) {
  $routes = [
    'site/login',
    'user/create',
  ];

  return in_array($route, $routes);
}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<link href="//fonts.googleapis.com/css?family=Ubuntu:400,500,700&subset=latin,cyrillic"
      rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo $baseUrl; ?>/protected/vendor/bootstrap/js/dropdown.js"></script>
<link href="<?php echo $baseUrl; ?>/protected/vendor/bootstrap-custom/bootstrap-custom.css"
      rel="stylesheet">
<link href="<?php echo $baseUrl; ?>/css/main.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
      rel="stylesheet">
<title><?php echo $this->pageTitle; ?></title>
<?php // To move footer to the page bottom. ?>
<div class="l-rootContainer<?php echo $getPageClass(); ?>">
  <?php if ($isSimpleNav($this->route)): ?>
  <nav class="container">
    <ul class="nav nav-links pull-right">
      <li>
        <a href="<?php echo $this->createUrl('site/login'); ?>">Вход</a>
      <li>
        <a href="<?php echo $this->createUrl('user/create'); ?>">Регистрация</a>
    </ul>
  </nav>
  <?php else: ?>
  <nav class="container">
    <div class="row">
      <div class="col-md-4">
        <ul class="nav nav-links nav-links-rollover rolloverContainer-1">
          <?php if (!$this->isHome()): ?>
          <li>
            <a href="<?php echo $this->createUrl('expense/index'); ?>">
              <div class="rollover">
                <div class="rollover-img"></div>
                <div class="rollover-label">На главную</div>
              </div>
            </a>
          <?php endif; ?>
          <li class="<?php $ifAdd($jobRoute, 'active'); ?>">
            <a href="<?php echo $this->createUrl($jobRoute); ?>">
              <div class="rollover">
                <div class="rollover-img"></div>
                <div class="rollover-label">Добавить расход на работу</div>
              </div>
            </a>
          <li class="<?php $ifAdd($partRoute, 'active'); ?>">
            <a href="<?php echo $this->createUrl($partRoute); ?>">
              <div class="rollover">
                <div class="rollover-img"></div>
                <div class="rollover-label">Добавить расход на запчасть</div>
              </div>
            </a>
        </ul>
      </div>
      <div class="col-md-4">
        <ul class="nav nav-links nav-links-rollover rolloverContainer-2">
          <li>
            <a href="<?php echo $this->createurl('user/update', array('id'=>$user->id)); ?>">
              <div class="rollover">
                <img src="<?php echo $baseUrl . '/images/avatar_' . $gender . '.png'; ?>"></img>
                <img src="<?php echo $baseUrl . '/images/avatar_' . $gender . '_hover.png'; ?>"></img>
                <div class="rollover-label"><?php echo $user->name; ?></div>
              </div>
            </a>
        </ul>
      </div>
      <div class="col-md-2">
        <ul class="nav nav-links nav-links-rollover rolloverContainer-3">
          <li>
            <a href="<?php echo $this->createurl('site/logout', array('id'=>$user->id)); ?>">
              <div class="rollover">
                <div class="rollover-img"></div>
              </div>
            </a>
        </ul>
      </div>
    </div>
  </nav>
  <?php endif; ?>
  <main class="container">
    <?php echo $content; ?>
  </main>
  <footer>
    <?php // container class here because of footer absolute position. ?>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <p class="text-center">Expenses v0.1.0</p>
        </div>
      </div>
    </div>
  </footer>
</div>
