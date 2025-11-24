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
    const FAILED_TEST = "\033[35mNÃO passou no teste.\033[0m";
    const PASSED_TEST = "\033[34mPASSOU no teste.\033[0m";

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
        try{
            if(!file_exists($cfg['configs']['testFolder'] . self::getTest())){
                echo "\033[35mNÃ£o existe o arquivo de teste.\033[0m";
            }
            // carrega o arquivo da classe na memï¿½ria
            require_once($cfg['configs']['testFolder'] . self::getTest());
            // A classe de test deve ter o mesmo nome do arquivo
            $obj = new $obj();
            // Toda função de teste deve iniciar com a seguinte particula: 'test_'
            foreach(get_class_methods($obj) as $item){
                if(strpos($item, 'test_') !== false){ $obj->$item();} 
            }
            self::printTests();
        }catch(\Exception $e){
            echo "\033[35mExeption: {$e->getMessage()}\033[0m";
        }
        return;
    }

    /**
     * Method assertBool
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertBool($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === 'boolean', 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
            return;
        }
    }

    /**
     * Method assertString
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertString($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === 'string', 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
            return;
        }
    }

    /**
     * Method assertInt
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertInt($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === 'int', 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
            return;
        }
    }
    /**
     * Method assertFloat
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertFloat($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === 'float', 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
            return;
        }
    }

    /**
     * Method assertArray
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertArray($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === 'array', 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
            return;
        }
    }

    /**
     * Method assertObject
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertObject($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === 'object', 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
            return;
        }
    }

    /**
     * Method assertResource
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * .
     */
    public function assertResource($callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === 'resource', 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            preg_match_all($regex, $received, $matchs);
            $this->compare(
                $received, 
                !empty($matchs), 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                empty($received), 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received == $equal, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received !== $diff, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                file_exists($received), 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received > $term, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received >= $term, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received instanceof $instancia, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received < $term, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received <= $term, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("Não identificada a variável 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received === null, 
                $title, 
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
                __FUNCTION__
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf('%s:%s', $title, __FUNCTION__), self::FAILED_TEST, $received, $e->getMessage());
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
        $error = true;
        $msg = self::FAILED_TEST;
        // asset
        if($compare){
            $msg = self::PASSED_TEST;
            $error = false;
        };
        // asserts sequence
        $error? self::setAssertsSeq(Prints::TEST_ERROR): self::setAssertsSeq(Prints::TEST_PASSED);
        // assets;
        self::asserts(sprintf('%s:%s', $title, $subtitle), $msg, $received);
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