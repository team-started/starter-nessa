<?php

defined('TYPO3') || die();

(function () {
    $tables = array_keys(\StarterTeam\StarterNessa\Configuration::getContentElementTables());
    foreach ($tables as $table) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
            (string)$table
        );
    }
})();
