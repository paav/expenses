<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
// @var $this Controller

// TODO: move to php file.
$baseUrl = Yii::app()->request->baseUrl;
?>
<!DOCTYPE html>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo $baseUrl; ?>/protected/vendor/bootstrap/js/dropdown.js"></script>
<link href="<?php echo $baseUrl; ?>/protected/vendor/bootstrap-custom/bootstrap-custom.css" rel="stylesheet">
<link href="<?php echo $baseUrl; ?>/css/main-old.css" rel="stylesheet">
<link href="<?php echo $baseUrl; ?>/css/main.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,900|Alegreya+Sans:400,900|Bowlby+One+SC" rel="stylesheet">
<title><?php echo $this->pageTitle; ?></title>
<nav class="navbar navbar-default">
  <ul class="nav navbar-nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        Показать <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo $this->createAbsoluteUrl('expense/index'); ?>">Все расходы</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        Создать <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo $this->createAbsoluteUrl('jobExpense/create'); ?>">Расход на работу</a></li>
        <li><a href="<?php echo $this->createAbsoluteUrl('partExpense/create'); ?>">Расход на запчасть</a></li>
      </ul>
    </li>
  </ul>
</nav>
<main class="container">
  <?php echo $content; ?>
</main>
<footer>
  Footer goes here
</footer>
