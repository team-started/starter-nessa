<?php

defined('TYPO3_MODE') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    $translationFile = 'LLL:EXT:starter_nessa/Resources/Private/Language/locallang_be.xlf:';

    ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'nessa_ctalink' => [
                'exclude' => true,
                'label' => $translationFile . 'tt_content.nessa_ctalink_formlabel',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 80,
                    'max' => 1024,
                    'eval' => 'trim',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => [
                                'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                                'blindLinkOptions' => 'folder, spec, telephone',
                                'blindLinkFields' => 'class, params, target',
                            ],
                        ],
                    ],
                    'softref' => 'typolink',
                ],
            ],
            'nessa_ctalink_text' => [
                'l10n_mode' => 'prefixLangTitle',
                'exclude' => true,
                'label' => $translationFile . 'tt_content.nessa_ctalink_text_formlabel',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                ],
            ],
            'nessa_teaser_element' => [
                'exclude' => true,
                'label' => $translationFile . 'teaser_element_formlabel',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_starternessa_teaser_element',
                    'foreign_field' => 'tt_content_record',
                    'foreign_sortby' => 'sorting',
                    'minitems' => 1,
                    'maxitems' => 99,
                    'behaviour' => [
                        'allowLanguageSynchronization' => false,
                    ],
                    'appearance' => [
                        'collapseAll' => true,
                        'expandSingle' => true,
                        'levelLinksPosition' => 'bottom',
                        'useSortable' => true,
                        'showPossibleLocalizationRecords' => true,
                        'showRemovedLocalizationRecords' => true,
                        'showAllLocalizationLink' => true,
                        'showSynchronizationLink' => true,
                        'enabledControls' => [
                            'info' => false,
                        ],
                    ],
                ],
            ],
        ]
    );

    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;' . $translationFile . 'palette.cta;nessaCta,',
        'text,textmedia',
        'after:bodytext'
    );
})();
