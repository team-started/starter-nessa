const { resolve } = require('path');
const pkg = require('../package.json');

const root = resolve(__dirname, '../');
const config = resolve(root, 'config');
const src = resolve(root, 'Assets');
const assets = resolve(root, 'Assets');
const dist = resolve(root, '../Resources/Public');

const year = new Date().getFullYear();

const settings = {
    PKG: pkg,
    DIR: {
        root,
        config,
        src,
        assets,
        public: resolve(root, 'public'),
        npmPackages: resolve(root, 'node_modules'),
        fonts: resolve(assets, 'Fonts'),
        images: resolve(assets, 'Images'),
    },
    DEV: {
        showStats: false,
        host: 'localhost',
        port: 8080,
        // https://webpack.js.org/configuration/devtool/
        useSourceMap: true,
        typeSourceMap: 'source-map',
        barOption: { name: 'Development' },
    },
    BUILD: {
        dist,
        jsFolder: 'JavaScript',
        cssFolder: 'Css',
        fontFolder: 'Fonts',
        imageFolder: 'Images',
        showStats: true,
        hashJs: false,
        hashCss: false,
        hashAssets: false,
        buildManifest: false,
        useSourceMap: false,
        // https://webpack.js.org/configuration/devtool/
        typeSourceMap: 'source-map',
        barOption: { name: 'Production', color: '#293ACB' },
        // Adds a banner to the top of each generated chunk.
        banner: `
/*!
 *
 *  ${pkg.name} ${pkg.version}
 *  ${pkg.description}
 *  ============================================================================
 *  author: ${pkg.author}
 *  https://starter.team
 *  ============================================================================
 *  Copyright (c) ${year}, ${pkg.author}
 *  ============================================================================
 *
 */`,
    },
    RESOLVER: {},
    PLUGINS: {
        notifier: false,
    },
    STATS: {
        all: false,
        assets: true,
        excludeAssets: (assetName) => !/\.js$/i.test(assetName),
        assetsSort: 'name',
        chunks: false,
        entrypoints: true,
        assetsSpace: Number.MAX_SAFE_INTEGER,
        moduleAssets: false,
        groupAssetsByChunk: false,
        groupAssetsByEmitStatus: false,
        groupAssetsByInfo: false,
        groupModulesByAttributes: false,
        warnings: true,
        errors: true,
        errorDetails: true,
    },
    OPTIONS: {
        // https://github.com/mikaelbr/node-notifier
        notifier: (type, logo, successSound) => ({
            title: `${pkg.name} ${pkg.version} - ${type}`,
            successSound,
            failureSound: 'Funk',
            suppressSuccess: false,
            activateTerminalOnError: false,
            logo: resolve(config, 'icons', logo),
            failureIcon: resolve(config, 'icons', 'error.png'),
            warningIcon: resolve(config, 'icons', 'warning.png'),
            successIcon: resolve(config, 'icons', 'success.png'),
        }),
    },
};

module.exports = {
    settings,
};
