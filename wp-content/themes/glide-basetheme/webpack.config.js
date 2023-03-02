/**
 * External Dependencies
 */
const path = require("path");
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

/**
 * WordPress Dependencies
 */
const defaultConfig = require("@wordpress/scripts/config/webpack.config.js");

module.exports = {
	...defaultConfig,
	...{
		entry: {
			style: path.resolve(process.cwd(), "assets/src/css", "bundle.scss"),
			editor: path.resolve(
				process.cwd(),
				"assets/src/css",
				"editor-style.scss"
			),
			script: path.resolve(process.cwd(), "assets/src/js", "bundle.jsx"),
		},
		output: {
			filename: "[name].min.js",
			path: path.resolve(process.cwd(), "assets/build"),
		},
	},
	plugins: [
		...defaultConfig.plugins,
		new FixStyleOnlyEntriesPlugin(),
		new MiniCssExtractPlugin({ filename: "[name].min.css" }),
	],
	performance: {
		assetFilter: function (assetFilename) {
			return (
				assetFilename.endsWith(".js") ||
				assetFilename.endsWith(".css") ||
				assetFilename.endsWith(".webp") ||
				assetFilename.endsWith(".svg")
			);
		},

		hints: "warning",
		maxAssetSize: 100000,
	},
};
