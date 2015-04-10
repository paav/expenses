<?php
// vim: ft=htmlphp

/* @var $this PaavPager */
/* @var $items Object */
/* @var $urls Object */

$disabled = function($isPrev = true) use ($items) {
  if ($isPrev && $items->fromItem == 1 ||
     !$isPrev && $items->toItem == $items->itemCount) 
    echo ' disabled';
}
?>
<div class="paavPager pull-right">
  <?php echo $items->fromItem; ?> – <?php echo $items->toItem; ?> из <?php echo $items->itemCount; ?>
  <div class="btn-group">
    <a class="btn btn-default<?php $disabled(); ?>" href="<?php echo $urls->prevPage; ?>"><i class="fa fa-chevron-left"></i></a>
    <a class="btn btn-default<?php $disabled(false); ?>" href="<?php echo $urls->nextPage; ?>"><i class="fa fa-chevron-right"></i></a>
  </div>
</div>

