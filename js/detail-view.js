(function($){
  table = $('table[id^="yw"].detail-view');

  table.on('click', function(e) {
    $(this).find('td').not(e.target).removeClass('selected');
    $(e.target).toggleClass('selected');
  }); 
})(jQuery);
