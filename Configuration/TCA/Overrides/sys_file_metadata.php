<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $translationFile = 'LLL:EXT:starter_nessa/Resources/Private/Language/locallang_be.xlf:';

    ExtensionManagementUtility::addTCAcolumns(
        'sys_file_metadata',
        [
            'nessa_portfolio_link' => [
                'exclude' => true,
                'label' => $translationFile . 'sys_file_metadata.nessa_portfolio_link',
                'config' => [
                    'type' => 'link',
                    'size' => 50,
                    'allowedTypes' => ['page', 'url', 'record'],
                    'appearance' => ['allowedOptions' => ['title', 'rel']],
                ],
            ],
        ]
    );

    ExtensionManagementUtility::addToAllTCAtypes(
        'sys_file_metadata',
        'nessa_portfolio_link',
        '',
        'after:title'
    );
})();
