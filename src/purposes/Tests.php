<?php

namespace test_command\purposes;

use test_command\Prints;
use test_command\purposes\TestsInterface;

class Tests extends Prints implements TestsInterface
{
    protected static $index   = 1;
    protected static $configs = array();
    protected static $test = '';

    // mensagens
    const FAILED_TEST = "\033[35m%s:%s - NÃO passou no teste.\033[0m";
    const PASSED_TEST = "\033[34m%s:%s - PASSOU no teste.\033[0m";

    /**
     * Method exec
     *
     * @param array  $configs [explicite description]
     * @param string $test [explicite description]
     *
     * @return void
     */
    public function testing($configs = null, $test = null)
    {
        // carregamentos
        self::setConfigs($configs);
        self::setTest($test);
        $cfg = (array) self::getConfigs();
        // test
        // carrega arquivo de test
        // utilizar configurações de namespace
        // O arquivo de ter seu nome com final '_test' sempre
        $obj = $cfg['configs']['testNamespace'] . str_replace('.php','',self::getTest());
        // carrega o arquivo da classe na memória
        require_once($cfg['configs']['testFolder'] . self::getTest());
        // A classe de test deve ter o mesmo nome do arquivo
        $obj = new $obj();
        // Toda função de teste deve iniciar com a seguinte particula: 'test_'
        foreach(get_class_methods($obj) as $item){
            if(strpos($item, 'test_') !== false){ $obj->$item();} 
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
     *      int:        NÃ¯Â¿Â½meros inteiros (ex: 10, -5).
     *      float:      NÃ¯Â¿Â½meros de ponto flutuante (ex: 3.14, 0.5).
     *      bool:       Valores lÃ¯Â¿Â½gicos (true ou false).
     *      array:      ColeÃ¯Â¿Â½Ã¯Â¿Â½o de valores. 
     *      object:     InstÃ¯Â¿Â½ncias de classes.
     *      null:       Um valor especial que representa "nenhum valor".
     *      resource:   Um ponteiro para um recurso externo (como arquivos ou banco de dados).
     */
    public function assertSame($type, $callback, $title = 'teste')
    {
        $received = $type;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertSame');
        try{
            // asset
            $received = $callback();
            if((gettype($received) === $type)){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertSame');
            };
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertRegExp($regex, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertRegExp');
        try{
            // asset
            $received = $callback();
            preg_match_all($regex, $received, $matchs);
            if(!empty($matchs)){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertRegExp');
            };
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertEmpty($callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertEmpty');
        try{
            // asset
            $received = $callback();
            if(empty($received)){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertEmpty');
            };
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertEquals($equal, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertEquals');
        try{
            // asset
            $received = $callback();
            if($received == $equal){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertEquals');
            };
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertDiff($diff, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertDiff');
        try{
            // asset
            $received = $callback();
            if($received !== $diff){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertDiff');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertFalse($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received === false, 
                $title, 
                'assertFalse'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertFalse'), $received, $e->getMessage());
            return;
        }
    }

    /**
     * Method assertFileExists
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public function assertFileExists($callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertFileExists');
        try{
            // asset
            $received = $callback();
            if(file_exists($received)){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertFileExists');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertGreaterThan($term, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertGreaterThan');
        try{
            // asset
            $received = $callback();
            if($received > $term){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertGreaterThan');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertGreaterThanOrEqual($term, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertGreaterThanOrEqual');
        try{
            // asset
            $received = $callback();
            if($received >= $term){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertGreaterThanOrEqual');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertInstanceOf($instancia, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertInstanceOf');
        try{
            // asset
            $received = $callback();
            if($received instanceof $instancia){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertInstanceOf');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertLessThan($term, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertLessThan');
        try{
            // asset
            $received = $callback();
            if($received < $term){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertLessThan');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertLessThanOrEqual($term, $callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertLessThanOrEqual');
        try{
            // asset
            $received = $callback();
            if($received <= $term){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertLessThanOrEqual');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertNull($callback, $title = 'teste')
    {
        $received = false;
        $error    = null;
        $msg      = sprintf(self::FAILED_TEST, $title, 'assertNull');
        try{
            // asset
            $received = $callback();
            if($received === null){
                $msg = sprintf(self::PASSED_TEST, $title, 'assertNull');
            }
            // assets;
            self::asserts($msg, gettype($received), $error);
            return;
        }catch(\Exception $e){
            self::asserts($msg, gettype($received), $e->getMessage());
            return;
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
    public function assertTrue($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received === true, 
                $title, 
                'assertTrue2'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertTrue2'), $received, $e->getMessage());
            return;
        }
    }
    
    /**
     * Method compare
     *
     * @param mixed  $received [explicite description]
     * @param bool   $compare [explicite description]
     * @param string $title [explicite description]
     * @param string $subtitle [explicite description]
     * @param string $error [explicite desciption]
     *
     * @return void
     */
    private function compare($received, $compare, $title = 'teste', $subtitle = '')
    {
        $msg = sprintf(self::FAILED_TEST, $title, $subtitle);
        // asset
        if($compare){ $msg = sprintf(self::PASSED_TEST, $title, $subtitle); };
        // assets;
        self::asserts($msg, $received);
        return;
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