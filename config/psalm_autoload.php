<?php

declare(strict_types=1);
/*
 * --------------------------------------------------------------------
 * Create Cache file
 * --------------------------------------------------------------------
 */
if (! file_exists('writable/cache/psalm')) {
    mkdir('writable/cache/psalm', 0777, true);
}

/*
 * --------------------------------------------------------------------
 * NOTE: This file is updated in reference to CI4.* version.
 * Please update this file according to CI framework version that you are using.
 * --------------------------------------------------------------------
 */
$rootDir = __DIR__;
/*
 * --------------------------------------------------------------------
 * Helper File Directories
 * NOTE: Please add custom helper files here to psalm to understand.
 * --------------------------------------------------------------------
 */
$helperDirs = [
    '../vendor/codeigniter4/framework/system/Helpers',
    '../app/Helpers',
];

foreach ($helperDirs as $dir) {
    $dir = $rootDir . '/' . $dir;

    foreach (glob('*_helper.php') as $filename) {
        /** @var string */
        $filePath = realpath($dir . '/' . $filename);
        require_once $filePath;
    }
}
/*
 * --------------------------------------------------------------------
 * Global functions and individual helper files
 * NOTE: Please add custom helper files here to psalm to understand.
 * --------------------------------------------------------------------
 */
$helperFiles = [
    '../vendor/codeigniter4/framework/system/Common.php',
];

foreach ($helperFiles as $filename) {
    require_once $filename;
}
