<?php

namespace test_command\purposes;

interface ArchivesInterfaces
{
    /**
     * Method log
     *
     * @param array  $scene [explicite description]
     * @param string $reference [explicite description]
     * @param bool   $propertys [explicite description]
     *
     * @return void
     */
    public static function log( array $scene, string $reference, $propertys = false);

    /**
     * Method name - Nome para o arquivo
     *
     * @param string $prefix
     * @param string $month
     * @param int    $year
     * @param string $sufix
     *
     * @return void
     */
    function name($prefix, $month, $year, $sufix = null);

    /**
     * Method create
     *
     * @param string $name
     * @param string $folder
     *
     * @return void
     */
    function create($name, $folder);

    
    /**
     * Method in
     *
     * @param $line $line [explicite description]
     *
     * @return void
     */
    public function in($line);

    /**
     * Method close
     *
     * @return bool
     */
    function close();
}