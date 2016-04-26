<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Core\Routing;


/**
 * Class RoutingMap
 * @package Core\Routing
 */
class RoutingMap 
{
    /**
     * @var array
     */
    private $struct = [];

    /**
     * @param Route $route
     */
    public function add(Route $route)
    {
        if ( !array_key_exists($route->ns(), $this->struct) ) {
            $this->struct[$route->ns()] = [];
        }

        $this->struct[$route->ns()][] = $route;
    }

    public function call($method_name, $url, $defaultNS = 'main')
    {
        $url = new RouteURL($url);
        $namespace = $url->segment(0, $defaultNS);

        if ( !array_key_exists($namespace, $this->struct) ) {
            $search_patterns = $this->struct[$namespace];
        }
    }
} 