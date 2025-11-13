<?php
/*
    tc.php 

    Robô de execução do pacote.
*/
namespace test_command;

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