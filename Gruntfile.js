module.exports = function(grunt) {
  grunt.initConfig({

    less: {
      compileLess: {
        options: {
          //compress: true,
        },

        files: {
          'css/main.css': 'less/main.less', 
        }
      },

      compileBootstrapOverrides: {
        options: {
          //compress: true,
        },

        files: {
          'protected/vendor/bootstrap-custom/bootstrap-custom.css':
            'protected/vendor/bootstrap-custom/bootstrap-custom.less', 
        }
      }
    },

    watch: {
      less: {
        files: [
          'less/main.less',
        ],
        tasks: ['less:compileLess'],
        options: {
          spawn: false,
        },
      },

      BootstrapOverridesLess: {
        files: [
          'protected/vendor/bootstrap-custom/**/*less',
        ],
        tasks: ['less:compileBootstrapOverrides'],
        options: {
          spawn: false,
        },
      },
    },
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');

  grunt.registerTask('default', ['watch']);
};

