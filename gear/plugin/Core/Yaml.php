<?php
/**
 * @Product: MacroGear
 * @Author: Maxim P.
 */

namespace Plugin\Core;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;


/**
 * Class Yaml
 * @package Plugin\Core
 */
class Yaml 
{
    /**
     * @var Parser
     */
    private static $parser_instance;

    /**
     * @var Dumper
     */
    private static $dumper_instance;

    /**
     * @param $filename
     * @return array
     */
    public static function parse($filename)
    {
        return static::parse_str(file_get_contents($filename));
    }

    /**
     * @param $ymlstr
     * @return array
     */
    public static function parse_str($ymlstr)
    {
        return static::_parser()->parse($ymlstr);
    }

    /**
     * @param $filename
     * @param array $data
     * @return bool
     */
    public static function dump($filename, $data = [])
    {
        return (bool)file_put_contents($filename, static::dump_str($data));
    }

    /**
     * @param array $data
     * @return string
     */
    public static function dump_str($data = [])
    {
        return static::_dumper()->dump($data);
    }

    /**
     * @return Parser
     */
    private static function _parser()
    {
        if ( !static::$parser_instance ) {
            static::$parser_instance = new Parser();
        }

        return static::$parser_instance;
    }

    /**
     * @return Dumper
     */
    private static function _dumper()
    {
        if ( !static::$dumper_instance ) {
            static::$dumper_instance = new Dumper();
        }

        return static::$dumper_instance;
    }
} 