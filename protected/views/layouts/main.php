<?php
// vim: ts=2:sw=2:sts=2:ft=htmlphp
/**
 * @var $this Controller
 */
$baseUrl = Yii::app()->request->baseUrl;
?>
<!DOCTYPE html>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo $baseUrl; ?>/protected/vendor/bootstrap/js/dropdown.js"></script>
<link href="<?php echo $baseUrl; ?>/protected/vendor/bootstrap-custom/bootstrap-custom.css"
      rel="stylesheet">
<link href="<?php echo $baseUrl; ?>/css/main-old.css" rel="stylesheet">
<link href="<?php echo $baseUrl; ?>/css/main.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
      rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,900|Alegreya+Sans:400,900|Bowlby+One+SC"
      rel="stylesheet">
<title><?php echo $this->pageTitle; ?></title>
  <?php echo $content; ?>
<footer>
  Footer goes here
</footer>
