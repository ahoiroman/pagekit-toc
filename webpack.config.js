const CopyWebpackPlugin = require ('copy-webpack-plugin');
const path = require('path');

module.exports = [
	{
		entry: {
			"toc-settings": "./app/components/toc-settings.vue",
			"toc-widget": "./app/components/toc-widget.vue"
		},
		output: {
			filename: "./app/bundle/[name].js"
		},
		plugins: [
			new CopyWebpackPlugin ([
				{
					from: './node_modules/tocbot/dist',
					to: './app/assets/tocbot'
				}
			], {
				ignore: [
					'*.txt'
				],
				copyUnmodified: true
			})
		],
		module: {
			loaders: [
				{test: /\.vue$/, loader: "vue"},
				{test: /\.js$/, exclude: /node_modules/, loader: "babel-loader"}
			]
		}
	}

];