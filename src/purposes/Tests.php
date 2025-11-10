<?php

namespace test_command\purposes;

use test_command\Prints;
use test_command\purposes\TestsInterface;

class Tests extends Prints implements TestsInterface
{
    protected static $index   = 1;
    protected static $configs = array();
    protected static $test = '';
    protected static $assets  = array();

    /**
     * Method exec
     *
     * @param array  $configs [explicite description]
     * @param string $test [explicite description]
     *
     * @return void
     */
    public static function testing($configs = null, $test = null)
    {
        // carregamentos
        self::setConfigs($configs);
        self::setTest($test);
        // utilizar configurações padrão ou o que foi passado
        $cfg = (array) self::getConfigs();
        $obj = $cfg['configs']['testNamespace'] . str_replace('.php','',self::getTest());
        // O arquivo de ter seu nome com final '_test' sempre
        require_once($cfg['configs']['testFolder'] . self::getTest());
        // test
        // A classe de test deve ter o mesmo nome do arquivo
        $obj = new $obj();
        // Toda função de teste deve iniciar com a seguinte particula: 'test_'
        foreach(get_class_methods($obj) as $item){
            if(strpos($item, 'test_') !== false){
                $obj->$item();
            } 
        }
        return;
    }

    /**
     * Method assertSame
     *
     * @param string    $type [explicite description]
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     * Tipos de Dados ($type):
     *      string:     Para texto.
     *      int:        Nï¿½meros inteiros (ex: 10, -5).
     *      float:      Nï¿½meros de ponto flutuante (ex: 3.14, 0.5).
     *      bool:       Valores lï¿½gicos (true ou false).
     *      array:      Coleï¿½ï¿½o de valores. 
     *      object:     Instï¿½ncias de classes.
     *      null:       Um valor especial que representa "nenhum valor".
     *      resource:   Um ponteiro para um recurso externo (como arquivos ou banco de dados).
     */
    public static function assertSame($type, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            try{
                // asset
                $sd  = (gettype($callback) === $type);
                $sds = $sd? 'true': 'false';
            }catch(\Exception $e){
                $sds = 'null';
            }
            // assets;
            $index = self::$index . ":sameShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertRegExp
     *
     * @param string    $regex [explicite description]
     * @param string    $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public static function assertRegExp($regex, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            preg_match_all($regex, $callback, $matchs);
            $sd  = (!empty($matchs));
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":regExpShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertEmpty
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertEmpty($callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = empty($callback);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":emptyShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertEquals
     *
     * @param $equal $equal [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertEquals($equal, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback == $equal);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":equalsShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertDiffs
     *
     * @param $diff $diff [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertDiff($diff, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback !== $diff);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":diffsShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertFalse
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertFalse($callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback === false);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":falseShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertFileExists
     *
     * @param string $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertFileExists($callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = file_exists($callback);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":fileExistsShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertGreaterThan
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertGreaterThan($term, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback > $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":greaterThanShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertGreaterThanOrEqual
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertGreaterThanOrEqual($term, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback >= $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":greaterThanOrEqualShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertInstanceOf
     *
     * @param $instancia $instancia [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertInstanceOf($instancia, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback === true);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":instanceOfShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertLessThan
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertLessThan($term, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback < $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":lessThanShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertLessThanOrEqual
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertLessThanOrEqual($term, $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback <= $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":lessThanOrEqualShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    /**
     * Method assertNull
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertNull($callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd  = ($callback === null);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":nullShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }    

    /**
     * Method assertTrue
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     */
    public static function assertTrue($callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $sd = ($callback === true);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":trueShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            return;
        }
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
     * Get the value of configs
     */ 
    public static function getConfigs()
    {
        return self::$configs;
    }

    /**
     * Set the value of configs
     *
     * @return  void
     */ 
    public static function setConfigs($configs)
    {
        if(isset($configs) && !empty($configs)) self::$configs = $configs;
    }

    /**
     * Get the value of test
     */ 
    public static function getTest()
    {
        return self::$test;
    }

    /**
     * Set the value of test
     *
     * @return  self
     */ 
    public static function setTest($test)
    {
        if(isset($test) && !empty($test)) self::$test = $test;
    }
}