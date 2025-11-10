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

abstract class TC implements TestsInterface, BreakpointsInterface
{
    protected static $tests = null;
    protected static $archives = null;
    protected static $breakpoints = null;

    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->setTests(new Tests());
        $this->setArchives(new Archives());
        $this->setBreakpoints(new Breakpoints());
    }

    public static function halt($output = array(), $condition = true)
    {
        static::$breakpoints->halt($output, $condition);
    }

    public static function begin($output = array(), $condition = true)
    {
        static::$breakpoints->begin($output, $condition);
    }

    public static function rollback($output = array(), $condition = true)
    {
        static::$breakpoints->rollback($output, $condition);
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
        static::$tests->tenting($configs, $test);
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
        static::$tests->assertSame($type, $callback, $condition);
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
        static::$tests->assertRegExp($regex, $callback, $condition);
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
        static::$tests->assertEmpty($callback, $condition);
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
        static::$tests->assertEquals($equal, $callback, $condition);
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
        static::$tests->assertDiff($diff, $callback, $condition);
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
        static::$tests->assertFalse($callback, $condition);
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
        static::$tests->assertFileExists($callback, $condition);
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
        static::$tests->assertGreaterThan($term, $callback, $condition);
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
        static::$tests->assertGreaterThanOrEqual($term, $callback, $condition);
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
        static::$tests->assertInstanceOf($instancia, $callback, $condition);
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
        static::$tests->assertLessThan($term, $callback, $condition);
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
        static::$tests->assertLessThanOrEqual($term, $callback, $condition);
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
        static::$tests->assertNull($callback, $condition);
    }

    /**
     * Method assertTrue
     *
     * @param mixed   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     */
    public static function assertTrue($callback, $condition = true)
    {
        static::$tests->assertTrue($callback, $condition);
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
     * Set the value of archives
     *
     * @return  void
     */ 
    private static function setArchives($archives)
    {
        if(isset($archives) && !empty($archives)) self::$archives = $archives;
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