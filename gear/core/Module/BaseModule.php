<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Core\Module;

use Core\Config\Storage;
use Core\Module\Controller\BaseController;


/**
 * Class BaseModule
 * @package core\Module
 */
class BaseModule
{
    /**
     * Module NameSpace to define routes
     */
    const ROUTE_NAMESPACE = '';

    /**
     * @var BaseController
     */
    private $controller;

    /**
     * @var Storage
     */
    public $config;

    /**
     * @param $controller
     */
    public function __construct($controller)
    {
        $this->config = new Storage(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . );

        $this->controller = new $controller($this);
    }

    /**
     * Define global-level routes
     *
     * @param Router $router
     */
    public static function routing(Router $router)
    {
        // ... register routes
    }

    public static function handle($controller)
    {

    }

    /**
     * Define module-level http-headers
     *
     * @return array
     */
    public function headers()
    {
        return [];
    }

    /**
     * Define module-level template variables
     *
     * @return array
     */
    public function context()
    {
        return [];
    }

    /**
     * Check that user can access to this module
     *
     * @return bool
     */
    public function access()
    {
        return true;
    }
} 