<?php
/*
    tc.php 

    Robô de execução do pacote.
*/
namespace test_command;

require(__DIR__ .'/tc.php');

// configs
try{
    $arc = realpath(__DIR__ . '/../../../../') . '/test_commands.json';
    
    if(!file_exists($arc)){
        throw new \Exception('Não encontrado o arquivo de configurações.');
    }
    TC::testing(
        array(
            // 'configs' => require(realpath(__DIR__ . '/../../../../') . '/test_commands.php')
            'configs' => json_decode(file_get_contents($arc), true)
        ), 
        $argv[1]
    );
}catch(\Exception $e){
    echo($e->getMessage());
}
exit();