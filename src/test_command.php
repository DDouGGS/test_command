<?php
/*
    tc.php 

    Robô de execução do pacote.
*/
namespace test_command;

/* Configurações de erro
E_ALL: Reporta todos os erros e advertências.
E_ERROR: Reporta erros fatais em tempo de execução. Estes indicam erros que não podem ser recuperados e causam a terminação do script.
E_WARNING: Reporta advertências em tempo de execução. Estas são não-fatais e a execução do script normalmente continua.
E_PARSE: Reporta erros de análise. Estes são gerados por falhas no analisador enquanto o script PHP está sendo compilado.
E_NOTICE: Reporta avisos em tempo de execução. Normalmente indicam que o script encontrou algo que pode indicar um erro, mas que também pode acontecer durante a execução normal do script.

error_reporting(E_ERROR | E_WARNING | E_NOTICE);

function custom_error_handler($errno, $errstr, $errfile, $errline) {
    echo "Erro ocorrido na linha $errline do arquivo $errfile: [Número $errno] $errstr";
}
set_error_handler("custom_error_handler");
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// configs
try{
    // config
    $arc = realpath(__DIR__ . '/../../../../') . '/test_commands.json';
    if(!file_exists($arc)){
        throw new \Exception('Não encontrado o arquivo de configurações.');
    }
    $cfg = array(
        'configs' => json_decode(file_get_contents($arc), true)
    );
    // requires
    foreach($cfg['configs']['requires'] as $item){
        $obj = $cfg['configs']['baseFolder'] . $item;
        if(!file_exists($obj)){
            echo "\033[35mArquivo a ser carregado NÃO existe ({$obj}}.\033[0m";
            continue;
        }
        require_once($obj);
    }
    // testing
    require(__DIR__ .'/TC.php');
    TC::testing($cfg, $argv[1]);
}catch(\Exception $e){
    echo($e->getMessage());
}
exit();