# Frontend theme Starter Nessa Starterkit

## Setup

Requires a node version `>=16 <17` and npm version `>=8`

## Application architecture

* [ITCSS](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/)
* [Sass](https://sass-lang.com/)
* [PostCSS](https://postcss.org/)
* [Babel](https://babeljs.io/)
* [webpack](https://webpack.js.org/)

## Install dependencies with npm

```sh
# switch to node version >=16 <17
$ nvm use

# install dependencies
$ npm i
```

### Production

```sh
# build assets for production with minifications
$ npm run build
```

### Linting

> [eslint](https://eslint.org/)
> [stylelint](https://stylelint.io/)

```sh
# lint js/css
$ npm run lint

# lint js
$ npm run lint:js

# lint css
$ npm run lint:css
```

## Configuration

### Webpack

Webpack setting's can be done in `config/settings.webpack.js`

### Developer Settings

Developer settings can be done in `developer.config.js`. First duplicate `developer.config.js.tmpl` and rename it to `developer.config.js`.

| Name           | Type | Default    | Categorie | Info                                                                             |
| -------------- | ---- | ---------- | --------- | -------------------------------------------------------------------------------- |
| notifier       | BOL  | false      | PLUGIN    | [webpack-build-notifier](https://www.npmjs.com/package/webpack-build-notifier)   |
| showStats      | BOL  | false      | DEV       |                                                                                  |
| useSourceMap   | BOL  | true       | DEV       |                                                                                  |
| typeSourceMap  | STR  | source-map | DEV       | [Devtool](https://webpack.js.org/configuration/devtool/)                         |
| bundleAnalyzer | BOL  | false      | BUILD     | [webpack-bundle-analyzer](https://www.npmjs.com/package/webpack-bundle-analyzer) |


### Vscode Settings

Duplicate `.vscode.tmpl` and rename it to `.vscode`.
