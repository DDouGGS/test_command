<?php
/*
    TestCommand = Comando de teste.
*/
namespace test_command;

use test_command\purposes\Tests;
use test_command\purposes\TestsInterface;
use test_command\purposes\Archives;
use test_command\purposes\ArchivesInterface;
use test_command\purposes\Breakpoints;
use test_command\purposes\BreakpointsInterface;

abstract class TC
{
    protected static $tests = null;
    protected static $archives = null;
    protected static $breakpoints = null;

    /**
     * Method existsTests
     *
     * @return void
     */
    private static function existsBreakpoints()
    {
        return static::$breakpoints instanceof Breakpoints? true: false;
    }

    public static function halt($output = array(), $condition = true)
    {
        self::getBreakpoints()->halt($output, $condition);
    }

    public static function begin($output = array(), $condition = true)
    {
        self::getBreakpoints()->begin($output, $condition);
    }

    public static function rollback($output = array(), $condition = true)
    {
        self::getBreakpoints()->rollback($output, $condition);
    }
    
    /**
     * Method existsTests
     *
     * @return void
     */
    private static function existsTests()
    {
        return static::$tests instanceof Tests? true: false;
    }

    /**
     * Method testing
     *
     * @param array  $configs [explicite description]
     * @param string $test [explicite description]
     *
     * @return void
     */
    public static function testing($configs = null, $test = null)
    {
        self::getTests()->testing($configs, $test);
    }

    /**
     * Method assertSame
     *
     * @param string $type [explicite description]
     * @param bool   $callback [explicite description]
     * @param bool   $condition [explicite description]
     *
     * @return void
     * 
     * Tipos de Dados ($type):
     *      string:     Para texto.
     *      int:        Nmeros inteiros (ex: 10, -5).
     *      float:      Nmeros de ponto flutuante (ex: 3.14, 0.5).
     *      bool:       Valores lgicos (true ou false).
     *      array:      Coleo de valores. 
     *      object:     Instncias de classes.
     *      null:       Um valor especial que representa "nenhum valor".
     *      resource:   Um ponteiro para um recurso externo (como arquivos ou banco de dados).
     */
    public static function assertSame($type, $callback, $condition = true)
    {
        self::getTests()->assertSame($type, $callback, $condition);
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
        self::getTests()->assertRegExp($regex, $callback, $condition);
    }

    /**
     * Method assertEmpty
     *
     * @param bool $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertEmpty($callback, $condition = true)
    {
        self::getTests()->assertEmpty($callback, $condition);
    }

    /**
     * Method assertEquals
     *
     * @param mixed $equal [explicite description]
     * @param mixed $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertEquals($equal, $callback, $condition = true)
    {
        self::getTests()->assertEquals($equal, $callback, $condition);
    }

    /**
     * Method assertDiffs
     *
     * @param mixed $diff [explicite description]
     * @param mixed $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertDiff($diff, $callback, $condition = true)
    {
        self::getTests()->assertDiff($diff, $callback, $condition);
    }

    /**
     * Method assertFalse
     *
     * @param bool $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertFalse($callback, $condition = true)
    {
        self::getTests()->assertFalse($callback, $condition);
    }

    /**
     * Method assertFileExists
     *
     * @param string $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertFileExists($callback, $condition = true)
    {
        self::getTests()->assertFileExists($callback, $condition);
    }

    /**
     * Method assertGreaterThan
     *
     * @param int $term [explicite description]
     * @param int $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertGreaterThan($term, $callback, $condition = true)
    {
        self::getTests()->assertGreaterThan($term, $callback, $condition);
    }

    /**
     * Method assertGreaterThanOrEqual
     *
     * @param int $term [explicite description]
     * @param int $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertGreaterThanOrEqual($term, $callback, $condition = true)
    {
        self::getTests()->assertGreaterThanOrEqual($term, $callback, $condition);
    }

    /**
     * Method assertInstanceOf
     *
     * @param mixed $instancia [explicite description]
     * @param mixed $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertInstanceOf($instancia, $callback, $condition = true)
    {
        self::getTests()->assertInstanceOf($instancia, $callback, $condition);
    }

    /**
     * Method assertLessThan
     *
     * @param int $term [explicite description]
     * @param int $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertLessThan($term, $callback, $condition = true)
    {
        self::getTests()->assertLessThan($term, $callback, $condition);
    }

    /**
     * Method assertLessThanOrEqual
     *
     * @param int $term [explicite description]
     * @param int $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertLessThanOrEqual($term, $callback, $condition = true)
    {
        self::getTests()->assertLessThanOrEqual($term, $callback, $condition);
    }

    /**
     * Method assertNull
     *
     * @param mixed $callback [explicite description]
     * @param bool $condition [explicite description]
     *
     * @return void
     */
    public static function assertNull($callback, $condition = true)
    {
        self::getTests()->assertNull($callback, $condition);
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
        self::getTests()->assertTrue($callback, $condition);
    }
    
    /**
     * Method assertTrue2
     *
     * @param Closure $callback [explicite description]
     * @param string $title [explicite description]
     *
     * @return void
     */
    public static function assertTrue2( $callback, $title = 'teste')
    {
        self::getTests()->assertTrue2($callback, $title);
    }

    /**
     * Method existsTests
     *
     * @return void
     */
    private static function existsArchives()
    {
        return static::$archives instanceof Archives? true: false;
    }
    
    /**
     * Method getTests
     *
     * @return Tests
     */
    private static function getTests()
    {
        if(!self::existsTests()){self::setTests(new Tests());}
        return self::$tests;
    }

    /**
     * Set the value of tests
     *
     * @return  void
     */ 
    private static function setTests($tests)
    {
        if(isset($tests) && !empty($tests)) self::$tests = $tests;
    }
    
    /**
     * Method getArchives
     *
     * @return Archives
     */
    private static function getArchives()
    {
        if(!self::existsArchives()){self::setArchives(new Archives());}
        return self::$archives;
    }

    /**
     * Set the value of archives
     *
     * @return  void
     */ 
    private static function setArchives($archives)
    {
        if(isset($archives) && !empty($archives)) self::$archives = $archives;
    }

    /**
     * Method getBreakpoints
     *
     * @return Breakpoints
     */
    private static function getBreakpoints()
    {
        if(!self::existsBreakpoints()){self::setBreakpoints(new Breakpoints());}
        return self::$breakpoints;
    }

    /**
     * Set the value of breakpoints
     *
     * @return  void
     */ 
    private static function setBreakpoints($breakpoints)
    {
        if(isset($breakpoints) && !empty($breakpoints)) self::$breakpoints = $breakpoints;
    }
}