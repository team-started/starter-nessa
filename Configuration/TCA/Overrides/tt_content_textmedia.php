<?php

defined('TYPO3_MODE') || die();

(function () {
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets'] = [
        'config' => [
            'minitems' => 1,
            'maxitems' => 1,
        ],
    ];
})();
