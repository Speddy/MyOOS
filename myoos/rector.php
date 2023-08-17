<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/admin',
        __DIR__ . '/assets',
        __DIR__ . '/cookie_consent',
        __DIR__ . '/download',
        __DIR__ . '/images',
        __DIR__ . '/includes',
        __DIR__ . '/install',
        __DIR__ . '/js',
        __DIR__ . '/jsm',
        __DIR__ . '/media',
        __DIR__ . '/pub',
        __DIR__ . '/themes',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    //    $rectorConfig->sets([
    //        LevelSetList::UP_TO_PHP_74
    //    ]);
};
