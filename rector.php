<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\PHPUnit\Set\PHPUnitSetList;

return RectorConfig::configure()
    ->withImportNames(removeUnusedImports: true)
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/rules',
        __DIR__ . '/rules-tests',
    ])
    ->withRootFiles()
    ->withSkip([
        // for tests
        '*/Source/*',
        '*/Fixture/*',
        '*/Expected/*',

        // object types
        StringClassNameToClassConstantRector::class => [
            __DIR__ . '/src/Rector/Class_/TestListenerToHooksRector.php',
            __DIR__ . '/src/NodeAnalyzer/TestsNodeAnalyzer.php',
            __DIR__ . '/config',
            __DIR__ . '/src/NodeFinder/DataProviderClassMethodFinder.php',
        ],
    ])
    ->withPhpSets(php82: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        earlyReturn: true,
        naming: true,
        typeDeclarations: true,
        privatization: true,
        rectorPreset: true
    )
    ->withSets([
        PHPUnitSetList::PHPUNIT_100,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
    ])
    ->withConfiguredRule(StringClassNameToClassConstantRector::class, [
        // keep unprefixed to protected from downgrade
        'PHPUnit\Framework\*',
        'Prophecy\Prophet',
    ]);
