<?php

$EM_CONF['starter_nessa'] = [
    'title' => 'Starter nessa',
    'description' => 'Theme extension for EXT:starter with bootstrap',
    'category' => 'theme',
    'author' => 'StarterTeam',
    'state' => 'stable',
    'version' => '1.0.1-dev',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
            'starter' => '*',
            "starter_sitepackage" => '*'
        ],
        'conflicts' => [],
        'suggests' => [],
    ]
];
