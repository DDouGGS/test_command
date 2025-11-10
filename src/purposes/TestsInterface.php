<?php

namespace test_command\purposes;

interface TestsInterface
{
    /**
     * Method exec
     *
     * @param array  $configs [explicite description]
     * @param string $test [explicite description]
     *
     * @return void
     */
    public static function testing($configs = null, $test = null);

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
    public static function assertSame($type, $callback, $condition = true);

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
    public static function assertRegExp($regex, $callback, $condition = true);

    /**
     * Method assertEmpty
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertEmpty($callback, $condition = true);

    /**
     * Method assertEquals
     *
     * @param $equal $equal [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertEquals($equal, $callback, $condition = true);

    /**
     * Method assertDiffs
     *
     * @param $diff $diff [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertDiff($diff, $callback, $condition = true);

    /**
     * Method assertFalse
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertFalse($callback, $condition = true);

    /**
     * Method assertFileExists
     *
     * @param string $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertFileExists($callback, $condition = true);

    /**
     * Method assertGreaterThan
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertGreaterThan($term, $callback, $condition = true);

    /**
     * Method assertGreaterThanOrEqual
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertGreaterThanOrEqual($term, $callback, $condition = true);

    /**
     * Method assertInstanceOf
     *
     * @param $instancia $instancia [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertInstanceOf($instancia, $callback, $condition = true);

    /**
     * Method assertLessThan
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertLessThan($term, $callback, $condition = true);

    /**
     * Method assertLessThanOrEqual
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertLessThanOrEqual($term, $callback, $condition = true);

    /**
     * Method assertNull
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function assertNull($callback, $condition = true);

    /**
     * Method assertTrue
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     */
    public static function assertTrue($callback, $condition = true);
}