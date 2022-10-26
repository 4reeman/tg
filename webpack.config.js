const path = require('path');

module.exports = {
    entry: [
        __dirname + '/App/assets/js/index.js',
        __dirname + '/App/assets/scss/style.scss'
    ],
    output: {
        path: path.resolve(__dirname + '/App/public', 'dist'),
        filename: 'js/index.min.js',
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: [],
            }, {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'file-loader',
                        options: { outputPath: 'css/', name: '[name].min.css'}
                    },
                    'sass-loader'
                ]
            }
        ]
    }
};
