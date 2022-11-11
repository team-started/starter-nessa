<?php

defined('TYPO3') || die();

(function () {
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['nessa'] = 'EXT:starter_nessa/Configuration/RTE/Nessa.yaml';
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['nessa-minimal'] = 'EXT:starter_nessa/Configuration/RTE/NessaMinimal.yaml';
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['nessa-headlines'] = 'EXT:starter_nessa/Configuration/RTE/NessaHeadlines.yaml';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['starterteam'][] = 'StarterTeam\StarterNessa\ViewHelpers';

    if (TYPO3_MODE === 'BE') {
        // Add default UserTSConfig
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
            "@import 'EXT:starter_nessa/Configuration/TSConfig/User/Default.typoscript'"
        );

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Imaging\IconRegistry::class
        );

        foreach (\StarterTeam\StarterNessa\Configuration::getContentElements() as $property) {
            $iconRegistry->registerIcon(
                $property['typeIconClass'],
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => $property['typeIconPath']]
            );
        }

        foreach (\StarterTeam\StarterNessa\Configuration::getContentElementTables() as $property) {
            $iconRegistry->registerIcon(
                $property['typeIconClass'],
                \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
                ['source' => $property['typeIconPath']]
            );
        }

        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['starterNessa_CtaFieldUpdateWizard']
            = \StarterTeam\StarterNessa\Updates\CtaFieldMigration::class;
    }
})();
