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
    const FAILED_TEST = "\033[35m%s:%s - N�O passou no teste.\033[0m";
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
        // utilizar configura��es de namespace
        // O arquivo de ter seu nome com final '_test' sempre
        $obj = $cfg['configs']['testNamespace'] . str_replace('.php','',self::getTest());
        try{
            if(!file_exists($obj)){
                echo "\033[35mNão existe o arquivo de teste.\033[0m";
            }
            // carrega o arquivo da classe na mem�ria
            require_once($cfg['configs']['testFolder'] . self::getTest());
            // A classe de test deve ter o mesmo nome do arquivo
            $obj = new $obj();
            // Toda fun��o de teste deve iniciar com a seguinte particula: 'test_'
            foreach(get_class_methods($obj) as $item){
                if(strpos($item, 'test_') !== false){ $obj->$item();} 
            }
            self::footer();
        }catch(\Exception $e){
            echo "\033[35mExeption: {$e->getMessage()}\033[0m";
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
    public function assertSame($type, $callback, $title = 'teste')
    {
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                gettype($received) === $type, 
                $title, 
                'assertSame'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertSame'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            preg_match_all($regex, $received, $matchs);
            $this->compare(
                $received, 
                !empty($matchs), 
                $title, 
                'assertRegExp'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertRegExp'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                empty($received), 
                $title, 
                'assertEmpty'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertEmpty'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received == $equal, 
                $title, 
                'assertEquals'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertEquals'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received !== $diff, 
                $title, 
                'assertDiff'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertDiff'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
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
        $received = null;
        try{
            if(!isset($callback)){
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                file_exists($received), 
                $title, 
                'assertFileExists'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertFileExists'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received > $term, 
                $title, 
                'assertGreaterThan'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertGreaterThan'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received >= $term, 
                $title, 
                'assertGreaterThanOrEqual'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertGreaterThanOrEqual'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received instanceof $instancia, 
                $title, 
                'assertInstanceOf'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'aassertInstanceOf'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received < $term, 
                $title, 
                'assertLessThan'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'aassertLessThan'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received <= $term, 
                $title, 
                'assertLessThanOrEqual'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'aassertLessThanOrEqual'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received === null, 
                $title, 
                'assertNull'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'aassertNull'), $received, $e->getMessage());
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
                throw new \Exception("N�o identificada a vari�vel 'callback'");
            }
            $received = $callback();
            $this->compare(
                $received, 
                $received === true, 
                $title, 
                'assertTrue'
            );
            return;
        }catch(\Exception $e){
            self::asserts(sprintf(self::FAILED_TEST, $title, 'assertTrue'), $received, $e->getMessage());
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
        $msg = sprintf(self::FAILED_TEST, $title, $subtitle);
        // asset
        if($compare){
            $msg = sprintf(self::PASSED_TEST, $title, $subtitle);
            $error = false;
        };
        // asserts sequence
        $error? self::setAssertsSeq(Prints::TEST_ERROR): self::setAssertsSeq(Prints::TEST_PASSED);
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