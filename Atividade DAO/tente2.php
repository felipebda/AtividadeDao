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

$tabelaContato = new DaoContato();

if(isset($_POST)){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $novoContato = new Contato($nome, $email, $telefone);
    

    //adicionar contato na tabela
    $tabelaContato->create($novoContato);
    echo 'Conta criada com sucesso!';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<h1>Cadastro</h1>

<form action="" method='post'>
    <label for="nome">Nome e Sobrenome</label>
    <input type="text" id='nome' name='nome'>
    <br>
    <label for="email">Email</label>
    <input type="text" id='email' name='email'>
    <br>
    <label for="telefone">Telefone</label>
    <input type="text" id='telefone' name='telefone'>
    <br>
    <input type="submit" value='Cadastrar'>
</form>

<h1>Pegar cadastro</h1>

<form action="" method='post'>
    <label for="id">ID</label>
    <input type="text" id='id' name='id'>

    <input type="submit" value='Localizar' name='acharid'>
</form>

<?php
    if(isset($_POST['acharid']))
    {
        $id = $_POST['id'];

        $buscaContato = $tabelaContato->read($id);
        ?>
            <table border = 1>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>TELEFONE</th>
                </tr>

                <tr>
                    <th><?php echo $buscaContato->getId()?></th>
                    <th><?php echo $buscaContato->getNome()?></th>
                    <th><?php echo $buscaContato->getEmail()?></th>
                    <th><?php echo $buscaContato->getTelefone()?></th>
                </tr>
            </table>
        <?php
    }
?>
    






</body>
</html>


