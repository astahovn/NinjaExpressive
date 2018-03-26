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
                        'public/js/mod_profile.js.map',
                        'public/js/mod_lib.js',
                        'public/js/mod_lib.js.map',
                        'public/js/mod_conversation.js',
                        'public/js/mod_conversation.js.map'
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
                    '.tmp/mod_profile.js': ['assets/js/profile/*.js', 'assets/js/profile/*/*.js'],
                    'public/js/mod_lib.js': ['assets/js/lib/*.js'],
                    'public/js/mod_conversation.js': ['assets/js/conversation/*.js']
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
