<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Core\Routing;


/**
 * Class Route
 * @package Core\Routing
 */
class Route 
{
    /**
     * @var string
     */
    private $namespace = '';

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $methods = ['*'];

    /**
     * @param $ns
     * @param $pattern
     * @param $action
     * @param array $methods
     */
    public function __construct($ns, $pattern, $action, $methods = ['*'])
    {
        $this->namespace = trim($ns, '/');
        $this->pattern = trim($pattern, '/');
        $this->action = $action;
        $this->methods = array_map('strtolower', $methods);
    }

    /**
     * @return string
     */
    public function pattern()
    {
        return $this->pattern;
    }

    /**
     * @return string
     */
    public function ns()
    {
        return $this->namespace;
    }

    /**
     * @return array
     */
    public function methods()
    {
        return $this->methods;
    }

    /**
     * @return mixed
     */
    public function action()
    {
        return call_user_func_array($this->action, func_get_args());
    }
} 