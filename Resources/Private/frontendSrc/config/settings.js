/* eslint-disable import/no-unresolved */
const fs = require('fs');
const assign = require('assign-deep');
const { resolve } = require('path');

const { settings } = require('./settings.webpack');

const developerConfig = fs.existsSync(resolve(settings.DIR.root, 'developer.config.js'))
    ? require('../developer.config')
    : {};

const extras = {
    DEV_HOST: settings.DEV.host,
    DEV_PORT: settings.DEV.port,
    DEV_URI: `http://${settings.DEV.host}:${settings.DEV.port}`,
    NODE_ENV: process.env.NODE_ENV,
    isProduction: process.env.NODE_ENV === 'production',
    isDevelopment: process.env.NODE_ENV === 'development',
};

const mergedSettings = assign(settings, extras, developerConfig);

module.exports = mergedSettings;
