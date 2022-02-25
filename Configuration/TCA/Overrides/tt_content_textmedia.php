<?php

defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets'] = [
        'config' => [
            'minitems' => 1,
            'maxitems' => 1,
        ],
    ];
})();
