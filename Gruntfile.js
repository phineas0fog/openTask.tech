module.exports = function (grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        jshint: {
            all: ['www/public/js/*.js']
        },

        uglify: {
            options: { mangle: false },
            dist: {
                files: {
                    'www/public/min/min.js': ['www/public/js/*.js']
                }
            }
        },

        cssmin: {
            combine: {
                files: {
                    'www/public/min/min.css': ['www/public/css/reset.css', 'www/public/css/common.css', 'www/public/css/breadCrumb.css', 'www/public/css/buttons.css', 'www/public/css/header.css', 'www/public/css/*.css']
                }
            }
        },

        watch: {
            js: {
                files: ['www/public/js/*.js'],
                tasks: ['jshint', 'uglify'],
                options: { spawn: false}
            },
            css: {
                files: ['www/public/css/*.css'],
                tasks: ['cssmin'],
                options: { spawn: false, livereload: true}
            }
        },

        phpcs: {
            application: {
                src: 'www/**/*.php'
            },
            options: {
                standard: 'Zend'
            }
        },

        phpcbf: {
            files: {
                src: 'www/**/*.php'
            },
            options: {
                standard: 'Zend'
            }
        }

    });

    grunt.registerTask('default', ['jshint', 'uglify', 'cssmin', 'phpcbf']);
}
