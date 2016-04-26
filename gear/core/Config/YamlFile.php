<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Core\Config;

use Core\Config\Exception\FileNotFound;
use Plugin\Core\Yaml;


/**
 * Class YamlFile
 * @package Core\Config
 */
class YamlFile extends \ArrayObject
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $cache = [];

    /**
     * @var bool
     */
    private $is_changed = false;

    /**
     * @var bool
     */
    private $is_loaded = false;

    /**
     * @var bool
     */
    private $autosave = true;

    /**
     * @param array|null|object $file_path
     * @param bool $autosave
     * @param bool $force
     * @throws FileNotFound
     */
    public function __construct($file_path, $autosave = true, $force = false)
    {
        if ( !file_exists($file_path) ) {
            if ( !($force && file_put_contents($file_path, '')) ) {
                throw new FileNotFound('File ' . $file_path . ' not found');
            }
        }

        $this->path = $file_path;
        $this->autosave = $autosave;
    }

    /**
     * Automatically save changed file
     */
    public function __destruct()
    {
        if ( $this->is_changed && $this->autosave ) {
            $this->is_changed = false;
            $this->save();
        }
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function get($key, $default = null)
    {
        if ( !$this->is_loaded ) {
            $this->load();
        }

        if ( array_key_exists($key, $this->cache) ) {
            return $this->cache[$key];
        }

        return $default;
    }

    /**
     * @param $key
     * @param $newval
     */
    public function set($key, $newval)
    {
        $this->cache[$key] = $newval;
        $this->is_changed = true;
    }

    /**
     * @return bool
     */
    public function load()
    {
        $this->cache = Yaml::parse($this->path);
        $this->is_loaded = true;
        return true;
    }

    /**
     * @return bool
     */
    public function save()
    {
        return Yaml::dump($this->path, $this->cache);
    }

    /**
     * @param array $array
     * @return bool
     */
    public function update($array = [])
    {
        foreach ( $array as $k => $v ) {
            $this->set($k, $v);
        }

        return true;
    }

    /**
     * @param array $array
     * @return bool
     */
    public function change($array = [])
    {
        $this->cache = $array;
        $this->is_changed = true;
        return true;
    }

    /**
     * @param mixed $key
     * @return mixed|null
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @param mixed $key
     * @param mixed $newval
     */
    public function offsetSet($key, $newval)
    {
        $this->set($key, $newval);
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->cache);
    }

    /**
     * @param mixed $key
     */
    public function offsetUnset($key)
    {
        if ( $this->offsetExists($key) ) {
            unset($this->cache[$key]);
        }
    }
} 