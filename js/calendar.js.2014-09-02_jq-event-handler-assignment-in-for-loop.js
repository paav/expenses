"use strict";

(function($) {
  var inputIds = [
    'cal-from',
    'cal-to',
    'cal',
  ];

  var classPrefix = 'paav-calendar';

  $(function() {
    var cals = [];
    
    for (var i = 0; i < inputIds.length; i++) {
      var inputJq = $('#' + inputIds[i]); 

      if (inputJq.length == 0) {
        continue;
      }

      inputJq.attr('autocomplete', 'off'); 
      
      var mainDivClass = classPrefix + ' ' + inputIds[i];
      var tableSelector = '.' + classPrefix + '.' + inputIds[i] + ' table';
      inputJq.wrap($('<div class="' + mainDivClass + '"></div>'));

      cals[i] = new Calendar(2014, 9);

      var tableJq = $(cals[i].render(2013, 11)).hide();
      inputJq.after(tableJq);

      inputJq.on('click', (function(tableJq) {
        return function(e) {
          $('.' + classPrefix + ' table').hide();
          tableJq.show();
          e.stopPropagation();
        }
      })(tableJq));

      $('html').on('click', hideTable(tableJq));
    }

    function hideTable(tableJq) {
      return function() {
        tableJq.hide();
      }
    }

    function Calendar(year, month) {
      var monthFirstDate = new Date(year, month - 1);
      var selectedDate = new Date(2014, 9, 2);
      var todayDate = new Date();

      this.setDate = function() {
      }

      this.render = function(year, month) {
        if (year) {
          monthFirstDate.setFullYear(year);
        } else {
          year = monthFirstDate.getFullYear();
        }
        
        if (month) {
          monthFirstDate.setMonth(month);
        } else {
          month = monthFirstDate.getMonth();
        }

        var monthName = getMonthName(month);
        var table = '<table class="cal">'
                  + '<tr class="month-selection">'
                  + '<td id="prev-month">&laquo</td>'
                  + '<td colspan="5">' + monthName + ' ' + year + '</td>'
                  + '<td id="next-month">&raquo</td>'
                  + "</tr>"
                  + '<tr class="day-names">'
                  + "<td>пн</td><td>вт</td><td>ср</td><td>чт</td>"
                  + "<td>пт</td><td>сб</td><td>вс</td>"
                  + "</tr>"
                  + "<tr>";

        var varDate = new Date(monthFirstDate);

        for (var i = 0; i < getDay(varDate); i++)  {
          table += "<td></td>";
        }

        var monthLastDateDate = (new Date(year, month + 1, 0)).getDate();

        while(varDate.getMonth() == month) {
          var varDateDate = varDate.getDate();
          var varDateDay = getDay(varDate); 

          table += '<td class="date-cell';

          if (varDate == todayDate) {
            table += " today-cell";
          }

          if (varDate == selectedDate) {
            table += " selected-cell";
          }

          table += '">' + varDateDate + '</td>';

          if (varDateDay % 7 == 6 &&
            varDateDate != monthLastDateDate) {
            table += '</tr><tr>';
          }

          varDate.setDate(varDateDate + 1);
        }

        varDateDay = getDay(varDate);

        if (varDateDay != 0) {
          for (var i = varDateDay; i < 7; i++) {
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
    }
  });
})(jQuery);
