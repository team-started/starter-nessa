module.exports = {
    extends: [
        'stylelint-config-standard',
        'stylelint-config-standard-scss',
        'stylelint-config-idiomatic-css',
        'stylelint-config-prettier',
    ],
    plugins: ['stylelint-order'],
    ignoreFiles: ['node_modules/**', 'Assets/Fonts/**'],
    overrides: [
        {
            files: ['*.vue', '**/*.vue', '*.scss', '**/*.scss'],
            customSyntax: 'postcss-scss',
        },
    ],
    rules: {
        'at-rule-no-unknown': [
            true,
            {
                ignoreAtRules: [
                    'use',
                    'extend',
                    'extends',
                    'ignores',
                    'include',
                    'mixin',
                    'if',
                    'else',
                    'media',
                    'for',
                    'each',
                    'debug',
                    'warn',
                ],
            },
        ],
        // 'order/order': ['custom-properties', 'declarations'],
        // 'order/properties-order': ['width', 'height'],
        'scss/at-import-no-partial-leading-underscore': null,
        'scss/at-import-partial-extension': null,
        // Bootstrap hat Funktionen, die dem Standard nicht entsprechen! https://sass-lang.com/documentation/cli/migrator
        'scss/no-global-function-names': null,
        'scss/at-extend-no-missing-placeholder': null,
        'function-no-unknown': null,
        'selector-class-pattern': null,
        'scss/dollar-variable-pattern': null,
        'scss/percent-placeholder-pattern': null,
    },
};
