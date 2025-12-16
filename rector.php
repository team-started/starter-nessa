<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\ValueObject\PhpVersion;
use Ssch\TYPO3Rector\Set\Typo3LevelSetList;
use Ssch\TYPO3Rector\Set\Typo3SetList;

return RectorConfig::configure()
    ->withPaths([
        getcwd() . '/',
    ])
    ->withImportNames(false, true, false, true)
    ->withPhpVersion(PhpVersion::PHP_83)
    ->withSets([
        Typo3SetList::CODE_QUALITY,
        Typo3SetList::GENERAL,
        Typo3LevelSetList::UP_TO_TYPO3_13,
        LevelSetList::UP_TO_PHP_83,
        PHPUnitSetList::ANNOTATIONS_TO_ATTRIBUTES,
    ])
    ->withSkip([
        // Skip paths
        getcwd() . '/.Build',
        getcwd() . '/.ddev',
        getcwd() . '/.project',
        getcwd() . '/config',
        getcwd() . '/var',
        getcwd() . '/Resources/Private/frontendSrc',
    ]);
