'use strict';
module.exports = function(grunt) {
    require("load-grunt-tasks")(grunt); // npm install --save-dev load-grunt-tasks

    grunt.initConfig({
        clean: {
            dist: {
                files: [{
                    dot: true,
                    src: [
                        '.tmp',
                        'public/js/mod_profile.js',
                        'public/js/mod_profile.js.map'
                    ]
                }]
            },
            server: '.tmp'
        },

        concat: {
            options: {
                sourceMap: true,
                sourceMapStyle: 'link',
                separator: ';',
            },
            dist: {
                files: {
                    '.tmp/mod_profile.js': ['assets/js/profile/*.js'],
                }
            },
        },

        babel: {
            options: {
                sourceMap: true,
                presets: ['env'],
                plugins: ['transform-react-jsx']
            },
            dist: {
                files: {
                    "public/js/mod_profile.js": ".tmp/mod_profile.js",
                }
            }
        }
    });

    grunt.registerTask('default', [
        'clean',
        'concat',
        'babel'
    ]);
};
