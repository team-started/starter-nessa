<?php

defined('TYPO3_MODE') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::addStaticFile(
    'starter_nessa',
    'Configuration/TypoScript',
    'Starter Nessa Theme'
);
