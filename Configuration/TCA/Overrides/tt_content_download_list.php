<?php

defined('TYPO3_MODE') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    $translationFile = 'LLL:EXT:starter_nessa/Resources/Private/Language/locallang_be.xlf:';
    $cType = 'nessa_download_list';

    $GLOBALS['TCA']['tt_content']['types'][$cType] = [
        'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media;nessaUploads,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
        'columnsOverrides' => [
            'media' => [
                'config' => [
                    'minitems' => 1,
                    'maxitems' => 99,
                    'overrideChildTca' => [
                        'columns' => [
                            'uid_local' => [
                                'config' => [
                                    'appearance' => [
                                        'elementBrowserAllowed' => 'doc,docx,jpg,jpeg,pdf,ppt,pptx,xls,xlsx,zip',
                                    ],
                                ],
                            ],
                            'title' => [
                                'label' => $translationFile . 'sys_file_reference.title',
                                'config' => [
                                    'max' => 80,
                                ],
                            ],
                            'description' => [
                                'label' => $translationFile . 'sys_file_reference.description',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    ExtensionManagementUtility::addPlugin(
        [
            $translationFile . 'CType.I.' . $cType,
            $cType,
            'starter-ctype-' . $cType,
        ],
        'CType',
        'starter_nessa'
    );
})();
