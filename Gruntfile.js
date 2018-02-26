'use strict';
module.exports = function(grunt) {
    require("load-grunt-tasks")(grunt); // npm install --save-dev load-grunt-tasks

    grunt.initConfig({
        "babel": {
            options: {
                sourceMap: true,
                presets: ['env'],
                plugins: ['transform-react-jsx']
            },
            dist: {
                files: {
                    "public/js/profile/test.min.js": "public/js/profile/test.js"
                }
            }
        }
    });

    grunt.registerTask("default", ["babel"]);
};
