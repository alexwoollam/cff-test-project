const gulp = require("gulp"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    sourcemaps = require("gulp-sourcemaps"),
    autoprefixer = require("autoprefixer"),
    runSequence = require("gulp4-run-sequence").use(gulp),
    cssnano = require("cssnano"),
    rename = require("gulp-rename"),
    browserify = require("browserify"),
    source = require("vinyl-source-stream"),
    buffer = require("vinyl-buffer"),
    terser = require("gulp-terser"),
    moduleImporter = require("sass-module-importer"),
    imagemin = require("gulp-imagemin"),
    babelify = require("babelify"),
    paths = {
        input_scss: ["./assets/scss/editor-style.scss", "./assets/scss/style.scss"],
        input_js: ["./assets/js/main.js"],
        input_images: ["./assets/images/**/*"],
        internal_js: ["./assets/js/internal.js"],
        react_js: ["./assets/js/components.js"],
        output_path: ["../Public"],
    };

// Script task to compile multiple output files
const buildScripts = (file, name) => {
    return browserify({
        entries: file,
        debug: true,
    })
        .transform(
            babelify.configure({
                presets: ["@babel/preset-env", "@babel/preset-react"],
                plugins: ["@babel/plugin-proposal-class-properties"],
            })
        )
        .bundle()
        .pipe(source(name))
        .pipe(buffer())
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(terser())
        .pipe(sourcemaps.write("./"))
        .pipe(gulp.dest(paths.output_path + "/js/"));
};

gulp.task("sass", () => {
    return gulp
        .src(paths.input_scss)
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(sass({ importer: moduleImporter() }))
        .pipe(sass().on("error", sass.logError))
        .pipe(
            postcss([
                autoprefixer({
                    overrideBrowserslist: ["last 3 version"],
                    remove: false,
                }),
                cssnano(),
            ])
        )
        .pipe(rename({ dirname: "./" }))
        .pipe(sourcemaps.write("./"))
        .pipe(gulp.dest(paths.output_path + "/css/"));
});

gulp.task("scripts", () => {
    return buildScripts(paths.input_js, "main.js");
});

gulp.task("internal-scripts", () => {
    return buildScripts(paths.internal_js, "internal.js");
});

gulp.task("react-scripts", () => {
    return buildScripts(paths.react_js, "components.js");
});

gulp.task("images", () => {
    return gulp
        .src(paths.input_images)
        .pipe(imagemin())
        .pipe(gulp.dest(paths.output_path + "/images/"));
});

// Tasks
gulp.task("watch", () => {
    runSequence(["scripts", "internal-scripts", "react-scripts"], "sass", "images");
    gulp.watch("./assets/scss/**/*.scss", gulp.series("sass"));
    gulp.watch("./assets/js/**/*.js", gulp.series(["scripts", "internal-scripts", "react-scripts"]));
});

gulp.task("build", (done) => {
    runSequence(["scripts", "internal-scripts", "react-scripts"], "sass", "images");
    done();
});