<?php
declare(strict_types=1);

use CodeIgniter\CodingStandard\CodeIgniter4;
use Nexus\CsConfig\Factory;

/*
 * --------------------------------------------------------------------
 * Create Cache file
 * --------------------------------------------------------------------
 */
if (!file_exists('writable/cache/cs-fixer')) {
    mkdir('writable/cache/cs-fixer', 0777, true);
    $file = fopen("writable/cache/cs-fixer/.php-cs-fixer.cache", "w");
    fclose($file);
}

$overrides = [];

$options = [
    'cacheFile'    => 'writable/cache/cs-fixer/.php-cs-fixer.cache',
    'usingCache' => true
];

/** @psalm-suppress InternalMethod */
return Factory::create(new CodeIgniter4(), $overrides, $options)->forProjects();