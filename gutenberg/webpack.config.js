const path = require("path");

module.exports = {
  mode: "production",
  entry: "./gutenberg-helper.src.js",
  output: {
    filename: "gutenberg-helper.js",
    path: path.resolve(__dirname),
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: "babel-loader",
          options: {
            presets: [["@babel/preset-env"], ["@babel/preset-react"]],
          },
        },
      },
    ],
  },
};
