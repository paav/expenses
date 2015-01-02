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
    var j = 0;
    
    for (var i = 0; i < inputIds.length; i++) {
      var inputJq = $('#' + inputIds[i]); 

      if (inputJq.length == 0) {
        continue;
      }

      inputJq.attr('autocomplete', 'off'); 
      
      var mainDivClass = classPrefix + ' ' + inputIds[i];
      var tableSelector = '.' + classPrefix + '.' + inputIds[i] + ' table';
      inputJq.wrap($('<div class="' + mainDivClass + '"></div>'));

      cals[j] = new Calendar();

      cals[j].appendTo(inputJq);
      cals[j].bindWith(inputJq);
      cals[j].hide();
    
      inputJq.on('click', null, { allCalObjs: cals }, (function(calObj) {
        return function(e) {
          var allCalObjs = e.data.allCalObjs;
          
          if (allCalObjs.length > 1) { 
            for (var i = 0; i < allCalObjs.length; i++) {
              allCalObjs[i].hide();
            }
          }

          calObj.show();
          e.stopPropagation();
        }
      })(cals[j]));

      $('html').on('click', hideCal(cals[j]));

      j++;
    }

    function hideCal(calObj) {
      return function() {
        calObj.hide();
      }
    }

    function Calendar(year, month) {
      var todayDate = new Date
      todayDate.setHours(0, 0, 0, 0);

      year = year || todayDate.getFullYear();
      month = month || todayDate.getMonth();

      var monthFirstDate = new Date(year, month - 1);
      var selectedDate = new Date(todayDate);
      var tableJq = $(render());
      var isBinded = false;
      var inputJq;

      tableJq.on('click', '.date-cell', function() {
        tableJq.find('.selected-cell').removeClass('selected-cell');
        selectedDate = new Date(monthFirstDate);
        selectedDate.setDate(+$(this).addClass('selected-cell').html());

        if (isBinded) {
          inputJq.val(dateFormat(selectedDate));
        }
      });

      tableJq.on('click', '#prev-month', function(e) {
        monthFirstDate.setMonth(monthFirstDate.getMonth() - 1); 
        tableJq.html(render());
        e.stopPropagation();
      });

      tableJq.on('click', '#next-month', function(e) {
        monthFirstDate.setMonth(monthFirstDate.getMonth() + 1); 
        tableJq.html(render());
        e.stopPropagation();
      });

      this.hide = function() {
        tableJq.hide();
      }

      this.show = function() {
        tableJq.show();
      }

      this.appendTo = function(jqObj) {
        jqObj.after(tableJq);
      }

      this.bindWith = function(jqInputObj) {
        if (jqInputObj.prop('tagName') != 'INPUT') {
          throw new Error('not an input jQuery object');
        }

        inputJq = jqInputObj;
        isBinded = true;

        var inputValue = inputJq.val()

        if (inputValue) {
          selectedDate = getDateFromFormat(inputValue);
        } else {
          selectedDate = new Date();
        }

        selectedDate.setHours(0, 0, 0, 0);
        monthFirstDate = new Date(selectedDate.getFullYear(),
          selectedDate.getMonth());

        tableJq.html(render());
      }
      
      function render() {
        year = monthFirstDate.getFullYear();
        month = monthFirstDate.getMonth();

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

          if (+varDate == +todayDate) {
            table += " today-cell";
          }

          if (+varDate == +selectedDate) {
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

      function getDateFromFormat(dateStr) {
        var dateParts = dateStr.split(/[./-]/);
        
        if (dateParts.length > 3) {
          throw new Error('more than three date parts');
        }

        return new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);    
      }

      function dateFormat(dateObj) {
        var delim = '.';

        return strPad(dateObj.getDate()) + delim + strPad(dateObj.getMonth() + 1) + delim
          + dateObj.getFullYear();
      }

      function strPad(str) {
        console.log(str);
        return ('0' + str).slice(-2);
      }
    }
  });
})(jQuery);
