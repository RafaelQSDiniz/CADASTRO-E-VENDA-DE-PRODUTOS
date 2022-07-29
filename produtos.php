<?php
    //conectar db
    $dsn = 'mysql:host=localhost;dbname=sistema';
    $user = 'root';
    $senha = ''; 
    $conexao = new PDO ($dsn,$user, $senha);

    $query = 'select * from produtos';

    $stmt = $conexao->query($query);
    $lista = $stmt->fetchALL(PDO::FETCH_ASSOC);
    
    /*
    echo'<pre>';
    print_r($lista);
    echo'</pre>';

    print_r($lista[2]['codigo']);
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Produtos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
 <!--===============================================================================================-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
</head>
<script>
			function editar(id) {
				location.href = 'editar.php?id='+id;
			}
			function remover(id) {
				var resultado = confirm("Tem certeza que deseja excluir o item?");
       			if (resultado == true) {
					location.href = 'controlador.php?acao=remover&id='+id;
			    } else{ alert("Você desistiu de excluir o item!"); }
			}	
</script>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div >
				<div class="col-sm-3">		
						<div class="row">
							
								

								

							<?php
							//crie uma variável para receber o código da tabela
							$tabela = '<table class="bordered striped centered tabela">';//abre table
							$tabela .='<thead>';//abre cabeçalho
							$tabela .= '<tr>';//abre uma linha
							$tabela .= '<th>Produto</th>'; // colunas do cabeçalho
							$tabela .= '<th>Preço</th>';
							$tabela .= '<th>Quantidade</th>';
							$tabela .= '<th>Codigo</th>';
							$tabela .= '<th>Editar</th>';
							$tabela .= '<th>Excluir</th>';
							$tabela .= '</tr>';//fecha linha
							$tabela .='</thead>'; //fecha cabeçalho
							$tabela .='<tbody>';//abre corpo da tabela
							?>

							<?php foreach ($lista as $indice => $lista) {      //formata o valor para R$0,00
								$lista['valor'] = number_format($lista['valor'],2, ',', ' ');  ?>
							<?php
							/*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
							$tabela .= '<tr>'; // abre uma linha
							$tabela .= '<td>'.$lista['nome'].'</td>'; // coluna Alvara
							$tabela .= '<td>R$'.$lista['valor'].'</td>'; //coluna numero
							$tabela .= '<td>'.$lista['quantidade'].'</td>'; // coluna validade
							$tabela .= '<td>'.$lista['codigo'].'</td>'; // coluna validade
							$tabela .= '<td><i class="fa fa-edit fa-lg text-info" onclick="editar('.$lista['id'].')" ></i></td>'; // coluna validade
							$tabela .= '<td><i class="fa fa-trash fa-lg text-danger" onclick="remover('.$lista['id'].')"></i></td>';
							$tabela .= '</tr>'; // fecha linha
							/*loop deve terminar aqui*/
							}
							$tabela .='</tbody>'; //fecha corpo
							$tabela .= '</table>';//fecha tabela

							echo $tabela; // imprime
							?>

							
						</div>																	
						<div class="d-flex justify-content-between " >
									<button class="btn grey lighten-3">
									<a class='txt2' href="index.html">
									<i class="fa fa-long-arrow-left" aria-hidden="true"></i>
										Voltar	
									</a>
									</button>
									
									<button class="btn grey lighten-3">
									<a class='txt2' href="novoproduto.php">
									<i class="fa fa-plus" aria-hidden="true"></i>
										Novo
									</a>
									</button>
							
						</div>			
							
					
				</div>
			</div>
		</div>
	</div>
	
	

	


</body>
</html>