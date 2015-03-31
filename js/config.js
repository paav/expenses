require.config({
  baseUrl: '/expenses/vendor',
  paths: {
    calendar: 'calendar/calendar',
    lib: 'lib/lib',
    pdate: 'pdate/pdate',
    jquery: '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min',
  },

  packages: [

  ],

  map: {
    '*': {
      'css': 'require-css/css',
    }
  }
});
