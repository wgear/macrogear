<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Core\Routing;


class RouteURL extends \ArrayObject
{
    /**
     * @param string $url
     */
    public function __construct($url = '/')
    {
        $url_path = trim(parse_url($url, PHP_URL_PATH), '/');
        $this->exchangeArray(explode('/', $url_path));
    }

    /**
     * @param $index
     * @param null $default
     * @return null
     */
    public function segment($index, $default = null)
    {
        if ( $this->offsetExists($index) ) {
            return $this[$index];
        }

        return $default;
    }

    /**
     * @param int $start
     * @param null $len
     * @return string
     */
    public function sub_uri($start = 0, $len = -1)
    {
        if ( $len == -1 ) {
            $len = $this->count();
        }

        $segments = $this->getArrayCopy();
        $segments = array_splice($segments, $start, $len);
        return implode('/', $segments);
    }
} 