<?php
    //conectar db
    $dsn = 'mysql:host=localhost;dbname=sistema';
    $user = 'root';
    $senha = ''; 
    $conexao = new PDO ($dsn,$user, $senha);

    $query = 'select * from produtos';

    $stmt = $conexao->query($query);
    $lista = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $lista2 = $lista;
    /*
    echo'<pre>';
    print_r($lista2);
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
				<div class="col">		
						<div class="row">
							<h1>Produtos</h1>
								

								

							<?php
							//crie uma variável para receber o código da tabela
							$tabela = '<table class="bordered striped centered tabela">';//abre table
							$tabela .='<thead>';//abre cabeçalho
							$tabela .= '<tr>';//abre uma linha
							$tabela .= '<th>Produto</th>'; // colunas do cabeçalho
							$tabela .= '<th>Preço</th>';
							$tabela .= '<th>Estoque</th>';
							/*
							$tabela .= '<th>Codigo</th>';
							$tabela .= '<th>Editar</th>';
							$tabela .= '<th>Excluir</th>';
							*/
							$tabela .= '</tr>';//fecha linha
							$tabela .='</thead>'; //fecha cabeçalho
							$tabela .='<tbody>';//abre corpo da tabela
							?>

							<?php foreach ($lista as $indice => $lista) {      //começo do loop
								$lista['valor'] = number_format($lista['valor'],2, ',', ' '); //formata o valor para R$0,00 ?>
							<?php
							$tabela .= '<tr>'; // abre uma linha
							$tabela .= '<td>'.$lista['nome'].'</td>'; 
							$tabela .= '<td>R$'.$lista['valor'].'</td>'; 
							$tabela .= '<td>'.$lista['quantidade'].'</td>'; 
							/*
							$tabela .= '<td>'.$lista['codigo'].'</td>'; 
							$tabela .= '<td><i class="fa fa-edit fa-lg text-info" onclick="editar('.$lista['id'].')" ></i></td>'; 
							$tabela .= '<td><i class="fa fa-trash fa-lg text-danger" onclick="remover('.$lista['id'].')"></i></td>';
							*/
							$tabela .= '</tr>'; // fecha linha
							/*loop fim*/
							}

							$tabela .='</tbody>'; //fecha corpo
							$tabela .= '</table>';//fecha tabela

							echo $tabela; // imprime
							?>
						</div>																	
						
						
						<h1 >Seus itens</h1>
						
						
						<div class="arealista">
							
							<form class="" method="post" action="calculo.php?venda=nao">
								<div class="px-2 d-inline-flex w-100 border border-bottom justify-content-between">
									<div class=''>
										<h5>Descrição</h5>
									</div>
									<div class=''>
										<h5>Quantidade</h5>
									</div>
			
									
									
								</div>

								<?php foreach ($lista2 as $indice2 => $lista2) { //começo do loop ?>
									
									<div class="px-2 d-inline-flex w-100 border border-bottom justify-content-between areaitem">
										<div class=''>

											<h5><?php echo $lista2['nome'];?></h5>
										
										</div>
					
										<div class='col-3'>
											<input min="0" max="<?=$lista2['quantidade']?>" name="<?=$lista2['id']?>" class="quantidade" type="number" class="form-control"  value="0">	
										</div>
										
									</div>  
								
								<?php } // fim do loop?>	
								
								  

								


								<div class="container-login100-form-btn">
									<button class="login100-form-btn">
										Comprar
									</button>
								</div>
							</form>
						</div>		
				</div>	
			</div>
		</div>
	</div>
           
	<script>
			var capturando = "";
			function capturar () {
    			
			}	
	</script>

	


</body>
</html>