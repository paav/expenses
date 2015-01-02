<!-- # vim: ts=2:sw=2:sts=2
--!>
<?php /* @var $this Controller */ ?>
<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<!DOCTYPE html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/menu.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/js/calendar.css">
    <link rel="stylesheet" href="http://i.icomoon.io/public/temp/8b4d9e3f75/UntitledProject1/style.css">
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,900|Alegreya+Sans:400,900|Bowlby+One+SC' rel='stylesheet' type='text/css'>
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/main.js'); ?>
    <?php Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/calendar.js'); ?>
    <title><?php echo $this->pageTitle; ?></title>
  </head>
  <body>
    <div id="container">
      <div id="menu">
        <ul id="yw2">
          <li><a href="#">Показать ▾</a>
            <ul>
              <li class="active"><a href="<?php echo $this->createAbsoluteUrl('expense/index'); ?>">Все расходы</a></li>
            </ul>
          </li>
          <li><a href="#">Создать ▾</a>
            <ul>
              <li><a class="repair" href="<?php echo $this->createAbsoluteUrl('jobExpense/create'); ?>">Расход на работу</a></li>
              <li><a class="part" href="<?php echo $this->createAbsoluteUrl('partExpense/create'); ?>">Расход на запчасть</a></li>
            </ul>
          </li>
        </ul> 
      </div>
      <!--
      <div id="header">
        <h1>
          Car<img src="<?php echo $baseUrl; ?>/images/buy-24px.png" alt="buy">Expensesi!
        </h1>
      </div>
      !-->
      <div id="content">
        <?php echo $content; ?>
      </div>
      <div id="footer">
        <!--&copy; Alexey Panteleiev, 2014<br>i--!>
      </div>
    </div>
  </body>
</html>
