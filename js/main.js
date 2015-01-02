jQuery(function($) {
  $("table.expenses-list tbody").on("click", function(event){
    var link = $(event.target).siblings("td.hidden").children().attr("href");

    window.location.href = link;
  });
});
