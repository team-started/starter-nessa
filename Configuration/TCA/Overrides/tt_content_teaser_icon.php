<?php

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $translationFile = 'LLL:EXT:starter_nessa/Resources/Private/Language/locallang_be.xlf:';
    $cType = 'nessa_teaser_icon';

    $GLOBALS['TCA']['tt_content']['types'][$cType] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.html_formlabel,
                nessa_teaser_element,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
            'nessa_teaser_element' => [
                'config' => [
                    'overrideChildTca' => [
                        'columns' => [
                            'assets' => [
                                'config' => [
                                    'allowed' => 'svg',
                                    'overrideChildTca' => [
                                        'columns' => [
                                            'uid_local' => [
                                                'config' => [
                                                    'appearance' => [
                                                        'elementBrowserAllowed' => 'svg',
                                                    ],
                                                ],
                                            ],
                                        ],
                                        'types' => [
                                            '0' => [
                                                'showitem' => '
                                                    --palette--;;nessaTeaserIconOverlayPalette,
                                                    --palette--;;filePalette',
                                            ],
                                            File::FILETYPE_IMAGE => [
                                                'showitem' => '
                                                    --palette--;;nessaTeaserIconOverlayPalette,
                                                    --palette--;;filePalette',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'types' => [
                            '1' => [
                                'showitem' => '
                                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                                        header,
                                        assets,
                                        bodytext,
                                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                                        --palette--;;language,
                                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                                        --palette--;;hidden,
                                        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
                                ',
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
