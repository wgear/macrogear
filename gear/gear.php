<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */


/**
 * Directory root
 */
define('ROOT', dirname(dirname(__FILE__)));

/**
 * Separator alias
 */
define('SEP', DIRECTORY_SEPARATOR);

/**
 * Web application directory
 */
define('WEB_DIR', ROOT . SEP . 'web');

/**
 * Staticfiles constants
 */
define('STATIC_DIR', ROOT . SEP . 'static');
define('STATIC_URL', '/static/');

/**
 * Composer loader
 */
include ROOT . SEP . 'gear' . SEP . 'vendor' . SEP . 'autoload.php';

/**
 * Run application
 */

