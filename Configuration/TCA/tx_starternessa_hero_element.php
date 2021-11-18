<?php

defined('TYPO3_MODE') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

return (function () {
    $translationFile = 'LLL:EXT:starter_nessa/Resources/Private/Language/locallang_be.xlf:';

    return [
        'ctrl' => [
            'label' => 'header',
            'sortby' => 'sorting',
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'cruser_id' => 'cruser_id',
            'title' => $translationFile . 'hero_element_label',
            'delete' => 'deleted',
            'versioningWS' => true,
            'origUid' => 't3_origuid',
            'hideTable' => true,
            'hideAtCopy' => true,
            'prependAtCopy' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
            'transOrigPointerField' => 'l10n_parent',
            'transOrigDiffSourceField' => 'l10n_diffsource',
            'languageField' => 'sys_language_uid',
            'translationSource' => 'l10n_source',
            'enablecolumns' => [
                'disabled' => 'hidden',
                'starttime' => 'starttime',
                'endtime' => 'endtime',
            ],
            'typeicon_classes' => [
                'default' => 'starter-table-tx_starternessa_hero_element',
            ],
        ],

        'interface' => [
            'showRecordFieldList' => 'hidden, header, bodytext',
        ],

        'types' => [
            '1' => [
                'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    header,LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.html_formlabel,
                    bodytext,
                    --palette--;' . $translationFile . 'palette.cta;cta,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
                    assets,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
            ],
        ],

        'palettes' => [
            'hidden' => [
                'showitem' => '
                hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden
            ',
            ],
            'language' => [
                'showitem' => '
                sys_language_uid;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:sys_language_uid_formlabel,
                l10n_parent
            ',
            ],
            'access' => [
                'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
            ',
            ],
            'cta' => [
                'showitem' => 'ctalink, ctalink_text',
            ],
        ],

        'columns' => [
            'hidden' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
                'config' => [
                    'type' => 'check',
                    'items' => [
                        '1' => [
                            '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0',
                        ],
                    ],
                ],
            ],
            'starttime' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputDateTime',
                    'eval' => 'datetime',
                    'default' => 0,
                ],
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
            ],
            'endtime' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputDateTime',
                    'eval' => 'datetime',
                    'default' => 0,
                    'range' => [
                        'upper' => mktime(0, 0, 0, 1, 1, 2038),
                    ],
                ],
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
            ],
            'sys_language_uid' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'special' => 'languages',
                    'items' => [
                        [
                            'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                            -1,
                            'flags-multiple',
                        ],
                    ],
                    'default' => 0,
                ],
            ],
            'l10n_parent' => [
                'exclude' => true,
                'displayCond' => 'FIELD:sys_language_uid:>:0',
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            '',
                            0,
                        ],
                    ],
                    'foreign_table' => 'tx_starternessa_hero_element',
                    'foreign_table_where' => 'AND tx_starternessa_hero_element.pid=###CURRENT_PID### AND tx_starternessa_hero_element.sys_language_uid IN (-1,0)',
                    'default' => 0,
                ],
            ],
            'l10n_source' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],
            'header' => [
                'l10n_mode' => 'prefixLangTitle',
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255,
                    'eval' => 'trim,required',
                ],
            ],
            'ctalink' => [
                'exclude' => true,
                'label' => $translationFile . 'tt_content.nessa_ctalink_formlabel',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 50,
                    'max' => 1024,
                    'eval' => 'trim',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => [
                                'title' => $translationFile . 'tt_content.nessa_ctalink_formlabel',
                                'blindLinkOptions' => 'folder, spec, telephone, url',
                                'blindLinkFields' => 'class, params, target',
                            ],
                        ],
                    ],
                    'softref' => 'typolink',
                ],
            ],
            'ctalink_text' => [
                'l10n_mode' => 'prefixLangTitle',
                'exclude' => true,
                'label' => $translationFile . 'tt_content.nessa_ctalink_text_formlabel',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                ],
            ],
            'assets' => [
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references',
                'config' => ExtensionManagementUtility::getFileFieldTCAConfig(
                    'assets',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                        ],
                        'minitems' => 1,
                        'maxitems' => 1,
                        // custom configuration for displaying fields in the overlay/reference table
                        // behaves the same as the image field.
                        'overrideChildTca' => [
                            'columns' => [
                                'uid_local' => [
                                    'config' => [
                                        'appearance' => [
                                            'elementBrowserAllowed' => 'jpg,jpeg,png',
                                        ],
                                    ],
                                ],
                            ],
                            'types' => [
                                '0' => [
                                    'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                --palette--;;videoOverlayPalette,
                                --palette--;;filePalette',
                                ],
                            ],
                        ],
                    ],
                    $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
                ),
            ],
            'bodytext' => [
                'l10n_mode' => 'prefixLangTitle',
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.text',
                'config' => [
                    'type' => 'text',
                    'cols' => '80',
                    'rows' => '10',
                ],
            ],

            'l10n_diffsource' => [
                'config' => [
                    'type' => 'passthrough',
                    'default' => '',
                ],
            ],
            't3ver_label' => [
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'max' => 255,
                ],
            ],
        ],
    ];
})();
