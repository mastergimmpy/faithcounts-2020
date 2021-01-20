const path = require("path");
const webpack = require("webpack");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const WriteFilePlugin = require("write-file-webpack-plugin");
const WPFunctionsPlugin = require("./wp-functions-plugin.js");

// setup environmental vars
require("dotenv").config();

const isProd = process.env.NODE_ENV === "production";
const devPath = process.env.DEV_PATH;
const prodPath = path.resolve(__dirname, process.env.THEME_NAME);

const distPath = isProd ? prodPath : devPath;

function recursiveIssuer(m) {
  if (m.issuer) {
    return recursiveIssuer(m.issuer);
  } else if (m.name) {
    return m.name;
  } else {
    return false;
  }
}

const config = {
  mode: isProd ? "production" : "development",
  watch: isProd ? false : true,
  watchOptions: {
    ignored: /node_modules/
  },
  entry: {
    main: "./src/js/main.js",
    editor: "./src/js/main-block.js"
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        mainStyles: {
          name: "bundle",
          test: (m, c, curry, entry = "main") => m.constructor.name === "CssModule" && recursiveIssuer(m) === entry,
          chunks: "all",
          enforce: true
        },
        editorStyles: {
          name: "bundle",
          test: (m, c, curry, entry = "editor") => m.constructor.name === "CssModule" && recursiveIssuer(m) === entry,
          chunks: "all",
          enforce: true
        }
      }
    }
  },
  output: {
    path: distPath,
    publicPath: isProd ? "./" : `${process.env.BASE_FOLDER}/wp-content/themes/${process.env.THEME_NAME}/`,
    filename: isProd ? "[name].[hash].js" : "[name].js"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"]
          }
        }
      },
      {
        test: /\.s?css$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", "postcss-loader"]
      },
      {
        test: /\.(png|jpg|gif|ttf|svg|otf|woff|woff2|eot)$/,
        loader: "file-loader",
        options: {
          context: "src/",
          name: "[path][name].[ext]"
          // publicPath: ''
        }
      }
    ]
  },
  // devServer: {
  //   index: '',
  //   publicPath: '/',
  //   proxy: {
  //     '/': {
  //       target: process.env.DEV_URL,
  //       changeOrigin: true,
  //     },
  //   },
  //   hot: false
  // },
  plugins: [
    new webpack.NamedModulesPlugin(),
    new WPFunctionsPlugin({
      path: path.resolve(distPath, "functions.php"),
      disable: !isProd
    }),
    new CleanWebpackPlugin({
      // verbose: true,
      cleanStaleWebpackAssets: false
    }),
    new MiniCssExtractPlugin({
      filename: isProd ? "[name].[hash].css" : "css/[name].css"
    }),
    new CopyWebpackPlugin([
      {
        from: "**/*",
        to: distPath,
        context: "src/",
        ignore: ["css/**/*", "js/**/*.js", "fonts/**/*"],
        transform(content, filePath) {
          if (filePath.includes(`src${path.sep}functions.php`)) {
            let contentString = content.toString("utf8");

            if (isProd) {
              contentString = contentString.replace(
                'add_filter("acf/settings/show_admin", "__return_true");',
                'add_filter("acf/settings/show_admin", "__return_false");'
              );
            } else {
              contentString = contentString.replace(
                "$path = $orig_path; // ACF PATH SETTING",
                `$path = '${path.resolve(__dirname, "src/acf-json")}';`
              );
            }

            return Buffer.from(contentString, "utf8");
          }
          return content;
        }
      },
      {
        from: "img/favicons/**/*",
        to: distPath,
        context: "src/"
      }
    ]),
    new WriteFilePlugin({
      test: /\.php$/
    })
  ]
};

module.exports = config;
