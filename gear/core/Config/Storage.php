<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Core\Config;


/**
 * Class Storage
 * @package Core\Config
 */
class Storage 
{
    /**
     * @var string
     */
    private $root;

    /**
     * @var array
     */
    private static $instances = [];

    /**
     * @param $root_path
     */
    public function __construct($root_path)
    {
        $this->root = rtrim($root_path, DIRECTORY_SEPARATOR);
        if ( !array_key_exists($this->root, static::$instances) ) {
            static::$instances[$this->root] = [];
        }
    }

    /**
     * @param $name
     * @return YamlFile
     */
    public function get($name)
    {
        if ( !array_key_exists(trim($name, DIRECTORY_SEPARATOR), static::$instances[$this->root]) ) {
            static::$instances[$this->root][$name] = new YamlFile($this->path($name), true, true);
        }

        return static::$instances[$this->root][$name];
    }

    /**
     * @param $name
     * @param array $value
     * @return YamlFile
     */
    public function set($name, $value = [])
    {
        $file = $this->get($name);
        $file->change($value);
        return $file;
    }

    /**
     * @param $name
     * @return string
     */
    public function path($name)
    {
        return $this->root . DIRECTORY_SEPARATOR . $name;
    }
} 