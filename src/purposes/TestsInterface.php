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
    public function testing($configs = null, $test = null);

    /**
     * Method assertBool
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertBool($callback, $title = 'teste');

    /**
     * Method assertString
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertString($callback, $title = 'teste');

    /**
     * Method assertInt
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertInt($callback, $title = 'teste');
    /**
     * Method assertFloat
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertFloat($callback, $title = 'teste');

    /**
     * Method assertArray
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertArray($callback, $title = 'teste');

    /**
     * Method assertObject
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public function assertObject($callback, $title = 'teste');

    /**
     * Method assertResource
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * .
     */
    public function assertResource($callback, $title = 'teste');

    /**
     * Method assertRegExp
     *
     * @param string    $regex [explicite description]
     * @param string    $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     * 
     */
    public function assertRegExp($regex, $callback, $title = 'teste');

    /**
     * Method assertEmpty
     *
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertEmpty($callback, $title = 'teste');

    /**
     * Method assertEquals
     *
     * @param $equal $equal [explicite description]
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertEquals($equal, $callback, $title = 'teste');

    /**
     * Method assertDiffs
     *
     * @param $diff $diff [explicite description]
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertDiff($diff, $callback, $title = 'teste');

    /**
     * Method assertFalse
     *
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertFalse($callback, $title = 'teste');

    /**
     * Method assertFileExists
     *
     * @param string $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertFileExists($callback, $title = 'teste');

    /**
     * Method assertGreaterThan
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertGreaterThan($term, $callback, $title = 'teste');

    /**
     * Method assertGreaterThanOrEqual
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertGreaterThanOrEqual($term, $callback, $title = 'teste');

    /**
     * Method assertInstanceOf
     *
     * @param $instancia $instancia [explicite description]
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertInstanceOf($instancia, $callback, $title = 'teste');

    /**
     * Method assertLessThan
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertLessThan($term, $callback, $title = 'teste');

    /**
     * Method assertLessThanOrEqual
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertLessThanOrEqual($term, $callback, $title = 'teste');

    /**
     * Method assertNull
     *
     * @param Closure $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertNull($callback, $title = 'teste');

    /**
     * Method assertTrue
     *
     * @param Closure   $callback [explicite description]
     * @param string    $title [explicite description]
     *
     * @return void
     */
    public function assertTrue($callback, $title = 'teste');
}