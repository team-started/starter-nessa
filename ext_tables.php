<?php
defined('TYPO3_MODE') || die();

use StarterTeam\StarterNessa\Configuration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    $tables = array_keys(Configuration::getContentElementTables());
    foreach ($tables as $table) {
        ExtensionManagementUtility::allowTableOnStandardPages(
            (string) $table
        );
    }
})();
