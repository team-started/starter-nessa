module.exports = {
    root: true,
    env: {
        node: true,
        browser: true,
        es2021: true,
        commonjs: true,
        es6: true,
        jquery: true,
    },
    extends: ['eslint:recommended', 'plugin:prettier/recommended', 'prettier'],
    parserOptions: {
        ecmaVersion: 2021,
        sourceType: 'module',
    },
    settings: {
        'import/resolver': {
            webpack: {
                config: 'config/webpack.common.js',
            },
        },
    },
    plugins: ['import', 'simple-import-sort'],
    rules: {
        'no-console': process.env.NODE_ENV === 'production' ? 'off' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'off' : 'off',
        'no-unused-vars': 'warn',
        // turn on errors for missing imports
        'import/no-unresolved': 'error',
        // // turn on errors for sorting imports
        'simple-import-sort/imports': 'error',
        'simple-import-sort/exports': 'error',
    },
};
