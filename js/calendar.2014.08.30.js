"use strict";

(function($) {
  window.addEventListener('load', main, false);

  function main() {
    var input = $("#js-calendar").attr("autocomplete", "off")
        .css("margin-bottom", '0');
    var date;
    var table;
    var outerDiv = $('<div class="js-calendar"></div>')
        .css({
          'position': 'relative',
          'display': 'inline-block',
        });
    var tableDiv = $('<div></div>')
        .css({
          'position': 'absolute',
          'margin-top': '-1px',
          'margin-left': input.css('margin-left'),
        });

    if (!input || input.prop("tagName") != "INPUT") {
      console.log('Input element was not found.');     
      return;
    }

    if (input.val()) {
      date = stringToDate(input.val());
    } else {
      date = new Date(); 
      input.val(dateToString(date));
    }

    input.wrap(outerDiv); 
    table = $(getCalendarTable(date)).css({
      'position': 'ablsolute',
    });
    tableDiv.append(table);

    input.after(tableDiv);  
    tableDiv.on('click', '.date-cell', function(event) {
      var target = $(event.target);

      $('.selected-cell').removeClass('selected-cell');
      target.addClass('selected-cell');

      date = new Date(date.getFullYear(), date.getMonth(), target.html());
      input.val(dateToString(date));
    });
    tableDiv.hide();

    input.click(function(event) {
      tableDiv.show();
      event.stopPropagation();
    });

    $('html').click(function() {
      if (tableDiv.is(':visible')) {
        tableDiv.hide();
      }
    });

    return;
  }

  function getCalendarTable(date) {
    var month = date.getMonth();
    var year = date.getFullYear();
    var table = '<table><tr class="month"><th id="left-month">&laquo</th>'
              + '<th colspan="5">' + getMonthName(month)
              + '</th><th id="right-month">&raquo</th></tr>'
              + '<tr><th>пн</th><th>вт</th><th>ср</th><th>чт</th>'
              + '<th>пт</th><th>сб</th><th>вс</th></tr><tr>';
    var varDate = new Date(year, month);
    var lastDate = new Date(year, month + 1, 0);

    for (var i = 0; i < getDay(varDate); i++)  {
      table += '<td></td>';
    }

    while(varDate.getMonth() == month) {
      table += '<td class="date-cell';

      if (varDate.getDate() == date.getDate() &&
          varDate.getMonth() == month) {
        table += ' today-cell selected-cell';
      }

      table += '">' + varDate.getDate() + '</td>';

      
      if (getDay(varDate) % 7 == 6 &&
           varDate.getDate() != lastDate.getDate()) {
        table += '</tr><tr>';
      }

      varDate.setDate(varDate.getDate() + 1);
    }

    if (getDay(varDate) != 0) {
      for (var i = getDay(varDate); i < 7; i++) {
        table += '<td></td>';
      }
    }

    table += '</tr></table>';
    
    return table;
  }

  function getMonthName(monthNum) {
    var monthNames = [
      'Январь',
      'Февраль',
      'Март',
      'Апрель',
      'Май',
      'Июнь',
      'Июль',
      'Август',
      'Сентябрь',
      'Октябрь',
      'Ноябрь',
      'Декабрь',
    ];

    return monthNames[monthNum];
  }

  function getDay(date) {
    var day = date.getDay();

    if (day == 0) day = 7;

    return day - 1;
  }
  
  function stringToDate(strDate) {
    var dateParts = strDate.split('/', 3);

    return new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
  }

  function dateToString(date) {
    return [date.getDate(), date.getMonth() + 1, date.getFullYear()].join('/');
  }
})(jQuery);
