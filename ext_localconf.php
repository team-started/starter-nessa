<?php

defined('TYPO3') || die();

(function () {
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['nessa'] = 'EXT:starter_nessa/Configuration/RTE/Nessa.yaml';
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['nessa-minimal'] = 'EXT:starter_nessa/Configuration/RTE/NessaMinimal.yaml';
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['nessa-headlines'] = 'EXT:starter_nessa/Configuration/RTE/NessaHeadlines.yaml';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['starterteam'] = ['StarterTeam\StarterNessa\ViewHelpers'];
})();
