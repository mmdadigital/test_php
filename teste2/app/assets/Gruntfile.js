module.exports = function (grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {
          trace: true,
        },
        files: {
          'css/app.min.css': 'scss/app.scss',
        },
      },
    },
    autoprefixer: {
      dist: {
        files: {
          'css/app.min.css': 'css/app.min.css',
        },
      },
    },
    watch: {
      css: {
        files: 'scss/**/*.scss',
        tasks: ['sass', 'autoprefixer'],
      },
    },
  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');

  grunt.registerTask('default', ['watch']);
}
