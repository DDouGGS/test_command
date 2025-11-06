<?php

namespace test_command;

use test_command\purposes\archives;

class Prints
{
    protected static $protocol;
    protected static $index   = 1;
    protected static $label   = '';
    protected static $propertys  = null;
    protected static $simple  = false;
    protected static $reference = 'book:chapter:title:subtitle:label';
    protected static $log = false;
    protected static $header  = array();
    protected static $content = array();
    protected static $connection = null;
    protected static $follow = null;

    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        self::$protocol = rand(100000, 100000000);
    }

    /**
     * Method block
     *
     * @param mixed $sd [explicite description]
     * @param array $backtrace [explicite description]
     *
     * @return String
     */
    public static function block($sd, $backtrace)
    {
        if (!empty($sd)) {
            echo("\n".date('Y-m-d H:i:s', strtotime('now')). " <<<<< LABEL: " . self::getLabel()  . ':' . self::$index . "\n");
            echo(date('Y-m-d H:i:s', strtotime('now')). " <<<<< BACKTRACER - usage memory (Bytes): ". memory_get_peak_usage() ."\n");
            print_r($backtrace);
            echo(date('Y-m-d H:i:s', strtotime('now'))." <<<<< OUTPUTS\n");
            print_r($sd);

            if (self::getPropertys()) {
                echo("\n".date('Y-m-d H:i:s', strtotime('now'))." <<<<< globals:\n");
                print_r(self::globals());
                echo("\n".date('Y-m-d H:i:s', strtotime('now'))." <<<<< envs:\n");
                print_r(self::envs());
            }

            echo(date('Y-m-d H:i:s', strtotime('now')). " <<<<< LABEL: " . self::getLabel() . ':' . self::$index ."\n");
        }
    }
        
    /**
     * Method envs
     *
     * @param $propertys $propertys [explicite description]
     *
     * @return array
     */
    private static function envs($propertys = false)
    {
        $env = array();
        
        if ($propertys === false) {
            return $env;
        }

        foreach ($_ENV as $key => $value) {
            if (is_object($value)) {
                $env[$key] = get_class($value);
                continue;
            }
            if (is_array($value)) {
                $env[$key] = 'array['.count($value).']';
                continue;
            }
            $env[$key] = $value;
        }
        
        return $env;
    }
        
    /**
     * Method globals
     *
     * @param $propertys $propertys [explicite description]
     *
     * @return array
     */
    private static function globals($propertys = false)
    {
        $global = array();
        
        if ($propertys === false) {
            return $global;
        }

        foreach ($GLOBALS as $key => $value) {
            if (is_object($value)) {
                $env[$key] = get_class($value);
                continue;
            }
            if (is_array($value)) {
                $env[$key] = 'array['.count($value).']';
                continue;
            }
            $global[$key] = $value;
        }
        
        return $global;
    }
        
    /**
     * Method globals
     *
     * @param $propertys $propertys [explicite description]
     *
     * @return array
     */
    public static function globalsPropertys($propertys = false)
    {
        $global = array();

        if ($propertys === false) {
            return $global;
        }

        foreach ($GLOBALS as $key => $value) {
            if(substr($key,0,1) !== '_') {
                foreach ($value as $key => $value) {
                    if(is_object($value) || is_array($value)){
                        $global[$key] = serialize($value);
                        continue;
                    }
                    $global[$key] = $value;
                }
            }
        }

        return $global;
    }
    
    /**
     * Method follow
     *
     * @return void
     */
    protected static function follow()
    {
        $follow = readline(utf8_encode("\nTo continue, do you wish type y or yes: "));
        if (!in_array(strtolower($follow), array('Y','y','Yes','yes'))) {
            die("\n".date('Y-m-d H:i:s', strtotime('now'))." <<< END.\n");
        }
        echo("\n".date('Y-m-d H:i:s', strtotime('now'))." >>> CONTINUE\n");
    }
    
    /**
     * Method backtrace
     *
     * @param $simple $simple [explicite description]
     *
     * @return array
     */
    protected static function backtrace($simple = true)
    {
        $count = 0;
        $trace = '';
        $debugBacktrace = debug_backtrace();

        if (self::getSimple()) {
            foreach ($debugBacktrace as $item) {
                if($count === 2){
                    self::setReference(' ['  . $item['file'] . ' | ' . $item['line'] . ']');
                    self::setLabel(self::getReference());
                }
                if ($item['function'] !== 'backtrace') {
                    $trace .= " <<<<< " . ' ['  . $item['class'] . $item['type'] . $item['function'] . "];\n";
                }
                ++$count;
            }
            return $trace;
        }

        foreach ($debugBacktrace as $item) {
            if($count === 2){
                    self::setReference(' ['  . $item['file'] . ' | ' . $item['line'] . ']');
                    self::setLabel(self::getReference());
                }
            if ($item['function'] !== 'backtrace') {
                $trace .= " <<<<< " . ' ['  . $item['file'] . ' | ' . $item['line'] . '] - [' . $item['class'] . $item['type'] . $item['function'] . "];\n";
            }
            ++$count;
        }
        return $trace;
    }

    /**
     * Get the value of connection
     */
    public static function getConnection()
    {
        return self::$connection;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */
    public static function setConnection($connection)
    {
        if (isset($connection) && !empty($connection)) {
            self::$connection = $connection;
        }
    }

    /**
     * Get the value of log
     */ 
    public static function getLog()
    {
        return self::$log;
    }

    /**
     * Set the value of log
     *
     * @return  self
     */ 
    public static function setLog($log)
    {
        if(!empty($log)){ self::$log = $log;}
    }

    /**
     * Get the value of content
     */ 
    public static function getContent()
    {
        return self::$content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public static function setContent($content)
    {
        if (isset($content) && !empty($content)) self::$content[] = $content;
    }

    /**
     * Get the value of header
     */ 
    public static function getHeader()
    {
        return self::$header;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */ 
    public static function setHeader($field, $value)
    {
        if(isset($value) && !empty($value)) self::$header[$field] = $value;
    }

    /**
     * Get the value of simple
     */
    public static function getSimple()
    {
        return self::$simple;
    }

    /**
     * Set the value of simple
     *
     * @return  self
     */
    public static function setSimple($simple)
    {
        if (isset($simple) && !empty($simple)) {
            self::$simple = $simple;
        }
    }

    /**
     * Get the value of property
     */
    public static function getPropertys()
    {
        return self::$propertys;
    }

    /**
     * Set the value of property
     *
     * @return  self
     */
    public static function setPropertys($propertys)
    {
        if (isset($propertys) && !empty($propertys)) {
            self::$propertys = $propertys;
        }
    }

    /**
     * Get the value of label
     */ 
    public static function getLabel()
    {
        return self::$label;
    }

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public static function setLabel($label)
    {
        if(isset($label) && !empty($label)){ self::$label = $label; }
    }

    /**
     * Get the value of reference
     */ 
    public static function getReference()
    {
        return self::$reference;
    }

    /**
     * Set the value of reference
     *
     * @return  self
     */ 
    public static function setReference($reference)
    {
        if(isset($reference) && !empty($reference)){ self::$reference = $reference;}
    }

    /**
     * Get the value of follow
     */ 
    public static function getFollow()
    {
        return self::$follow;
    }

    /**
     * Set the value of follow
     *
     * @return  self
     */ 
    public static function setFollow($follow)
    {
        if(!empty($follow)){ self::$follow = $follow;}
    }
}