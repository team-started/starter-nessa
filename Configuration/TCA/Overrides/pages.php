<?php
defined('TYPO3_MODE') || die();

use StarterTeam\StarterNessa\Configuration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::registerPageTSConfigFile(
    'starter_nessa',
    'Configuration/TSConfig/PageTs.typoscript',
    'PageTs starter_nessa'
);

(function () {
    foreach (Configuration::getDefaultBackendLayouts() as $backendLayout) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
            'starter_nessa',
            'Configuration/TSConfig/BackendLayouts/' . (string)$backendLayout . '.typoscript',
            'Backend-Layout ' . (string)$backendLayout
        );
    }

    $translationFile = 'LLL:EXT:starter_nessa/Resources/Private/Language/locallang_be.xlf:';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'pages',
        [
            'nessa_social_element' => [
                'exclude' => true,
                'label' => $translationFile . 'social_element_formlabel',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_starternessa_social_element',
                    'foreign_field' => 'pages_record',
                    'foreign_sortby' => 'sorting',
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
                    ]
                ],
            ]
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'pages',
        'twittercards',
        '--linebreak--,nessa_social_element',
        'after:twitter_card'
    );
})();
