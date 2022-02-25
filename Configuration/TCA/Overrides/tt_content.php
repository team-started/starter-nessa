<?php

defined('TYPO3_MODE') || die();

(function () {
    // add content element type icons
    foreach (\StarterTeam\StarterNessa\Configuration::getContentElements() as $ceId => $properties) {
        \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
            $GLOBALS['TCA']['tt_content'],
            [
                'ctrl' => [
                    'typeicon_classes' => [
                        $ceId => $properties['typeIconClass'],
                    ],
                ],
            ]
        );
    }

    // define new palettes for content elements
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['tt_content'],
        [
            'palettes' => [
                'nessaCta' => [
                    'showitem' => '
                        nessa_ctalink, nessa_ctalink_text
                    ',
                ],
                'nessaUploads' => [
                    'showitem' =>
                        'media;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.ALT.uploads_formlabel',
                ],
            ],
        ]
    );
})();
