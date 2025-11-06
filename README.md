# test_command
Biblioteca para testes via linha de comandos

### LINHA DE COMANDO

#### PARA O FRAMEWORK SPIFFY
* COPIAR O ARQUIVO PARA A PASTA SCRIPTS
* ADICIONAR AO INI.INC.PHP

  // clt
  require(realpath(__DIR__ . '/clt.php'));
  clt::setConnection($connection);

* EXEMPLO DE USO PARA SCRIPTS

  \clt::shell(array('test'));

#### PARA O LARAVEL
* CRIAR PASTA LIBRARIES
* COPIAR O ARQUIVO PARA A PASTA LIBRARIES
* INCLUIR NAMESPACE NO ARQUIVO
    namespace App\Libraries;
