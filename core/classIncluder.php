<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', getcwd() . '/');
}

$folder['core'] = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(realpath('core')), RecursiveIteratorIterator::CHILD_FIRST);
$folder['app'] = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(realpath('app')), RecursiveIteratorIterator::CHILD_FIRST);

require_once ABSPATH . 'includes/Help.php';
require_once ABSPATH . 'includes/smarty/Smarty.class.php';
require_once ABSPATH . 'includes/classMysql.php';
require_once ABSPATH . 'includes/Upload.php';
require_once ABSPATH . 'core/Route.php';


$fileIgnore = array('Route.php', 'classIncluder.php', 'SSF.php', 'App.php', 'globalRewrite.php', 'ST.php');
require_once ABSPATH . 'core/App.php';
foreach ($folder as $one) {
    foreach ($one as $name => $object) {
        if (substr($name, -4) === '.php') {
            $filename = new SplFileInfo($name);
            if (!in_array($filename->getFilename(), $fileIgnore)) {
                require_once $name;
            }
        }
    }
}

require_once ABSPATH . 'core/globalRewrite.php';
require_once ABSPATH . 'core/ST.php';


