module.exports = function(grunt) {
  grunt.initConfig({

    less: {
      main: {
        options: {
          //compress: true,
        },

        files: {
          'css/main.css': 'less/main.less', 
        }
      },

      bootstrapCustom: {
        options: {
          //compress: true,
        },

        files: {
          'css/bootstrap-custom.css':
            'less/bootstrap-custom/bootstrap.less', 
        }
      }
    },

    watch: {
      less: {
        files: [
          'less/main.less',
        ],
        tasks: ['less:main'],
        options: {
          spawn: false,
        },
      },

      BootstrapCustom: {
        files: [
          'less/bootstrap-custom/**/*less',
        ],
        tasks: ['less:bootstrapCustom'],
        options: {
          spawn: false,
        },
      },
    },

    bowerRequirejs: {
      target: {
        rjsConfig: 'js/config.js',
        options: {
          baseUrl: 'protected/vendor',
        },
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-bower-requirejs');

  grunt.registerTask('default', ['watch']);
};

