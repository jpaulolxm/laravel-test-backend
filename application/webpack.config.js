const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },

    devServer: {
        // ...
        host: '0.0.0.0',
        port: 3000,
        // ...
    }

};
