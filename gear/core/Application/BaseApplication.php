<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Core\Application;

use Core\Config\Storage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class BaseApplication
 * @package Core\Application
 */
class BaseApplication
{
    /**
     * System configuration storage
     *
     * @var Storage
     */
    public $config;

    /**
     * @var
     */
    public $route;

    /**
     * @var Request
     */
    static $request;

    /**
     * @var Response
     */
    static $response;

    /**
     * Create new Application
     */
    public function __construct()
    {
        $this->config = new Storage(ROOT . SEP . 'gear' . SEP . 'conf');
    }

    public function run()
    {
        // Prepare request / response
        static::$request = Request::createFromGlobals();
        static::$response = Response::create();
        static::$response->prepare(static::$request);


    }

    public static function collectRoutings()
    {

    }
} 