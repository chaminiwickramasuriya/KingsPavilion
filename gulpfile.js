/**
 * The Great GulpFile
 * @Author eMarketingEye
 *
 * @project Kings Pavilion
 * @package Kings Pavilion
 * @since Kings Pavilion 1.0
 *
 * @functionality : SASS/SCSS to CSS (minified) with Sourcemaps, Available modes : production
 * @functionality : JS Concatenate and Minify
 * @functionality : Critical CSS
 * @functionality : Watcher
 *
 * @argument --mode production => To run minifications for SASS
 */

// =================================
//              DEF
// =================================
const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
// const less          = require('gulp-less');
const browserSync = require("browser-sync").create();
const postCSS = require("gulp-postcss");
const cssNano = require("cssnano");
const terser = require("gulp-terser");
const renameFile = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");
const concat = require("gulp-concat");
const chalk = require("chalk");
const { src, dest, watch, series } = require("gulp");

// Critical CSS
const critcCSS = require("gulp-penthouse");

// Development and Production
const yargs = require("yargs").argv;
const gulpif = require("gulp-if");

// Vary
const projectURL = "https://local.revamp.kingspavilion.com/";

// imgMin
const imagemin = require("gulp-imagemin");

// =====================================
//  0. Verify Gulp is workin
// =====================================
function theBasics(basic_cback) {
  console.log(
    chalk.yellow(
      "\r\n\r\n___          __                __       _  __                                        _          \r\n | |_  _    /__ __ _  _ _|_   /__    | |_)|_  o  |  _     o  _     __   __ __  o __ (_|         \r\n | | |(/_   \\_| | (/_(_| |_   \\_||_| | |  |   |  | (/_    | _>     | |_|| || | | | |__| o  o  o \r\n\r\n"
    )
  );
  basic_cback();
}

// =====================================
//  1. Compile and minify SCSS -> CSS
// =====================================
function sassCompiler(sassCallback) {
    console.log(chalk.green("Starting SASS Ops."));
  
    // Compile SCSS to regular CSS
    gulp
      .src("assets/scss/**/*.scss", { sourcemaps: true }) // Select all SCSS files in the directory
      .pipe(sourcemaps.init())
      .pipe(sass().on("error", sass.logError)) // Compile SASS
      .pipe(renameFile({ extname: ".css" })) // Rename to .css
      .pipe(sourcemaps.write(".")) // Write sourcemaps
      .pipe(gulp.dest("./assets/css/")); // Save regular CSS files to assets/css/
  
    // Compile SCSS to minified CSS
    return gulp
      .src("assets/scss/**/*.scss", { sourcemaps: true }) // Select all SCSS files in the directory
      .pipe(sourcemaps.init())
      .pipe(sass().on("error", sass.logError)) // Compile SASS
      .pipe(gulpif(yargs.mode === "production", postCSS([cssNano()]))) // Minify if in production mode
      .pipe(renameFile({ extname: ".min.css" })) // Rename to .min.css
      .pipe(sourcemaps.write(".")) // Write sourcemaps
      .pipe(gulp.dest("./assets/css/")); // Save minified CSS files to assets/css/
  }

// =====================================
//  2. Minify and/or concatenate JS
// =====================================
function jsCompiler(jsCallback) {
  console.log(chalk.green("Starting JS Tasks"));

  return (
    gulp
      .src("assets/js/vendors/**/*.js")

      // Sourcemaps
      .pipe(sourcemaps.init())

      .pipe(
        terser({
          mangle: {
            toplevel: true,
          },
        })
      )

      // concat
      .pipe(concat("all.min.js"))

      .pipe(sourcemaps.write("/"))

      // save js file
      .pipe(gulp.dest("assets/js/"), { sourcemaps: "." })
  );

  jsCallback();
}

// =====================================
//  3. Le Critical CSS
// =====================================

function criticalCSS(cc_cb) {
  console.log(chalk.green("Starting Critical CSS Generation.."));
  return gulp
    .src("./assets/style.min.css")
    .pipe(
      critcCSS({
        out: "",
        // url : 'https://local.revamp.kingspavilion.com/html-prototypes',
        url: "https://local.revamp.kingspavilion.com/",
        width: "1200",
        height: "900",
        // strict : false,
        userAgent:
          "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)",
      })
    )

    .pipe(postCSS([cssNano()]))
    .pipe(
      renameFile({
        extname: "critical_css.php",
      })
    )
    .pipe(gulp.dest("./assets/"));

  cc_cb();
}

// =====================================
//  4. Minify Images
// =====================================

function minifyImages(minify_cb) {
  console.log(chalk.green("Starting image minification.."));

  return gulp
    .src("assets/image_sources/*")
    .pipe(imagemin())
    .pipe(gulp.dest("assets/images"));

  minify_cb();
}

// =====================================
//  5. Watcher Tasks
// =====================================
function watchProject(watcher_cb) {
  browserSync.init({
    proxy: projectURL,
  });

  // gulp.watch('./**/*.scss', series(sassCompiler));

  gulp.watch("./**/*.scss").on("change", series(sassCompiler));
  gulp.watch("./**/*.scss").on("change", browserSync.reload);
  gulp.watch("./**/*.php").on("change", browserSync.reload);
  gulp.watch("./assets/js/vendors/**/*.js").on("change", series(jsCompiler));
  gulp.watch("./**/*.js").on("change", browserSync.reload);
  // Watch over images
  gulp
    .watch("./assets/image_sources/**/*")
    .on("change", series(minifyImages, browserSync.reload));
  gulp
    .watch("./assets/image_sources/**/*")
    .on("add", series(minifyImages, browserSync.reload));

  watcher_cb();
}

// =====================================
//              Task Actions
// =====================================

exports.default = series(
  theBasics,
  sassCompiler,
  jsCompiler,
  watchProject,
  minifyImages
  // criticalCSS,
  // gulpif( yargs.mode == "critical", criticalCSS  )
);

exports.doSASS = series(sassCompiler);
exports.doJS = series(jsCompiler);
exports.doCritical = series(criticalCSS);
exports.watcher = series(sassCompiler, watchProject);
exports.doImages = series(minifyImages);