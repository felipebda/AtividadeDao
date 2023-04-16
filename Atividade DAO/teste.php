<?php
include "contato.php";
include "daocontato.php";
include "pdoconexao.php";


header("Content-Type: text/html; charset=utf-8",true);

function carregarClasse( $classe )
{
    if(file_exists( "{$classe}.php" )) 
    {
        include_once "{$classe}.php";
    }
    else
    {
        echo "O arquivo {$classe}.php da classe {$classe} não foi encontrado";
    }

}

spl_autoload_register('carregarClasse');



//1- INSERINDO INFORMACOES PARA O BANCO DE DADOS
//Criando um objeto de contato e deixar persistente no banco de dados
$contato1 = new Contato ("Alexandra Florambel", "abc123@agorafoi.com.br", "98745632");

//Criando um objeto DAO
$PersistenciaContato1 = new DaoContato();

//Fazendo a persistencia dos dados novovs no banco de dados, usando metodo que passa o objeto de contato como parametro

/*
if($PersistenciaContato1->create($contato1))
{
    echo 'Inseridos no banco com Êxito';
}
*/

//CONFERINDO AS INFORMACOES 
//Voce pode visualizar as informacoes utilizando var_dump
$contato2 = $PersistenciaContato1->read(1);
//var_dump($contato2);
echo "<hr>";
echo $contato2->getNome();
echo "<hr>";
//FAZER ALTERACOES NO CONTATO
$contato2->setNome("Luciana");
$contato2->setEmail("menina@garota.com.br");

if($PersistenciaContato1->update($contato2))
{
    echo"Atualizado no banco com exito.";
}
echo "<hr>";

//DELETAR CONTATO
/*
if($PersistenciaContato1->delete(3)){
    echo '<p>Excluído do banco com Êxito</p>';
}
*/
?>