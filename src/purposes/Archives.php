<?php

namespace test_command\purposes;

use test_command\Prints;
use test_command\purposes\ArchivesInterface;

class Archives extends Prints implements ArchivesInterface
{
    const carrierReturn = "\n";

    protected $name;
    protected $file;
    protected $folder = "";


    public function __construct($name = null, $folder = null) 
    {
        $this->setName($name);
        $this->setFolder($folder);
        $this->create($this->getName(), $this->getFolder());
    }

    /**
     * Method make
     *
     * @param $name $name [explicite description]
     * @param $file $file [explicite description]
     *
     * @return object
     */
    public static function make($name = null, $folder = null)
    {
        return new archives($name, $folder);
    }

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
    function name($prefix, $month, $year, $sufix = null)
    {
        if (!isset($prefix) && !isset($month) && !isset($year)) {
            return null;
        }

        $this->setName($prefix . $month . '-' . $year  . $sufix . '.sql');

        return $this->getName();
    }

    /**
     * Method create
     *
     * @param string $name
     * @param string $folder
     *
     * @return void
     */
    function create($name, $folder)
    {
        if (!isset($name) && !isset($folder)) {
            return null;
        }

        $this->setFile(fopen($folder . $name, 'a+'));

        if (!$this->getFile()) {
            return false;
        }

        return true;
    }

    
    /**
     * Method in
     *
     * @param $line $line [explicite description]
     *
     * @return void
     */
    public function in($line)
    {
        if (!$this->getFile()) {
            throw new \Exception('Nï¿½o encontrado o recurso de arquivo.');
        }

        return fwrite($this->getFile(), (string) $line);
    }

    /**
     * Method close
     *
     * @return bool
     */
    function close()
    {
        if (!$this->getFile()) {
            throw new \Exception('Nï¿½o encontrado o recurso de arquivo.');
        }

        return fclose($this->getFile());
    }

    /**
     * Method log
     *
     * @param array  $scene [explicite description]
     * @param string $reference [explicite description]
     * @param bool   $propertys [explicite description]
     *
     * @return void
     */
    public static function log( array $scene, string $reference, $propertys = false)
    {
        $log = array();
        // Header
        self::setHeader('reference', $reference);
        if(!empty(self::$header)) $log['header'] = json_encode(self::getHeader());
        // Property
        self::setContent(self::globalsPropertys($propertys));
        if(!empty(self::$content)) $log['propertys'] = serialize(self::getContent());
        // Ciontent
        $log['content'] = serialize($scene);
        // salvar no arquivo
        $dat = archives::make('logs'.date('Ymd', strtotime('now')).'.dat', __DIR__. self::getFolder());
        $dat->in(date('Y-m-dTH:i:s', strtotime('now')).'>>'.serialize($log).archives::carrierReturn);
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        if (isset($name) && !empty($name)) {
            $this->name = $name;
        }
        return $this;
    }

    /**
     * Get the value of file
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */
    public function setFile($file)
    {
        if (isset($file) && !empty($file)) {
            $this->file = $file;
        }

        return $this;
    }

    /**
     * Get the value of folder
     */ 
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set the value of folder
     *
     * @return  self
     */ 
    public function setFolder($folder)
    {
        if (isset($folder) && !empty($folder)) $this->folder = $folder;

        return $this;
    }
}