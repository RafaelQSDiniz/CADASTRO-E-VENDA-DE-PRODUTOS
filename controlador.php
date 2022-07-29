<?php
    //conectar db
    $dsn = 'mysql:host=localhost;dbname=sistema';
    $user = 'root';
    $senha = ''; 
    $conexao = new PDO ($dsn,$user, $senha);


    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    if ($acao == 'remover'){
        $query = "DELETE FROM produtos WHERE `produtos`.`id` = '{$id}'";
		$conexao->exec($query);;
	 	header('Location: produtos.php'); 

    } elseif ($acao == 'atualizar'){

        // setar variaveis
        $nome = $_POST['nome'];
        $codigo = $_POST['codigo'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        print_r($id);

        $query = "
            UPDATE produtos 
            SET    nome = '{$nome}',  codigo = '{$codigo}', valor = '{$preco}', quantidade ='{$quantidade}'
            WHERE  id = '{$id}' ";
        $conexao->exec($query);
        header('Location: produtos.php');


        
    } elseif ($acao == 'nova'){

        // setar variaveis
        $nome = $_POST['nome'];
        $codigo = $_POST['codigo'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];

        //query
        $query = "
            insert into produtos(
                codigo, nome, valor, quantidade, status
            )values(
                '{$codigo}','{$nome}','{$preco}','{$quantidade}', 1
            )
        ";
        $conexao->exec($query);
        header('Location: novosucesso.php');
    }


    
    /*
    $query = 'select * from produtos';

    $stmt = $conexao->query($query);
    $lista = $stmt->fetchALL();
    
    echo'<pre>';
    print_r($lista);
    echo'</pre>';

    print_r($lista[2][2]);
    */

   
?>