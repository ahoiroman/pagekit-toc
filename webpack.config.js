module.exports = [
	{
		entry: {
			"toc-settings": "./app/components/toc-settings.vue",
			"toc-widget": "./app/components/toc-widget.vue"
		},
		output: {
			filename: "./app/bundle/[name].js"
		},
		module: {
			loaders: [
				{test: /\.vue$/, loader: "vue"},
				{test: /\.js$/, exclude: /node_modules/, loader: "babel-loader"}
			]
		}
	}

];