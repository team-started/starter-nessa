<?php

use TYPO3\CMS\Core\Utility\ArrayUtility;

defined('TYPO3') || die();

// @codingStandardsIgnoreStart

(function () {
    // define new palettes for content elements
    ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['tt_content'],
        [
            'palettes' => [
                'nessaCta' => [
                    'showitem' => 'tx_starter_ctalink, tx_starter_ctalink_text',
                ],
            ],
        ]
    );
})();

// @codingStandardsIgnoreEnd
