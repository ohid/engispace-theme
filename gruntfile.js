module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            sass: {
                files: [
                    'assets/scss/*.scss', 
                    'assets/scss/partials/*.scss',
                ],
                tasks: ['sass']
            },
            cssmin: {
                files: ['assets/css/*.css'],
                tasks: ['cssmin']
            },
            uglify: {
                files: ['assets/js/*.js', 'assets/js/blocks/*.js'],
                tasks: ['uglify']
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'images/'
                }]
            }
        },
        uglify: {
            dev: {
                options: {
                    mangle: {
                        reserved: ['jQuery']
                    }
                },
                files: [{
                    expand: true,
                    cwd: 'assets/js/',
                    src: ['*.js', '!*.min.js', 'blocks/*.js'],
                    dest: 'assets/js/dist',
                    rename: function (dst, src) {
                        return dst + '/' + src.replace('.js', '.min.js');
                    }
                }]
            }
        },
        cssmin: {
            my_target: {
                files: [{
                    expand: true,
                    cwd: 'src/css/',
                    src: ['*.css', '!*.min.css', 'blocks/*.css', '!blocks/*.min.css'],
                    dest: 'assets/dest/css/',
                    ext: '.min.css'
                }]
            }
        },
        sass: {
            dest: {
                files: [{
                    expand: true,
                    cwd: 'assets/scss/',
                    src: ['*.scss', 'blocks/*.scss'],
                    dest: 'assets/css/',
                    ext: '.css'
                }]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify-es');

    grunt.registerTask('default', ['sass', 'cssmin', 'uglify', 'imagemin']);

};