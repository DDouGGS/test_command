<?php

namespace App\Libraries;

abstract class clt
{
    protected static $protocol;
    protected static $index   = 1;
    protected static $status  = array();
    protected static $simple  = false;
    protected static $scene   = array();
    protected static $header  = array();
    protected static $content = array();
    protected static $connection = null;
    protected static $propertys  = null;
    protected static $folder  = '/';
    protected static $assets  = array();
    protected static $label   = '';
    protected static $reference = 'book:chapter:title:subtitle:label';
    protected static $log = false;
    protected static $follow = true;
    // private $callbacks = array();
        
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct($folder = null)
    {
        class_alias(get_class($this), 'cmdl');
        $this->setFolder($folder);
        self::$protocol = rand(100000, 100000000);
    }

    public static function shell(array $output = array(), $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true && !empty($output)) {
            // print
            self::block($output, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log($output, self::getLabel());}
        }
    }

    /**
     * Method sameTypes
     *
     * @param string    $type [explicite description]
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     * Tipos de Dados ($type):
     *      string:     Para texto.
     *      int:        N�meros inteiros (ex: 10, -5).
     *      float:      N�meros de ponto flutuante (ex: 3.14, 0.5).
     *      bool:       Valores l�gicos (true ou false).
     *      array:      Cole��o de valores. 
     *      object:     Inst�ncias de classes.
     *      null:       Um valor especial que representa "nenhum valor".
     *      resource:   Um ponteiro para um recurso externo (como arquivos ou banco de dados).
     */
    public static function sameShell($type, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            try{
                // asset
                $rtn = $callback();
                $sd  = (gettype($rtn) === $type);
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
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }

    /**
     * Method regExpShell
     *
     * @param string    $regex [explicite description]
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     * 
     */
    public static function regExpShell($regex, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            preg_match_all($regex, $rtn, $matchs);
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
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
    
    /**
     * Method emptyShell
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function emptyShell(Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = empty($rtn);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":emptyShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
    
    /**
     * Method equalsShell
     *
     * @param $equal $equal [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function equalsShell($equal, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn == $equal);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":equalsShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
    
    /**
     * Method diffsShell
     *
     * @param $diff $diff [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function diffsShell($diff, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn !== $diff);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":diffsShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method falseShell
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function falseShell(Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn === false);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":falseShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method fileExistsShell
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function fileExistsShell(Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = file_exists($rtn);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":fileExistsShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method greaterThanShell
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function greaterThanShell(int $term, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn > $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":greaterThanShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method greaterThanOrEqualShell
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function greaterThanOrEqualShell(int $term, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn >= $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":greaterThanOrEqualShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method instanceOfShell
     *
     * @param $instancia $instancia [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function instanceOfShell($instancia, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn === true);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":instanceOfShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method lessThanShell
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function lessThanShell(int $term, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn < $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":lessThanShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method lessThanOrEqualShell
     *
     * @param int $term [explicite description]
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function lessThanOrEqualShell(int $term, Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn <= $term);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":lessThanOrEqualShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }
        
    /**
     * Method nullShell
     *
     * @param Closure $callback [explicite description]
     * @param $condition $condition [explicite description]
     *
     * @return void
     */
    public static function nullShell(Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn === null);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":nullShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }    
    
    /**
     * Method returnTrueShell
     *
     * @param Closure   $callback [explicite description]
     * @param bool      $condition [explicite description]
     *
     * @return void
     */
    public static function trueShell(Closure $callback, $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true) {
            // asset
            $rtn = $callback();
            $sd  = ($rtn === true);
            $sds = $sd? 'true': 'false';
            // assets;
            $index = self::$index . ":trueShell:" . self::getLabel();
            self::$assets[$index] = $sds;
            // print
            self::block(self::$assets, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log(array($index . ':'. $sds), self::getLabel());}
            return $rtn;
        }
    }

    public static function shellBegin(array $output = array(), $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true && !empty($output)) {
            self::getConnection()->begin_transaction();
            // print
            self::block($output, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log($output, self::getLabel());}
        }
    }

    public static function shellRollback(array $output = array(), $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true && !empty($output)) {
            self::getConnection()->rollback_transaction();
            // print
            self::block($output, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
            if(self::getLog()){ self::log($output, self::getLabel());}

        }
    }
    
    /**
     * Method block
     *
     * @param mixed $sd [explicite description]
     * @param array $backtrace [explicite description]
     *
     * @return void
     */
    private static function block($sd, $backtrace)
    {
        if (!empty($sd)) {
            echo("\n".date('Y-m-d H:i:s', strtotime('now')). " <<<<< ASSETS LABEL: " . self::getLabel()  . ':' . self::$index . "\n");
            echo(date('Y-m-d H:i:s', strtotime('now')). " <<<<< ASSETS BACKTRACER - usage memory (Bytes): ". memory_get_peak_usage() ."\n");
            print_r($backtrace);
            echo(date('Y-m-d H:i:s', strtotime('now'))." <<<<< ASSETS OUTPUTS\n");
            print_r($sd);

            if (self::getPropertys()) {
                echo("\n".date('Y-m-d H:i:s', strtotime('now'))." <<<<< globals:\n");
                print_r(self::globals());
                echo("\n".date('Y-m-d H:i:s', strtotime('now'))." <<<<< envs:\n");
                print_r(self::envs());
            }

            echo(date('Y-m-d H:i:s', strtotime('now')). " <<<<< ASSETS LABEL: " . self::getLabel() . ':' . self::$index ."\n");
        }
    }
        
    /**
     * Method envs
     *
     * @param $propertys $propertys [explicite description]
     *
     * @return array
     */
    private static function envs($propertys = false)
    {
        $env = array();
        
        if ($propertys === false) {
            return $env;
        }

        foreach ($_ENV as $key => $value) {
            if (is_object($value)) {
                $env[$key] = get_class($value);
                continue;
            }
            if (is_array($value)) {
                $env[$key] = 'array['.count($value).']';
                continue;
            }
            $env[$key] = $value;
        }
        
        return $env;
    }
        
    /**
     * Method globals
     *
     * @param $propertys $propertys [explicite description]
     *
     * @return array
     */
    private static function globals($propertys = false)
    {
        $global = array();
        
        if ($propertys === false) {
            return $global;
        }

        foreach ($GLOBALS as $key => $value) {
            if (is_object($value)) {
                $env[$key] = get_class($value);
                continue;
            }
            if (is_array($value)) {
                $env[$key] = 'array['.count($value).']';
                continue;
            }
            $global[$key] = $value;
        }
        
        return $global;
    }
        
    /**
     * Method globals
     *
     * @param $propertys $propertys [explicite description]
     *
     * @return array
     */
    private static function globalsPropertys($propertys = false)
    {
        $global = array();

        if ($propertys === false) {
            return $global;
        }

        foreach ($GLOBALS as $key => $value) {
            if(substr($key,0,1) !== '_') {
                foreach ($value as $key => $value) {
                    if(is_object($value) || is_array($value)){
                        $global[$key] = serialize($value);
                        continue;
                    }
                    $global[$key] = $value;
                }
            }
        }

        return $global;
    }
    
    /**
     * Method follow
     *
     * @return void
     */
    protected static function follow()
    {
        $follow = readline(utf8_encode("\nTo continue, do you wish type y or yes: "));
        if (!in_array(strtolower($follow), array('Y','y','Yes','yes'))) {
            die("\n".date('Y-m-d H:i:s', strtotime('now'))." <<< END.\n");
        }
        echo("\n".date('Y-m-d H:i:s', strtotime('now'))." >>> CONTINUE\n");
    }
    
    /**
     * Method backtrace
     *
     * @param $simple $simple [explicite description]
     *
     * @return array
     */
    protected static function backtrace($simple = true)
    {
        $count = 0;
        $trace = '';
        $debugBacktrace = debug_backtrace();

        if (self::getSimple()) {
            foreach ($debugBacktrace as $item) {
                if($count === 2){
                    self::setReference($item['file'] . ':' . $item['function'] . ':' . $item['type'] . ':' . $item['line']);
                    self::setLabel(self::getReference());
                }
                if ($item['function'] !== 'backtrace') {
                    $trace .= " <<<<< <<<<< "  . $item['class'] . $item['type'] . $item['function'] .  ' (' . $item['line'] . ");\n";
                }
                ++$count;
            }
            return $trace;
        }

        foreach ($debugBacktrace as $item) {
            if($count === 2){
                    self::setReference($item['file'] . ':' . $item['function'] . ':' . $item['type'] . ':' . $item['line']);
                    self::setLabel(self::getReference());
                }
            if ($item['function'] !== 'backtrace') {
                $trace .= " <<<<< <<<<< "  . $item['file'] . ' - ' . $item['class'] . $item['type'] . $item['function'] .  ' (' . $item['line'] . ");\n";
            }
            ++$count;
        }
        return $trace;
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
        $dat = arquive::make('logs'.date('Ymd', strtotime('now')).'.dat', __DIR__.self::getFolder());
        $dat->in(date('Y-m-dTH:i:s', strtotime('now')).'>>'.serialize($log).arquive::carrierReturn);
    }

    /**
     * Get the value of status
     */
    public static function getStatus()
    {
        return self::$status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public static function setStatus($status)
    {
        if (isset($status) && !empty($status)) {
            self::$status[] = $status;
        }
    }

    /**
     * Get the value of connection
     */
    public static function getConnection()
    {
        return self::$connection;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */
    public static function setConnection($connection)
    {
        if (isset($connection) && !empty($connection)) {
            self::$connection = $connection;
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
     * Get the value of scene
     */ 
    public static function getScene()
    {
        return self::$scene;
    }

    /**
     * Set the value of scene
     *
     * @return  self
     */ 
    public static function setScene($scene)
    {
        if(isset($scene) && !empty($scene)) self::$scene[] = $scene;
    }

    /**
     * Get the value of folder
     */ 
    public static function getFolder()
    {
        return self::$folder;
    }

    /**
     * Set the value of folder
     *
     * @return  self
     */ 
    public static function setFolder($folder)
    {
        if(isset($folder) && !empty($folder)) self::$folder = $folder;
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
     * Get the value of log
     */ 
    public static function getLog()
    {
        return self::$log;
    }

    /**
     * Set the value of log
     *
     * @return  self
     */ 
    public static function setLog($log)
    {
        if(!empty($log)){ self::$log = $log;}
    }

    /**
     * Get the value of follow
     */ 
    public static function getFollow()
    {
        return self::$follow;
    }

    /**
     * Set the value of follow
     *
     * @return  self
     */ 
    public static function setFollow($follow)
    {
        if(!empty($folder)){ self::$follow = $follow;}
    }
}

class arquive
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
        return new arquive($name, $folder);
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
            throw new \Exception('N�o encontrado o recurso de arquivo.');
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
            throw new \Exception('N�o encontrado o recurso de arquivo.');
        }

        return fclose($this->getFile());
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