<?php

defined('TYPO3') || die();

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
})();
