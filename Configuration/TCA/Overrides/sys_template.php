<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

ExtensionManagementUtility::addStaticFile(
    'starter_nessa',
    'Configuration/TypoScript',
    'Nessa Theme'
);
