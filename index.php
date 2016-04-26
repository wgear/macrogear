<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

include 'gear/gear.php';

use Core\Routing\RouteURL;

$url = new RouteURL($_SERVER['REQUEST_URI']);

var_dump($url->sub_uri(0));